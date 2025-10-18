@props([
    'user' => [
        'name' => 'Dr. Lorenz',
        'department' => 'Computer Science',
        'initials' => 'JS'
    ],
    'allCourses' => []
])

<x-instructor.layout.app 
    title="My Courses - CLSU Instructor Dashboard"
    activeItem="courses"
    :user="$user"
    :notifications="['assignments' => 8, 'students' => 3]"
>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Courses</h1>
            <p class="text-gray-600 mt-2">Manage and organize your course materials</p>
        </div>
        <button class="btn-primary" onclick="window.location.href='{{ route('instructor.course.create') }}'">
            <i class="fas fa-plus mr-2"></i>
            Create New Course
        </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative max-w-md">
            <input type="text" id="course-search" placeholder="Search courses by title or code..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <div id="courses-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($allCourses as $course)
            <div class="course-item" data-title="{{ strtolower($course['title']) }}" data-code="{{ strtolower($course['code']) }}">
                <x-instructor.cards.course-card :course="$course" />
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('course-search');
            const coursesContainer = document.getElementById('courses-container');
            const courseItems = document.querySelectorAll('.course-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                courseItems.forEach(function(item) {
                    const title = item.getAttribute('data-title');
                    const code = item.getAttribute('data-code');
                    
                    if (title.includes(searchTerm) || code.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</x-instructor.layout.app>
