<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseContent;

class InstructorController extends Controller
{
    private $courseData = [
        'cs101' => [
            'title' => 'Introduction to Programming',
            'code' => 'CS 101 - 3 Units',
            'icon' => 'fas fa-code',
            'description' => 'This course introduces students to the fundamental concepts of computer programming. Students will learn problem-solving techniques, algorithm design, and implementation using modern programming languages. The course covers variables, control structures, functions, arrays, and object-oriented programming principles.',
            'students' => 45,
            'assignments' => 8,
            'status' => 'active',
            'progress' => 75,
            'nextClass' => 'Tomorrow, 9:00 AM',
            'instructor' => 'Dr. Lorenz'
        ],
        'cs201' => [
            'title' => 'Database Management',
            'code' => 'CS 201 - 3 Units',
            'icon' => 'fas fa-database',
            'description' => 'Master SQL and database design principles for modern applications. Learn about relational database concepts, normalization, indexing, and query optimization.',
            'students' => 38,
            'assignments' => 6,
            'status' => 'active',
            'progress' => 65,
            'nextClass' => 'Wednesday, 2:00 PM',
            'instructor' => 'Dr. Lorenz'
        ],
        'cs301' => [
            'title' => 'Computer Networks',
            'code' => 'CS 301 - 3 Units',
            'icon' => 'fas fa-network-wired',
            'description' => 'Understanding network protocols, security, and infrastructure. Learn about TCP/IP, routing, switching, and network security fundamentals.',
            'students' => 52,
            'assignments' => 5,
            'status' => 'active',
            'progress' => 42,
            'nextClass' => 'Friday, 10:00 AM',
            'instructor' => 'Dr. Lorenz'
        ],
        'cs401' => [
            'title' => 'Mobile App Development',
            'code' => 'CS 401 - 3 Units',
            'icon' => 'fas fa-mobile-alt',
            'description' => 'Build cross-platform mobile applications using React Native. Learn about mobile UI/UX design, state management, and app deployment.',
            'students' => 29,
            'assignments' => 7,
            'status' => 'active',
            'progress' => 90,
            'nextClass' => 'Thursday, 1:00 PM',
            'instructor' => 'Dr. Lorenz'
        ],
        'cs501' => [
            'title' => 'Cybersecurity Fundamentals',
            'code' => 'CS 501 - 3 Units',
            'icon' => 'fas fa-shield-alt',
            'description' => 'Learn about network security, encryption, and ethical hacking. Understand security threats, vulnerabilities, and defense mechanisms.',
            'students' => 41,
            'assignments' => 4,
            'status' => 'active',
            'progress' => 35,
            'nextClass' => 'Monday, 3:00 PM',
            'instructor' => 'Dr. Lorenz'
        ],
        'cs601' => [
            'title' => 'Artificial Intelligence',
            'code' => 'CS 601 - 3 Units',
            'icon' => 'fas fa-brain',
            'description' => 'Introduction to machine learning, neural networks, and AI algorithms. Explore supervised and unsupervised learning techniques.',
            'students' => 33,
            'assignments' => 3,
            'status' => 'draft',
            'progress' => 28,
            'nextClass' => 'Tuesday, 11:00 AM',
            'instructor' => 'Dr. Lorenz'
        ]
    ];

    public function dashboard()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        $stats = [
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
        ];
        
        // Get courses from database for dashboard
        $courses = Course::all()->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'code' => $course->code,
                'description' => $course->description,
                'instructor' => 'Dr. Lorenz', // Default instructor name
                'difficulty' => $course->difficulty,
                'status' => $course->status,
                'icon' => 'fas fa-book',
                'assignments' => 8, // Default assignment count
                'progress' => rand(20, 90) // Random progress for demo
            ];
        });
        
        $assignments = [
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
        ];
        
        $students = [
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
        ];

        return view('instructor.dashboard', compact('user', 'notifications', 'stats', 'courses', 'assignments', 'students'));
    }

    public function courses()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        // Get courses from database with pagination
        $allCourses = Course::withCount('enrollments')
            ->paginate(6)
            ->through(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'code' => $course->code,
                    'description' => $course->description,
                    'instructor' => 'Dr. Lorenz', // Default instructor name
                'difficulty' => $course->difficulty,
                'status' => $course->status,
                'created_at' => $course->created_at,
                'icon' => 'fas fa-book',
                'assignments' => 8
                ];
            });
        
        return view('instructor.courses', compact('user', 'notifications', 'allCourses'));
    }

    public function resources()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        // Sample resources data - in real app, this would come from database
        $allResources = [
            [
                'id' => 1,
                'name' => 'Introduction to Programming',
                'description' => 'Basic programming concepts and syntax',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 101',
                'size' => '2.5 MB',
                'uploaded_at' => now()->subDays(5)
            ],
            [
                'id' => 2,
                'name' => 'Data Structures Lecture',
                'description' => 'Video lecture on arrays and linked lists',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 201',
                'size' => '45.2 MB',
                'uploaded_at' => now()->subDays(3)
            ],
            [
                'id' => 3,
                'name' => 'Algorithm Flowchart',
                'description' => 'Visual representation of sorting algorithms',
                'type' => 'image',
                'icon' => 'fas fa-image',
                'course' => 'CS 301',
                'size' => '1.8 MB',
                'uploaded_at' => now()->subDays(1)
            ],
            [
                'id' => 4,
                'name' => 'Database Design Principles',
                'description' => 'Comprehensive guide to database normalization',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'size' => '3.2 MB',
                'uploaded_at' => now()->subDays(7)
            ],
            [
                'id' => 5,
                'name' => 'Web Development Tutorial',
                'description' => 'HTML, CSS, and JavaScript fundamentals',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 101',
                'size' => '120.5 MB',
                'uploaded_at' => now()->subDays(2)
            ],
            [
                'id' => 6,
                'name' => 'Network Security Guide',
                'description' => 'Step-by-step security implementation',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 301',
                'size' => 'N/A',
                'uploaded_at' => now()->subDays(4)
            ],
            [
                'id' => 7,
                'name' => 'Machine Learning Basics',
                'description' => 'Introduction to AI and ML concepts',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 401',
                'size' => '4.8 MB',
                'uploaded_at' => now()->subDays(6)
            ],
            [
                'id' => 8,
                'name' => 'Mobile App Development',
                'description' => 'React Native tutorial series',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'size' => '200.3 MB',
                'uploaded_at' => now()->subDays(8)
            ],
            [
                'id' => 9,
                'name' => 'Software Engineering Process',
                'description' => 'SDLC and project management',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'size' => '2.1 MB',
                'uploaded_at' => now()->subDays(9)
            ],
            [
                'id' => 10,
                'name' => 'Cybersecurity Fundamentals',
                'description' => 'Network security and encryption',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 301',
                'size' => '85.7 MB',
                'uploaded_at' => now()->subDays(10)
            ],
            [
                'id' => 11,
                'name' => 'Cloud Computing Overview',
                'description' => 'AWS and Azure basics',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 401',
                'size' => '3.9 MB',
                'uploaded_at' => now()->subDays(11)
            ],
            [
                'id' => 12,
                'name' => 'DevOps Practices',
                'description' => 'CI/CD and deployment strategies',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 401',
                'size' => 'N/A',
                'uploaded_at' => now()->subDays(12)
            ],
            [
                'id' => 13,
                'name' => 'Advanced Algorithms',
                'description' => 'Complex algorithm analysis and design',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 301',
                'size' => '5.2 MB',
                'uploaded_at' => now()->subDays(13)
            ],
            [
                'id' => 14,
                'name' => 'Database Optimization',
                'description' => 'Performance tuning and indexing strategies',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 201',
                'size' => '95.3 MB',
                'uploaded_at' => now()->subDays(14)
            ],
            [
                'id' => 15,
                'name' => 'UI/UX Design Principles',
                'description' => 'User interface and experience design',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 101',
                'size' => '3.7 MB',
                'uploaded_at' => now()->subDays(15)
            ],
            [
                'id' => 16,
                'name' => 'API Development',
                'description' => 'RESTful API design and implementation',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'size' => '150.8 MB',
                'uploaded_at' => now()->subDays(16)
            ],
            [
                'id' => 17,
                'name' => 'Testing Strategies',
                'description' => 'Unit testing and quality assurance',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'size' => '2.9 MB',
                'uploaded_at' => now()->subDays(17)
            ],
            [
                'id' => 18,
                'name' => 'Version Control with Git',
                'description' => 'Git workflow and collaboration',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 101',
                'size' => 'N/A',
                'uploaded_at' => now()->subDays(18)
            ],
            [
                'id' => 19,
                'name' => 'Docker Containerization',
                'description' => 'Container deployment and management',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'size' => '180.2 MB',
                'uploaded_at' => now()->subDays(19)
            ],
            [
                'id' => 20,
                'name' => 'System Architecture',
                'description' => 'Scalable system design patterns',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 301',
                'size' => '4.1 MB',
                'uploaded_at' => now()->subDays(20)
            ]
        ];

        // Manual pagination
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($allResources, $offset, $perPage);
        $total = count($allResources);
        $lastPage = ceil($total / $perPage);
        
        $resources = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'pageName' => 'page',
            ]
        );
        
        return view('instructor.resources', compact('user', 'notifications', 'resources'));
    }

    public function showCourse($id)
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        // Get course from database
        $course = Course::find($id);

        if (!$course) {
            abort(404);
        }
        
        // Convert to the format expected by the view
        $courseData = [
            'id' => $course->id,
            'title' => $course->title,
            'code' => $course->code,
            'description' => $course->description,
            'instructor' => [
                'name' => 'Dr. Lorenz',
                'department' => 'Computer Science Department',
                'email' => 'dr.lorenz@clsu.edu.ph',
                'initials' => 'DL'
            ],
            'enrollment_count' => $course->enrollment_count,
            'difficulty' => $course->difficulty,
            'status' => $course->status,
            'assignments' => 8, // Default assignment count
            'students' => $course->enrollment_count // For compatibility
        ];

        $students = [
            ['id' => 1, 'name' => 'Francis', 'email' => 'john.doe@student.clsu.edu.ph', 'status' => 'Active', 'lastActivity' => '2h ago'],
            ['id' => 2, 'name' => 'Lorenz', 'email' => 'jane.smith@student.clsu.edu.ph', 'status' => 'Active', 'lastActivity' => '4h ago'],
            ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike.johnson@student.clsu.edu.ph', 'status' => 'Inactive', 'lastActivity' => '1d ago'],
        ];

        // Get course contents from database
        $contents = CourseContent::where('course_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($content) {
                return [
                    'id' => $content->id,
                    'title' => $content->title,
                    'description' => $content->description,
                    'status' => $content->status,
                    'file_path' => $content->file_path,
                    'uploaded_at' => $content->uploaded_at->format('M j, Y g:i A')
                ];
            });
        
        return view('instructor.course.show', compact('user', 'notifications', 'courseData', 'students', 'contents'));
    }

    public function editCourse($id)
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        // Get course from database
        $course = Course::find($id);

        if (!$course) {
            abort(404);
        }
        
        // Convert to the format expected by the view
        $courseData = [
            'id' => $course->id,
            'title' => $course->title,
            'code' => $course->code,
            'description' => $course->description,
            'instructor' => [
                'name' => 'Dr. Lorenz',
                'department' => 'Computer Science Department',
                'email' => 'dr.lorenz@clsu.edu.ph',
                'initials' => 'DL'
            ],
            'enrollment_count' => $course->enrollment_count,
            'difficulty' => $course->difficulty,
            'status' => $course->status,
            'assignments' => 8,
            'students' => $course->enrollment_count
        ];
        
        return view('instructor.course.edit', compact('user', 'notifications', 'courseData'));
    }

    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'description' => 'required|string',
            'difficulty' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,approved,archived'
        ]);

        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }

        $course->update([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description,
            'difficulty' => $request->difficulty,
            'status' => $request->status
        ]);

        return redirect()->route('instructor.course.show', $id)
            ->with('success', 'Course updated successfully!');
    }

    public function students()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        $students = [
            ['id' => 1, 'name' => 'Francis', 'email' => 'john.doe@student.clsu.edu.ph', 'course' => 'CS 101', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Lorenz', 'email' => 'jane.smith@student.clsu.edu.ph', 'course' => 'CS 201', 'status' => 'Active'],
            ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike.johnson@student.clsu.edu.ph', 'course' => 'CS 301', 'status' => 'Inactive'],
            ['id' => 4, 'name' => 'Sarah Wilson', 'email' => 'sarah.wilson@student.clsu.edu.ph', 'course' => 'CS 101', 'status' => 'Active'],
        ];
        return view('instructor.students', compact('user', 'notifications', 'students'));
    }

    public function assignments()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.assignments', compact('user', 'notifications'));
    }

    public function grades()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.grades', compact('user', 'notifications'));
    }

    public function analytics()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.analytics', compact('user', 'notifications'));
    }

    public function discussions()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.discussions', compact('user', 'notifications'));
    }

    public function schedule()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.placeholder', compact('user', 'notifications'))->with([
            'title' => 'Schedule',
            'icon' => 'fas fa-calendar-alt',
            'description' => 'Manage your class schedule and office hours'
        ]);
    }

    public function createCourse()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        return view('instructor.course.create', compact('user', 'notifications'));
    }

    public function showStudent($id)
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.placeholder', compact('user', 'notifications'))->with([
            'title' => 'Student Details',
            'icon' => 'fas fa-user',
            'description' => 'View student information and progress'
        ]);
    }

    public function showAssignment($id)
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.placeholder', compact('user', 'notifications'))->with([
            'title' => 'Assignment Details',
            'icon' => 'fas fa-tasks',
            'description' => 'View and grade assignment submissions'
        ]);
    }

    public function createAssignment()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.placeholder', compact('user', 'notifications'))->with([
            'title' => 'Create Assignment',
            'icon' => 'fas fa-plus',
            'description' => 'Create a new assignment'
        ]);
    }

    public function settings()
    {
        $user = [
            'name' => 'Dr. Lorenz',
            'department' => 'Computer Science',
            'initials' => 'JS'
        ];
        
        $notifications = ['assignments' => 8, 'students' => 3];
        
        return view('instructor.placeholder', compact('user', 'notifications'))->with([
            'title' => 'Settings',
            'icon' => 'fas fa-cog',
            'description' => 'Manage your account and preferences'
        ]);
    }


    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string',
            'title' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'students' => 'nullable|integer',
            'assignments' => 'nullable|integer',
            'status' => 'required|string',
            'progress' => 'nullable|integer',
            'nextClass' => 'nullable|string',
        ]);

        // Demo-only: mutate in-memory structure
        $this->courseData[$validated['id']] = array_merge([
            'icon' => $validated['icon'] ?? 'fas fa-book',
            'students' => $validated['students'] ?? 0,
            'assignments' => $validated['assignments'] ?? 0,
            'progress' => $validated['progress'] ?? 0,
            'nextClass' => $validated['nextClass'] ?? 'TBA',
            'instructor' => 'Dr. Lorenz',
        ], $validated);

        return redirect()->route('instructor.courses')->with('status', 'Course created.');
    }

}
