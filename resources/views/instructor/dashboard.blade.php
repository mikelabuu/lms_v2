@props([
    'user' => [
        'name' => 'Dr. Lorenz',
        'department' => 'Computer Science',
        'initials' => 'JS'
    ],
    'stats' => [
        [
            'icon' => 'fas fa-book-open',
            'iconBg' => 'bg-gradient-to-br from-blue-400 to-blue-600',
            'value' => '6',
            'label' => 'Active Courses',
            'progress' => 85,
            'trend' => 'up',
            'trendValue' => '+2',
            'description' => 'This semester'
        ],
        [
            'icon' => 'fas fa-users',
            'iconBg' => 'bg-gradient-to-br from-green-400 to-green-600',
            'value' => '247',
            'label' => 'Total Students',
            'progress' => 92,
            'trend' => 'up',
            'trendValue' => '+15',
            'description' => 'Across all courses'
        ],
        [
            'icon' => 'fas fa-tasks',
            'iconBg' => 'bg-gradient-to-br from-purple-400 to-purple-600',
            'value' => '23',
            'label' => 'Pending Grading',
            'progress' => 45,
            'trend' => 'down',
            'trendValue' => '-5',
            'description' => 'Assignments to review'
        ],
        [
            'icon' => 'fas fa-chart-line',
            'iconBg' => 'bg-gradient-to-br from-orange-400 to-orange-600',
            'value' => '4.8',
            'label' => 'Avg Rating',
            'progress' => 96,
            'trend' => 'up',
            'trendValue' => '+0.2',
            'description' => 'Student feedback'
        ]
    ],
    'courses' => [
        [
            'id' => 'cs101',
            'title' => 'Introduction to Programming',
            'code' => 'CS 101',
            'description' => 'Learn the fundamentals of computer programming with Python and JavaScript.',
            'students' => 45,
            'assignments' => 8,
            'icon' => 'fas fa-code',
            'status' => 'active',
            'progress' => 75,
            'nextClass' => 'Tomorrow, 9:00 AM'
        ],
        [
            'id' => 'cs201',
            'title' => 'Database Management',
            'code' => 'CS 201',
            'description' => 'Master SQL and database design principles for modern applications.',
            'students' => 38,
            'assignments' => 6,
            'icon' => 'fas fa-database',
            'status' => 'active',
            'progress' => 65,
            'nextClass' => 'Wednesday, 2:00 PM'
        ],
        [
            'id' => 'cs301',
            'title' => 'Computer Networks',
            'code' => 'CS 301',
            'description' => 'Understanding network protocols, security, and infrastructure.',
            'students' => 52,
            'assignments' => 5,
            'icon' => 'fas fa-network-wired',
            'status' => 'active',
            'progress' => 42,
            'nextClass' => 'Friday, 10:00 AM'
        ],
        [
            'id' => 'cs401',
            'title' => 'Mobile App Development',
            'code' => 'CS 401',
            'description' => 'Build cross-platform mobile applications using React Native.',
            'students' => 29,
            'assignments' => 7,
            'icon' => 'fas fa-mobile-alt',
            'status' => 'active',
            'progress' => 90,
            'nextClass' => 'Thursday, 1:00 PM'
        ],
        [
            'id' => 'cs501',
            'title' => 'Cybersecurity Fundamentals',
            'code' => 'CS 501',
            'description' => 'Learn about network security, encryption, and ethical hacking.',
            'students' => 41,
            'assignments' => 4,
            'icon' => 'fas fa-shield-alt',
            'status' => 'active',
            'progress' => 35,
            'nextClass' => 'Monday, 3:00 PM'
        ],
        [
            'id' => 'cs601',
            'title' => 'Artificial Intelligence',
            'code' => 'CS 601',
            'description' => 'Introduction to machine learning, neural networks, and AI algorithms.',
            'students' => 33,
            'assignments' => 3,
            'icon' => 'fas fa-brain',
            'status' => 'draft',
            'progress' => 28,
            'nextClass' => 'Tuesday, 11:00 AM'
        ]
    ],
    'assignments' => [
        [
            'id' => 1,
            'title' => 'Programming Exercise 3',
            'course' => 'CS 101 - Introduction to Programming',
            'submissions' => 42,
            'totalStudents' => 45,
            'dueDate' => 'Jan 20, 2025',
            'status' => 'pending',
            'priority' => 'high'
        ],
        [
            'id' => 2,
            'title' => 'Database Design Project',
            'course' => 'CS 201 - Database Management',
            'submissions' => 35,
            'totalStudents' => 38,
            'dueDate' => 'Jan 22, 2025',
            'status' => 'in_progress',
            'priority' => 'medium'
        ],
        [
            'id' => 3,
            'title' => 'Network Security Quiz',
            'course' => 'CS 301 - Computer Networks',
            'submissions' => 50,
            'totalStudents' => 52,
            'dueDate' => 'Jan 18, 2025',
            'status' => 'pending',
            'priority' => 'high'
        ]
    ],
    'students' => [
        [
            'id' => 1,
            'name' => 'Francis',
            'email' => 'john.doe@student.clsu.edu.ph',
            'course' => 'CS 101',
            'lastActivity' => '2 hours ago',
            'status' => 'active',
            'avatar' => 'JD'
        ],
        [
            'id' => 2,
            'name' => 'Lorenz',
            'email' => 'jane.smith@student.clsu.edu.ph',
            'course' => 'CS 201',
            'lastActivity' => '4 hours ago',
            'status' => 'active',
            'avatar' => 'JS'
        ],
        [
            'id' => 3,
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@student.clsu.edu.ph',
            'course' => 'CS 301',
            'lastActivity' => '1 day ago',
            'status' => 'inactive',
            'avatar' => 'MJ'
        ],
        [
            'id' => 4,
            'name' => 'Sarah Wilson',
            'email' => 'sarah.wilson@student.clsu.edu.ph',
            'course' => 'CS 101',
            'lastActivity' => '3 hours ago',
            'status' => 'active',
            'avatar' => 'SW'
        ]
    ]
])

<x-instructor.layout.app 
    title="CLSU Instructor Dashboard - Learning Management System"
    activeItem="dashboard"
    :user="$user"
    :notifications="['assignments' => 8, 'students' => 3]"
>
    <!-- Welcome Section -->
    <x-instructor.sections.welcome-card 
        :user="$user"
        message="You have 3 assignments to grade and 2 upcoming classes."
        :showCreateCourse="true"
        :showViewAnalytics="true"
    />

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($stats as $stat)
            <x-instructor.cards.stat-card 
                :icon="$stat['icon']"
                :iconBg="$stat['iconBg']"
                :value="$stat['value']"
                :label="$stat['label']"
                :progress="$stat['progress']"
                :trend="$stat['trend']"
                :trendValue="$stat['trendValue']"
                :description="$stat['description']"
            />
        @endforeach
    </div>
    
    <!-- My Courses Section -->
    <section class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-chalkboard-teacher mr-3 text-green-600"></i>
                My Courses
            </h2>
            <button class="btn-primary" onclick="window.location.href='{{ route('instructor.course.create') }}'">
                <i class="fas fa-plus mr-2"></i>
                Create New Course
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <x-instructor.cards.course-card :course="$course" />
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if(count($courses) > 6)
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                        Previous
                    </button>
                    <button class="px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700">
                        1
                    </button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                        2
                    </button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                        3
                    </button>
                    <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                        Next
                    </button>
                </nav>
            </div>
        @endif
    </section>

    <!-- Pending Assignments & Recent Students -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Pending Assignments -->
        <x-instructor.sections.pending-assignments :assignments="$assignments" />

        <!-- Recent Students -->
        <x-instructor.sections.recent-students :students="$students" />
    </div>

    <!-- Quick Actions -->
    <x-instructor.sections.quick-actions />
</x-instructor.layout.app>
