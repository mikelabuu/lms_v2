@props([
    'course' => [
        'id' => 'cs101',
        'title' => 'Introduction to Programming',
        'code' => 'CS 101',
        'description' => 'Learn the fundamentals of computer programming.',
        'students' => 45,
        'assignments' => 8,
        'icon' => 'fas fa-code',
        'status' => 'active', // active, draft, archived
        'progress' => 75,
        'nextClass' => 'Tomorrow, 9:00 AM'
    ]
])

<div class="course-card" onclick="window.location.href='{{ route('instructor.course.show', $course['id']) }}'">
    <div class="course-image flex items-center justify-center">
        <i class="{{ $course['icon'] }} text-6xl text-white opacity-80"></i>
        <div class="course-badge">{{ $course['code'] }}</div>
        <div class="absolute top-4 left-4">
            @if($course['status'] === 'active')
                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">Active</span>
            @elseif($course['status'] === 'draft')
                <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">Draft</span>
            @else
                <span class="bg-gray-500 text-white text-xs px-2 py-1 rounded-full">Archived</span>
            @endif
        </div>
    </div>
    <div class="course-content">
        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $course['title'] }}</h3>
        <p class="text-gray-600 text-sm mb-4">{{ $course['description'] }}</p>
        
        <!-- Course Stats -->
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $course['assignments'] ?? 0 }}</div>
                <div class="text-xs text-gray-500">Assignments</div>
            </div>
        </div>
        
        
        
        
        <!-- Action Buttons -->
        <div class="flex space-x-2">
            <button class="flex-1 btn-primary text-sm px-3 py-2" onclick="event.stopPropagation(); window.location.href='{{ route('instructor.course.show', $course['id']) }}'">
                <i class="fas fa-eye mr-1"></i>
                Manage
            </button>
            <button class="btn-secondary text-sm px-3 py-2" onclick="event.stopPropagation(); window.location.href='{{ route('instructor.course.edit', $course['id']) }}'">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    </div>
</div>
