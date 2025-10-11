@props([
    'user' => [
        'name' => 'Francis',
        'program' => 'BS Computer Science',
        'initials' => 'JD'
    ],
    'stats' => [
        [
            'icon' => 'fas fa-book',
            'iconBg' => 'bg-gradient-to-br from-blue-400 to-blue-600',
            'value' => '5',
            'label' => 'Active Courses',
            'progress' => 75
        ],
        [
            'icon' => 'fas fa-check-circle',
            'iconBg' => 'bg-gradient-to-br from-green-400 to-green-600',
            'value' => '23',
            'label' => 'Completed Tasks',
            'progress' => 85
        ],
        [
            'icon' => 'fas fa-trophy',
            'iconBg' => 'bg-gradient-to-br from-purple-400 to-purple-600',
            'value' => '92%',
            'label' => 'Average Grade',
            'progress' => 92
        ],
        [
            'icon' => 'fas fa-clock',
            'iconBg' => 'bg-gradient-to-br from-orange-400 to-orange-600',
            'value' => '48h',
            'label' => 'Study Time',
            'progress' => 60
        ]
    ],
    'courses' => [],
    'activities' => [
        [
            'type' => 'completed',
            'icon' => 'fas fa-check',
            'iconBg' => 'bg-green-100',
            'iconColor' => 'text-green-600',
            'title' => 'Completed Assignment',
            'description' => 'Programming Exercise 3 - Introduction to Programming',
            'time' => '2 hours ago'
        ],
        [
            'type' => 'video',
            'icon' => 'fas fa-video',
            'iconBg' => 'bg-blue-100',
            'iconColor' => 'text-blue-600',
            'title' => 'Watched Video',
            'description' => 'Database Normalization - Database Management',
            'time' => '4 hours ago'
        ],
        [
            'type' => 'comment',
            'icon' => 'fas fa-comment',
            'iconBg' => 'bg-purple-100',
            'iconColor' => 'text-purple-600',
            'title' => 'Posted Comment',
            'description' => 'Computer Networks Discussion Forum',
            'time' => '1 day ago'
        ],
        [
            'type' => 'download',
            'icon' => 'fas fa-download',
            'iconBg' => 'bg-orange-100',
            'iconColor' => 'text-orange-600',
            'title' => 'Downloaded Resource',
            'description' => 'Mobile App Development - React Native Guide',
            'time' => '2 days ago'
        ]
    ],
    'events' => [
        [
            'day' => '15',
            'bgColor' => 'bg-red-500',
            'borderColor' => 'border-red-100',
            'bgLight' => 'bg-red-50',
            'title' => 'Database Quiz',
            'description' => 'Database Management - CS 201',
            'dueDate' => 'Due: Tomorrow, 2:00 PM',
            'dueColor' => 'text-red-600',
            'badge' => 'Urgent',
            'badgeColor' => 'bg-red-100 text-red-800'
        ],
        [
            'day' => '18',
            'bgColor' => 'bg-yellow-500',
            'borderColor' => 'border-yellow-100',
            'bgLight' => 'bg-yellow-50',
            'title' => 'Programming Assignment',
            'description' => 'Introduction to Programming - CS 101',
            'dueDate' => 'Due: Jan 18, 11:59 PM',
            'dueColor' => 'text-yellow-600',
            'badge' => '3 days',
            'badgeColor' => 'bg-yellow-100 text-yellow-800'
        ],
        [
            'day' => '20',
            'bgColor' => 'bg-blue-500',
            'borderColor' => 'border-blue-100',
            'bgLight' => 'bg-blue-50',
            'title' => 'Midterm Exam',
            'description' => 'Computer Networks - CS 301',
            'dueDate' => 'Jan 20, 9:00 AM',
            'dueColor' => 'text-blue-600',
            'badge' => '5 days',
            'badgeColor' => 'bg-blue-100 text-blue-800'
        ],
        [
            'day' => '22',
            'bgColor' => 'bg-green-500',
            'borderColor' => 'border-green-100',
            'bgLight' => 'bg-green-50',
            'title' => 'Project Presentation',
            'description' => 'Mobile App Development - CS 401',
            'dueDate' => 'Jan 22, 1:00 PM',
            'dueColor' => 'text-green-600',
            'badge' => '1 week',
            'badgeColor' => 'bg-green-100 text-green-800'
        ]
    ]
])

<x-student.layout.app 
    title="CLSU Student Dashboard - Learning Management System"
    activeItem="dashboard"
    :user="$user"
    :notifications="['courses' => 5, 'assignments' => 2]"
>
    <!-- Welcome Section -->
    <x-student.sections.welcome-card 
        :user="$user"
        message="You have 3 assignments due this week and 2 upcoming quizzes."
        :showContinueLearning="true"
        :showViewProgress="true"
    />

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach($stats as $stat)
            <x-student.cards.stat-card 
                :icon="$stat['icon']"
                :iconBg="$stat['iconBg']"
                :value="$stat['value']"
                :label="$stat['label']"
                :progress="$stat['progress']"
            />
        @endforeach
    </div>
    
    <!-- Enrolled Courses Section -->
    <section class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-graduation-cap mr-3 text-green-600"></i>
                My Enrolled Courses
            </h2>
            <a class="btn-secondary" href="{{ route('student.catalog') }}">
                <i class="fas fa-plus mr-2"></i>
                Browse More Courses
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <x-student.cards.course-card :course="$course" />
            @endforeach
        </div>
    </section>

    <!-- Recent Activities & Upcoming Events -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Activities -->
        <x-student.sections.recent-activities :activities="$activities" />

        <!-- Upcoming Events -->
        <x-student.sections.upcoming-events :events="$events" />
    </div>

</x-student.layout.app>
