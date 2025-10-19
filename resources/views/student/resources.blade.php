@props([
    'user' => [
        'name' => 'John Doe',
        'program' => 'Computer Science',
        'initials' => 'JD'
    ],
    'resources' => []
])

<x-student.layout.app 
    title="Resources - CLSU Student Dashboard"
    activeItem="resources"
    :user="$user"
    :notifications="['courses' => 0, 'assignments' => 0]"
>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Resources</h1>
            <p class="text-gray-600 mt-2">Access course materials and learning resources</p>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <input type="text" id="resource-search" placeholder="Search resources by name or course..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        <select id="resource-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <option value="">All Types</option>
            <option value="document">Documents</option>
            <option value="video">Videos</option>
            <option value="image">Images</option>
            <option value="link">Links</option>
        </select>
        <select id="course-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <option value="">All Courses</option>
            <option value="cs101">CS 101</option>
            <option value="cs201">CS 201</option>
            <option value="cs301">CS 301</option>
        </select>
    </div>

    <!-- Resources Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Available Resources</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resource</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($resources as $resource)
                        <tr class="hover:bg-gray-50 resource-row" data-name="{{ strtolower($resource['name']) }}" data-type="{{ $resource['type'] }}" data-course="{{ strtolower($resource['course']) }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="{{ $resource['icon'] }} text-white text-sm"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $resource['name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $resource['description'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge {{ $resource['type'] === 'document' ? 'badge-info' : ($resource['type'] === 'video' ? 'badge-warning' : ($resource['type'] === 'image' ? 'badge-success' : 'badge-secondary')) }}">
                                    {{ ucfirst($resource['type']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $resource['course'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $resource['instructor'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $resource['uploaded_at']->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-green-600 hover:text-green-800" onclick="alert('Download feature coming soon!')">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="text-blue-600 hover:text-blue-800" onclick="alert('Preview feature coming soon!')">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-folder-open text-4xl mb-4 text-gray-300"></i>
                                <div class="text-lg font-medium">No resources available</div>
                                <div class="text-sm">Resources will appear here when instructors upload them.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <x-pagination :paginator="$resources" />
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('resource-search');
            const filterSelect = document.getElementById('resource-filter');
            const courseSelect = document.getElementById('course-filter');
            const resourceRows = document.querySelectorAll('.resource-row');

            function filterResources() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const filterType = filterSelect.value;
                const filterCourse = courseSelect.value;
                
                resourceRows.forEach(function(row) {
                    const name = row.getAttribute('data-name');
                    const type = row.getAttribute('data-type');
                    const course = row.getAttribute('data-course');
                    
                    const matchesSearch = name.includes(searchTerm);
                    const matchesFilter = !filterType || type === filterType;
                    const matchesCourse = !filterCourse || course === filterCourse;
                    
                    if (matchesSearch && matchesFilter && matchesCourse) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterResources);
            filterSelect.addEventListener('change', filterResources);
            courseSelect.addEventListener('change', filterResources);
        });
    </script>
</x-student.layout.app>
