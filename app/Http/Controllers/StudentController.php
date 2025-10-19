<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\CourseContent;
use App\Http\Controllers\EnrollmentController;

class StudentController extends Controller
{
    public function dashboard($studentId = null)
    {
        // If studentId is provided (from test route), use it; otherwise use authenticated user or first student
        $currentStudentId = $studentId ?? (auth()->id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1);
        
        $user = [
            'name' => 'Francis',
            'program' => 'BS Computer Science',
            'initials' => 'JD'
        ];

        $stats = [
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
        ];

        $courses = [
            [
                'id' => 'cs101',
                'title' => 'Introduction to Programming',
                'code' => 'CS 101',
                'description' => 'Learn the fundamentals of computer programming with Python and JavaScript.',
                'progress' => 78,
                'students' => 45,
                'icon' => 'fas fa-code'
            ],
            [
                'id' => 'cs201',
                'title' => 'Database Management',
                'code' => 'CS 201',
                'description' => 'Master SQL and database design principles for modern applications.',
                'progress' => 65,
                'students' => 38,
                'icon' => 'fas fa-database'
            ],
            [
                'id' => 'cs301',
                'title' => 'Computer Networks',
                'code' => 'CS 301',
                'description' => 'Understanding network protocols, security, and infrastructure.',
                'progress' => 42,
                'students' => 52,
                'icon' => 'fas fa-network-wired'
            ],
            [
                'id' => 'cs401',
                'title' => 'Mobile App Development',
                'code' => 'CS 401',
                'description' => 'Build cross-platform mobile applications using React Native.',
                'progress' => 90,
                'students' => 29,
                'icon' => 'fas fa-mobile-alt'
            ],
            [
                'id' => 'cs501',
                'title' => 'Cybersecurity Fundamentals',
                'code' => 'CS 501',
                'description' => 'Learn about network security, encryption, and ethical hacking.',
                'progress' => 35,
                'students' => 41,
                'icon' => 'fas fa-shield-alt'
            ],
            [
                'id' => 'cs601',
                'title' => 'Artificial Intelligence',
                'code' => 'CS 601',
                'description' => 'Introduction to machine learning, neural networks, and AI algorithms.',
                'progress' => 28,
                'students' => 33,
                'icon' => 'fas fa-brain'
            ]
        ];

        $activities = [
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
        ];

        $events = [
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
        ];

        // Reflect session enrollment state in dashboard course list
        // Get enrolled courses from database
        $enrollmentController = new EnrollmentController();
        $enrolledCourses = $enrollmentController->getEnrolledCourses($currentStudentId);
        
        // Convert to the format expected by the dashboard
        $courses = $enrolledCourses->map(function ($course) {
            return [
                'id' => $course['id'],
                'title' => $course['title'],
                'code' => $course['code'],
                'description' => $course['description'],
                'progress' => rand(20, 90), // Random progress for demo
                'students' => rand(20, 60), // Random student count for demo
                'icon' => 'fas fa-book'
            ];
        })->toArray();

        return view('student.dashboard', compact('user', 'stats', 'courses', 'activities', 'events'));
    }

    public function courses()
    {
        $user = [
            'name' => 'Francis',
            'program' => 'BS Computer Science',
            'initials' => 'JD'
        ];

        $courses = [
            [
                'id' => 'cs101',
                'title' => 'Introduction to Programming',
                'code' => 'CS 101',
                'description' => 'Learn the fundamentals of computer programming with Python and JavaScript.',
                'progress' => 78,
                'students' => 45,
                'icon' => 'fas fa-code'
            ],
            [
                'id' => 'cs201',
                'title' => 'Database Management',
                'code' => 'CS 201',
                'description' => 'Master SQL and database design principles for modern applications.',
                'progress' => 65,
                'students' => 38,
                'icon' => 'fas fa-database'
            ],
            [
                'id' => 'cs301',
                'title' => 'Computer Networks',
                'code' => 'CS 301',
                'description' => 'Understanding network protocols, security, and infrastructure.',
                'progress' => 42,
                'students' => 52,
                'icon' => 'fas fa-network-wired'
            ],
            [
                'id' => 'cs401',
                'title' => 'Mobile App Development',
                'code' => 'CS 401',
                'description' => 'Build cross-platform mobile applications using React Native.',
                'progress' => 90,
                'students' => 29,
                'icon' => 'fas fa-mobile-alt'
            ],
            [
                'id' => 'cs501',
                'title' => 'Cybersecurity Fundamentals',
                'code' => 'CS 501',
                'description' => 'Learn about network security, encryption, and ethical hacking.',
                'progress' => 35,
                'students' => 41,
                'icon' => 'fas fa-shield-alt'
            ],
            [
                'id' => 'cs601',
                'title' => 'Artificial Intelligence',
                'code' => 'CS 601',
                'description' => 'Introduction to machine learning, neural networks, and AI algorithms.',
                'progress' => 28,
                'students' => 33,
                'icon' => 'fas fa-brain'
            ]
        ];

        $notifications = ['courses' => 5, 'assignments' => 2];
        
        // Get enrolled courses from database with pagination
        $enrollmentController = new EnrollmentController();
        $studentId = auth()->id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1;
        
        // Get enrolled courses with pagination
        $enrolledCourses = Enrollment::with(['course', 'course.instructor'])
            ->where('student_id', $studentId)
            ->where('status', 'active')
            ->paginate(6)
            ->through(function ($enrollment) {
                return [
                    'id' => $enrollment->course->id,
                    'title' => $enrollment->course->title,
                    'code' => $enrollment->course->code,
                    'description' => $enrollment->course->description,
                    'instructor' => $enrollment->course->instructor->name,
                    'enrolled_at' => $enrollment->enrolled_at->format('M j, Y'),
                    'status' => $enrollment->status,
                ];
            });
        
        return view('student.courses', compact('user', 'notifications', 'enrolledCourses'));
    }

    public function showCourse($id)
    {
        $courseData = [
            'cs101' => [
                'id' => 'cs101',
                'title' => 'Introduction to Programming',
                'code' => 'CS 101 - 3 Units',
                'description' => 'This course introduces students to the fundamental concepts of computer programming. Students will learn problem-solving techniques, algorithm design, and implementation using modern programming languages. The course covers variables, control structures, functions, arrays, and object-oriented programming principles.',
                'progress' => 78,
                'enrolled' => true,
                'enrollmentDate' => 'Jan 15, 2025',
                'icon' => 'fas fa-code',
                'instructor' => [
                    'name' => 'Dr. John Smith',
                    'department' => 'Computer Science Department',
                    'email' => 'j.smith@clsu.edu.ph',
                    'initials' => 'JS'
                ]
            ],
            'cs201' => [
                'id' => 'cs201',
                'title' => 'Database Management',
                'code' => 'CS 201 - 3 Units',
                'description' => 'Master SQL and database design principles for modern applications. Learn about relational database concepts, normalization, indexing, and query optimization.',
                'progress' => 65,
                'enrolled' => true,
                'enrollmentDate' => 'Jan 15, 2025',
                'icon' => 'fas fa-database',
                'instructor' => [
                    'name' => 'Dr. Jane Doe',
                    'department' => 'Computer Science Department',
                    'email' => 'j.doe@clsu.edu.ph',
                    'initials' => 'JD'
                ]
            ],
            'cs301' => [
                'id' => 'cs301',
                'title' => 'Computer Networks',
                'code' => 'CS 301 - 3 Units',
                'description' => 'Understanding network protocols, security, and infrastructure. Learn about TCP/IP, routing, switching, and network security fundamentals.',
                'progress' => 42,
                'enrolled' => true,
                'enrollmentDate' => 'Jan 15, 2025',
                'icon' => 'fas fa-network-wired',
                'instructor' => [
                    'name' => 'Dr. Mike Johnson',
                    'department' => 'Computer Science Department',
                    'email' => 'm.johnson@clsu.edu.ph',
                    'initials' => 'MJ'
                ]
            ],
            'cs401' => [
                'id' => 'cs401',
                'title' => 'Mobile App Development',
                'code' => 'CS 401 - 3 Units',
                'description' => 'Build cross-platform mobile applications using React Native. Learn about mobile UI/UX design, state management, and app deployment.',
                'progress' => 90,
                'enrolled' => true,
                'enrollmentDate' => 'Jan 15, 2025',
                'icon' => 'fas fa-mobile-alt',
                'instructor' => [
                    'name' => 'Dr. Sarah Wilson',
                    'department' => 'Computer Science Department',
                    'email' => 's.wilson@clsu.edu.ph',
                    'initials' => 'SW'
                ]
            ],
            'cs501' => [
                'id' => 'cs501',
                'title' => 'Cybersecurity Fundamentals',
                'code' => 'CS 501 - 3 Units',
                'description' => 'Learn about network security, encryption, and ethical hacking. Understand security threats, vulnerabilities, and defense mechanisms.',
                'progress' => 35,
                'enrolled' => true,
                'enrollmentDate' => 'Jan 15, 2025',
                'icon' => 'fas fa-shield-alt',
                'instructor' => [
                    'name' => 'Dr. Alex Brown',
                    'department' => 'Computer Science Department',
                    'email' => 'a.brown@clsu.edu.ph',
                    'initials' => 'AB'
                ]
            ],
            'cs601' => [
                'id' => 'cs601',
                'title' => 'Artificial Intelligence',
                'code' => 'CS 601 - 3 Units',
                'description' => 'Introduction to machine learning, neural networks, and AI algorithms. Explore supervised and unsupervised learning techniques.',
                'progress' => 28,
                'enrolled' => false,
                'enrollmentDate' => null,
                'icon' => 'fas fa-brain',
                'instructor' => [
                    'name' => 'Dr. Emily Davis',
                    'department' => 'Computer Science Department',
                    'email' => 'e.davis@clsu.edu.ph',
                    'initials' => 'ED'
                ]
            ]
        ];

        $user = [
            'name' => 'Francis',
            'program' => 'BS Computer Science',
            'initials' => 'JD'
        ];
        
        $notifications = ['courses' => 5, 'assignments' => 2];
        
        // Get course from database
        $course = Course::with('instructor')->find($id);
        
        if (!$course) {
            abort(404);
        }

        // Check if student is enrolled
        $studentId = auth()->id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1;
        $enrollment = Enrollment::where('student_id', $studentId)
            ->where('course_id', $id)
            ->where('status', 'active')
            ->first();

        if (!$enrollment) {
            return redirect()->route('student.catalog')->with('error', 'You are not enrolled in this course.');
        }

        // Get course content
        $contents = CourseContent::where('course_id', $id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($content) {
                return [
                    'id' => $content->id,
                    'title' => $content->title,
                    'description' => $content->description,
                    'type' => 'pdf',
                    'uploaded_at' => $content->uploaded_at->format('M j, Y'),
                    'status' => $content->status,
                    'file_path' => $content->file_path
                ];
            });

        $courseData = [
            'id' => $course->id,
            'title' => $course->title,
            'code' => $course->code,
            'description' => $course->description,
            'instructor' => [
                'name' => $course->instructor->name,
                'department' => 'Computer Science Department',
                'email' => $course->instructor->email,
                'initials' => substr($course->instructor->name, 0, 2)
            ],
            'enrolled' => true,
            'enrollmentDate' => $enrollment->enrolled_at->format('M j, Y'),
            'icon' => 'fas fa-book'
        ];
        
        return view('student.course.show', compact('user', 'notifications', 'courseData', 'contents'));
    }

    public function toggleEnrollment(Request $request, $id)
    {
        $enrolledIds = session('enrollments', []);
        $isUnenrolling = $request->has('unenroll');

        if ($isUnenrolling) {
            $enrolledIds = array_values(array_filter($enrolledIds, function ($courseId) use ($id) {
                return $courseId !== $id;
            }));
            session(['enrollments' => $enrolledIds]);
            return redirect()->back()->with('status', 'You have unenrolled from the course.');
        }

        if (!in_array($id, $enrolledIds, true)) {
            $enrolledIds[] = $id;
            session(['enrollments' => $enrolledIds]);
        }

        return redirect()->back()->with('status', 'You have enrolled in the course.');
    }

    public function catalog()
    {
        $user = [
            'name' => 'Francis',
            'program' => 'BS Computer Science',
            'initials' => 'JD'
        ];

        // Use same demo course dataset as other methods
        $all = [
            ['id' => 'cs101','title' => 'Introduction to Programming','code' => 'CS 101','description' => 'Learn the fundamentals of computer programming with Python and JavaScript.','progress' => 78,'students' => 45,'icon' => 'fas fa-code'],
            ['id' => 'cs201','title' => 'Database Management','code' => 'CS 201','description' => 'Master SQL and database design principles for modern applications.','progress' => 65,'students' => 38,'icon' => 'fas fa-database'],
            ['id' => 'cs301','title' => 'Computer Networks','code' => 'CS 301','description' => 'Understanding network protocols, security, and infrastructure.','progress' => 42,'students' => 52,'icon' => 'fas fa-network-wired'],
            ['id' => 'cs401','title' => 'Mobile App Development','code' => 'CS 401','description' => 'Build cross-platform mobile applications using React Native.','progress' => 90,'students' => 29,'icon' => 'fas fa-mobile-alt'],
            ['id' => 'cs501','title' => 'Cybersecurity Fundamentals','code' => 'CS 501','description' => 'Learn about network security, encryption, and ethical hacking.','progress' => 35,'students' => 41,'icon' => 'fas fa-shield-alt'],
            ['id' => 'cs601','title' => 'Artificial Intelligence','code' => 'CS 601','description' => 'Introduction to machine learning, neural networks, and AI algorithms.','progress' => 28,'students' => 33,'icon' => 'fas fa-brain'],
        ];

        $notifications = ['courses' => 5, 'assignments' => 2];
        
        // Get available courses from database with pagination
        $enrollmentController = new EnrollmentController();
        $studentId = auth()->id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1;
        
        // Get enrolled course IDs to exclude them from available courses
        $enrolledCourseIds = Enrollment::where('student_id', $studentId)
            ->pluck('course_id')
            ->toArray();

        // Get available courses with pagination
        $availableCourses = Course::with('instructor')
            ->where('status', 'approved')
            ->whereNotIn('id', $enrolledCourseIds)
            ->paginate(6)
            ->through(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'code' => $course->code,
                    'description' => $course->description,
                    'instructor' => $course->instructor->name,
                    'enrollment_count' => $course->enrollment_count,
                    'difficulty' => $course->difficulty,
                ];
            });
        
        return view('student.catalog', compact('user', 'notifications', 'availableCourses'));
    }

    public function resources()
    {
        $user = [
            'name' => 'Francis',
            'program' => 'BS Computer Science',
            'initials' => 'JD'
        ];
        
        $notifications = ['courses' => 5, 'assignments' => 2];
        
        // Sample resources data - in real app, this would come from database
        $allResources = [
            [
                'id' => 1,
                'name' => 'Introduction to Programming',
                'description' => 'Basic programming concepts and syntax',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 101',
                'instructor' => 'Dr. Smith',
                'uploaded_at' => now()->subDays(5)
            ],
            [
                'id' => 2,
                'name' => 'Data Structures Lecture',
                'description' => 'Video lecture on arrays and linked lists',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 201',
                'instructor' => 'Dr. Johnson',
                'uploaded_at' => now()->subDays(3)
            ],
            [
                'id' => 3,
                'name' => 'Algorithm Flowchart',
                'description' => 'Visual representation of sorting algorithms',
                'type' => 'image',
                'icon' => 'fas fa-image',
                'course' => 'CS 301',
                'instructor' => 'Dr. Williams',
                'uploaded_at' => now()->subDays(1)
            ],
            [
                'id' => 4,
                'name' => 'Database Design Guide',
                'description' => 'Comprehensive guide to database normalization',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'instructor' => 'Dr. Johnson',
                'uploaded_at' => now()->subDays(7)
            ],
            [
                'id' => 5,
                'name' => 'Network Security Tutorial',
                'description' => 'Step-by-step security implementation guide',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 301',
                'instructor' => 'Dr. Williams',
                'uploaded_at' => now()->subDays(2)
            ],
            [
                'id' => 6,
                'name' => 'Web Development Fundamentals',
                'description' => 'HTML, CSS, and JavaScript basics',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 101',
                'instructor' => 'Dr. Smith',
                'uploaded_at' => now()->subDays(4)
            ],
            [
                'id' => 7,
                'name' => 'Machine Learning Overview',
                'description' => 'Introduction to AI and ML concepts',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(6)
            ],
            [
                'id' => 8,
                'name' => 'Mobile App Development',
                'description' => 'React Native tutorial series',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(8)
            ],
            [
                'id' => 9,
                'name' => 'Software Engineering Process',
                'description' => 'SDLC and project management',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'instructor' => 'Dr. Johnson',
                'uploaded_at' => now()->subDays(9)
            ],
            [
                'id' => 10,
                'name' => 'Cybersecurity Basics',
                'description' => 'Network security and encryption',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 301',
                'instructor' => 'Dr. Williams',
                'uploaded_at' => now()->subDays(10)
            ],
            [
                'id' => 11,
                'name' => 'Cloud Computing Guide',
                'description' => 'AWS and Azure fundamentals',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(11)
            ],
            [
                'id' => 12,
                'name' => 'DevOps Practices',
                'description' => 'CI/CD and deployment strategies',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(12)
            ],
            [
                'id' => 13,
                'name' => 'Advanced Algorithms',
                'description' => 'Complex algorithm analysis and design',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 301',
                'instructor' => 'Dr. Williams',
                'uploaded_at' => now()->subDays(13)
            ],
            [
                'id' => 14,
                'name' => 'Database Optimization',
                'description' => 'Performance tuning and indexing strategies',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 201',
                'instructor' => 'Dr. Johnson',
                'uploaded_at' => now()->subDays(14)
            ],
            [
                'id' => 15,
                'name' => 'UI/UX Design Principles',
                'description' => 'User interface and experience design',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 101',
                'instructor' => 'Dr. Smith',
                'uploaded_at' => now()->subDays(15)
            ],
            [
                'id' => 16,
                'name' => 'API Development',
                'description' => 'RESTful API design and implementation',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(16)
            ],
            [
                'id' => 17,
                'name' => 'Testing Strategies',
                'description' => 'Unit testing and quality assurance',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 201',
                'instructor' => 'Dr. Johnson',
                'uploaded_at' => now()->subDays(17)
            ],
            [
                'id' => 18,
                'name' => 'Version Control with Git',
                'description' => 'Git workflow and collaboration',
                'type' => 'link',
                'icon' => 'fas fa-external-link-alt',
                'course' => 'CS 101',
                'instructor' => 'Dr. Smith',
                'uploaded_at' => now()->subDays(18)
            ],
            [
                'id' => 19,
                'name' => 'Docker Containerization',
                'description' => 'Container deployment and management',
                'type' => 'video',
                'icon' => 'fas fa-video',
                'course' => 'CS 401',
                'instructor' => 'Dr. Brown',
                'uploaded_at' => now()->subDays(19)
            ],
            [
                'id' => 20,
                'name' => 'System Architecture',
                'description' => 'Scalable system design patterns',
                'type' => 'document',
                'icon' => 'fas fa-file-pdf',
                'course' => 'CS 301',
                'instructor' => 'Dr. Williams',
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
        
        return view('student.resources', compact('user', 'notifications', 'resources'));
    }
}
