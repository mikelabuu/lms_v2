@props([
    'course' => [
        'id' => 'cs101',
        'title' => 'Introduction to Programming',
        'code' => 'CS 101',
        'description' => 'Learn the fundamentals of computer programming with Python and JavaScript.',
        'instructor' => 'Dr. Lorenz',
        'enrollment_count' => 45,
        'difficulty' => 'beginner',
        'progress' => 78,
        'students' => 45,
        'icon' => 'fas fa-book'
    ]
])

<div class="course-card" onclick="window.location.href='{{ route('student.course.show', $course['id']) }}'">
    <div class="course-image flex items-center justify-center">
        <i class="{{ $course['icon'] ?? 'fas fa-book' }} text-6xl text-white opacity-80"></i>
        <div class="course-badge">{{ $course['code'] }}</div>
    </div>
    <div class="course-content">
        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $course['title'] }}</h3>
        <p class="text-gray-600 text-sm mb-2">{{ $course['description'] }}</p>
        
        @if(isset($course['instructor']))
            <p class="text-gray-500 text-xs mb-4">
                <i class="fas fa-chalkboard-teacher mr-1"></i>
                {{ $course['instructor'] }}
            </p>
        @endif
        
        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center space-x-4 text-xs text-gray-500">
                @if(isset($course['students']))
                    <span>
                        <i class="fas fa-users mr-1"></i>
                        {{ $course['students'] }} students
                    </span>
                @endif
                @if(isset($course['progress']))
                    <span>
                        <i class="fas fa-chart-line mr-1"></i>
                        {{ $course['progress'] }}% progress
                    </span>
                @endif
                @if(isset($course['enrollment_count']))
                    <span>
                        <i class="fas fa-users mr-1"></i>
                        {{ $course['enrollment_count'] }} students
                    </span>
                @endif
                @if(isset($course['difficulty']))
                    <span>
                        <i class="fas fa-signal mr-1"></i>
                        {{ ucfirst($course['difficulty']) }}
                    </span>
                @endif
            </div>
            <div class="space-x-2">
                @if(isset($course['enrollment_count']) && !isset($course['progress']))
                    <!-- Available course (catalog) -->
                    <button class="btn-primary text-sm px-4 py-2" onclick="event.stopPropagation(); enrollInCourse({{ $course['id'] }})">
                        <i class="fas fa-plus mr-1"></i>
                        Enroll
                    </button>
                @else
                    <!-- Enrolled course (dashboard/courses) -->
                    <button class="btn-primary text-sm px-4 py-2" onclick="event.stopPropagation(); window.location.href='{{ route('student.course.show', $course['id']) }}'">
                        <i class="fas fa-eye mr-1"></i>
                        View
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function enrollInCourse(courseId) {
    if (confirm('Are you sure you want to enroll in this course?')) {
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/student/courses/${courseId}/enroll`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => {
                    window.location.href = '/student/courses';
                }, 1000);
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Failed to enroll. Please try again.', 'error');
        });
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>
