@props([
    'user' => [
        'name' => 'Dr. Lorenz',
        'department' => 'Computer Science',
        'initials' => 'JS'
    ],
    'courseData' => []
])

<x-instructor.layout.app 
    title="{{ $courseData['title'] }} - CLSU Instructor Dashboard"
    activeItem="courses"
    :user="$user"
    :notifications="['assignments' => 8, 'students' => 3]"
>
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $courseData['title'] }}</h1>
                <p class="text-gray-600 mt-2">{{ $courseData['code'] }}</p>
            </div>
            <div class="flex space-x-3">
                <button class="btn-secondary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Course
                </button>
                <button class="btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    New Assignment
                </button>
            </div>
        </div>

        <!-- Course Overview -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-700">{{ $courseData['assignments'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Assignments</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-700">{{ $courseData['contents'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Materials</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-700">{{ count($students ?? []) }}</div>
                    <div class="text-sm text-gray-600">Students</div>
                </div>
            </div>
        </div>
  <!-- Course Description -->
  <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Course Description</h2>
            <p class="text-gray-600">{{ $courseData['description'] }}</p>
        </div>
        <!-- Students Table -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Enrolled Students</h2>
                <a href="{{ route('instructor.students') }}" class="text-sm text-purple-600 hover:text-purple-700 font-medium">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(($students ?? []) as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $student['name'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $student['email'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="text-xs px-2 py-1 rounded-full {{ strtolower($student['status']) === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">{{ $student['status'] }}</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $student['lastActivity'] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <a href="{{ route('instructor.student.show', $student['id']) }}" class="text-purple-600 hover:text-purple-800 text-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                        @if(empty($students))
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500 text-sm">No students enrolled yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Course Materials (Instructor-managed content) -->
        <div id="materials" class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Course Materials</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-3">Upload New Content (PDF)</h3>
                    <form id="content-upload-form" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Week 1 - Introduction" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Content Description <span class="text-red-500">*</span></label>
                            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Overview of week 1 topics..." required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">PDF File <span class="text-red-500">*</span></label>
                            <div class="file-upload-area">
                                <div class="file-drop-zone" id="file-drop-zone" onclick="document.getElementById('file-input').click()">
                                    <div class="file-drop-content">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <h5 class="text-gray-600 font-medium">Drop PDF file here or click to browse</h5>
                                        <p class="text-gray-500 text-sm">Maximum file size: 5MB</p>
                                    </div>
                                </div>
                                <input type="file" id="file-input" name="file" accept=".pdf" class="hidden" required>
                            </div>
                            
                            <!-- File Preview -->
                            <div id="file-preview" class="file-preview hidden mt-3">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-2xl text-red-600 mr-3"></i>
                                        <div class="flex-1">
                                            <h6 class="font-medium text-gray-800" id="file-name">filename.pdf</h6>
                                            <small class="text-gray-600" id="file-size">File size</small>
                                        </div>
                                        <button type="button" class="text-red-600 hover:text-red-800" onclick="removeFile()">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-primary w-full" type="submit" id="upload-btn">
                            <i class="fas fa-upload mr-2"></i>Upload Content
                        </button>
                    </form>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-3">Existing Contents</h3>
                    
                    <!-- Search Bar for Resources -->
                    <div class="mb-4">
                        <div class="relative max-w-sm">
                            <input type="text" id="resource-search" placeholder="Search resources..." 
                                   class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                    </div>
                    
                    <!-- Resources Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="resources-table-body" class="bg-white divide-y divide-gray-200">
                                @forelse(($contents ?? []) as $item)
                                    <tr class="resource-row hover:bg-gray-50" data-title="{{ strtolower($item['title']) }}" data-description="{{ strtolower($item['description']) }}">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="fas fa-file-pdf text-red-600 mr-2"></i>
                                                <div class="text-sm font-medium text-gray-800">{{ $item['title'] }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-gray-600 max-w-xs truncate">{{ $item['description'] }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-xs px-2 py-1 rounded-full {{ $item['status'] === 'published' ? 'bg-green-100 text-green-800' : ($item['status'] === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst($item['status']) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item['uploaded_at'] }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('course.content.serve', ['instructor' => 'dr-lorenz', 'file' => basename($item['file_path'])]) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                <button onclick="document.getElementById('edit-{{ $item['id'] }}').classList.toggle('hidden')" class="text-gray-600 hover:text-gray-800">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form method="POST" action="{{ route('instructor.course.content.delete', [request()->route('id'), $item['id']]) }}" onsubmit="return confirm('Delete this content?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 text-sm">
                                            <i class="fas fa-file-pdf text-4xl mb-4 text-gray-300"></i>
                                            <div class="text-lg font-medium">No resources uploaded yet</div>
                                            <div class="text-sm">Upload your first course material to get started.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination for Resources -->
                    @if(count($contents ?? []) > 5)
                        <div class="mt-4 flex justify-center">
                            <nav class="flex items-center space-x-2">
                                <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                                    Previous
                                </button>
                                <button class="px-3 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700">
                                    1
                                </button>
                                <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                                    2
                                </button>
                                <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                                    Next
                                </button>
                            </nav>
                        </div>
                    @endif
                    
                    <!-- Edit Forms (Hidden by default) -->
                    @foreach(($contents ?? []) as $item)
                        <div id="edit-{{ $item['id'] }}" class="mt-4 hidden">
                            <form method="POST" action="{{ route('instructor.course.content.update', [request()->route('id'), $item['id']]) }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @csrf
                                @method('PUT')
                                @php
                                    $editTitleProps = [
                                        "name"=>"title",
                                        "label"=>"Title",
                                        "defaultValue"=>$item["title"],
                                        "required"=>true
                                    ];
                                @endphp
                                <div data-react-component="TextInput" data-props='@json($editTitleProps)'></div>
                                @php
                                    $editStatusOptions = [
                                        ["label"=>"Draft","value"=>"draft"],
                                        ["label"=>"Published","value"=>"published"],
                                        ["label"=>"Archived","value"=>"archived"],
                                    ];
                                    $editStatusDefault = collect($editStatusOptions)->firstWhere('value', $item['status']);
                                    $editStatusProps = ["name"=>"status","label"=>"Status","options"=>$editStatusOptions,"defaultValue"=>$editStatusDefault,"sx"=>["width"=>"100%"]];
                                @endphp
                                <div data-react-component="SelectAutocomplete" data-props='@json($editStatusProps)'></div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="description" rows="2" class="w-full border border-gray-300 rounded-lg p-2" required>{{ $item['description'] }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Replace PDF (optional)</label>
                                    <input type="file" name="file" accept="application/pdf" class="w-full border border-gray-300 rounded-lg p-2 bg-white">
                                </div>
                                <div>
                                    <button class="btn-primary" type="submit"><i class="fas fa-save mr-1"></i>Save</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

      

    </div>

    <style>
        /* File Upload Styles */
        .file-upload-area {
            margin-bottom: 15px;
        }

        .file-drop-zone {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            background-color: #f9fafb;
        }

        .file-drop-zone:hover {
            border-color: #10b981;
            background-color: #f0fdf4;
        }

        .file-drop-zone.dragover {
            border-color: #10b981;
            background-color: #ecfdf5;
        }

        .file-drop-content i {
            display: block;
            margin: 0 auto 15px;
        }

        .file-preview {
            margin-top: 15px;
        }

        .hidden {
            display: none !important;
        }
    </style>

    <script>
        // File upload functionality and resource search
        document.addEventListener('DOMContentLoaded', function() {
            // Resource search functionality
            const resourceSearchInput = document.getElementById('resource-search');
            const resourceRows = document.querySelectorAll('.resource-row');

            if (resourceSearchInput && resourceRows.length > 0) {
                resourceSearchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    
                    resourceRows.forEach(function(row) {
                        const title = row.getAttribute('data-title');
                        const description = row.getAttribute('data-description');
                        
                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
            const form = document.getElementById('content-upload-form');
            const fileInput = document.getElementById('file-input');
            const dropZone = document.getElementById('file-drop-zone');
            const filePreview = document.getElementById('file-preview');
            const uploadBtn = document.getElementById('upload-btn');

            // File input change handler
            fileInput.addEventListener('change', handleFileSelect);

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            dropZone.addEventListener('drop', handleDrop, false);

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!fileInput.files.length) {
                    alert('Please select a PDF file');
                    return;
                }

                const formData = new FormData(form);
                const courseId = '{{ request()->route("id") }}';
                
                
                uploadBtn.disabled = true;
                uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

                fetch(`/instructor/courses/${courseId}/contents`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Content uploaded successfully!', 'success');
                        form.reset();
                        removeFile();
                        // Reload page to show new content
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Upload failed', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Upload failed. Please try again.', 'error');
                })
                .finally(() => {
                    uploadBtn.disabled = false;
                    uploadBtn.innerHTML = '<i class="fas fa-upload mr-2"></i>Upload Content';
                });
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight() {
                dropZone.classList.add('dragover');
            }

            function unhighlight() {
                dropZone.classList.remove('dragover');
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect({ target: { files: files } });
                }
            }

            function handleFileSelect(event) {
                const file = event.target.files[0];
                if (file) {
                    // Validate file type
                    if (file.type !== 'application/pdf') {
                        alert('Please select a PDF file only');
                        fileInput.value = '';
                        return;
                    }

                    // Validate file size (5MB limit)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File size must be less than 5MB');
                        fileInput.value = '';
                        return;
                    }

                    // Show file preview
                    showFilePreview(file);
                }
            }

            function showFilePreview(file) {
                const fileName = document.getElementById('file-name');
                const fileSize = document.getElementById('file-size');

                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                filePreview.classList.remove('hidden');
                dropZone.style.display = 'none';
            }

            window.removeFile = function() {
                fileInput.value = '';
                filePreview.classList.add('hidden');
                dropZone.style.display = 'block';
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                    type === 'success' ? 'bg-green-500 text-white' : 
                    type === 'error' ? 'bg-red-500 text-white' : 
                    'bg-blue-500 text-white'
                }`;
                notification.textContent = message;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
</x-instructor.layout.app>

