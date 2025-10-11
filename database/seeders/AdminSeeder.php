<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseContent;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved',
            'address' => 'Central Luzon State University, Science City of Muñoz, Nueva Ecija'
        ]);

        // Create Sample Instructors
        $instructor1 = User::create([
            'name' => 'Dr. Maria Santos',
            'email' => 'maria.santos@clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'status' => 'approved',
            'address' => 'Central Luzon State University, Science City of Muñoz, Nueva Ecija'
        ]);

        $instructor2 = User::create([
            'name' => 'Prof. Juan Dela Cruz',
            'email' => 'juan.delacruz@clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'instructor',
            'status' => 'approved',
            'address' => 'Central Luzon State University, Science City of Muñoz, Nueva Ecija'
        ]);

        // Create Sample Students
        $student1 = User::create([
            'name' => 'John Smith',
            'email' => 'john.smith@student.clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'approved',
            'address' => 'Science City of Muñoz, Nueva Ecija'
        ]);

        $student2 = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@student.clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'approved',
            'address' => 'Science City of Muñoz, Nueva Ecija'
        ]);

        $student3 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@student.clsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 'student',
            'status' => 'pending',
            'address' => 'Science City of Muñoz, Nueva Ecija'
        ]);

        // Create Sample Courses
        $course1 = Course::create([
            'title' => 'Introduction to Computer Science',
            'code' => 'CS 101',
            'description' => 'A comprehensive introduction to computer science fundamentals including programming, algorithms, and data structures.',
            'instructor_id' => $instructor1->id,
            'status' => 'approved',
            'difficulty' => 'beginner',
            'enrollment_count' => 2
        ]);

        $course2 = Course::create([
            'title' => 'Database Management Systems',
            'code' => 'CS 201',
            'description' => 'Learn about database design, SQL, and database administration.',
            'instructor_id' => $instructor2->id,
            'status' => 'approved',
            'difficulty' => 'intermediate',
            'enrollment_count' => 1
        ]);

        $course3 = Course::create([
            'title' => 'Web Development',
            'code' => 'CS 301',
            'description' => 'Modern web development using HTML, CSS, JavaScript, and frameworks.',
            'instructor_id' => $instructor1->id,
            'status' => 'pending',
            'difficulty' => 'intermediate',
            'enrollment_count' => 0
        ]);

        // Create Sample Course Contents
        CourseContent::create([
            'course_id' => $course1->id,
            'title' => 'Introduction to Programming',
            'description' => 'Basic programming concepts and syntax',
            'file_path' => 'sample-content-1.pdf',
            'status' => 'published',
            'uploaded_at' => now()
        ]);

        CourseContent::create([
            'course_id' => $course1->id,
            'title' => 'Variables and Data Types',
            'description' => 'Understanding different data types and variable declarations',
            'file_path' => 'sample-content-2.pdf',
            'status' => 'published',
            'uploaded_at' => now()
        ]);

        CourseContent::create([
            'course_id' => $course2->id,
            'title' => 'Database Design Principles',
            'description' => 'Fundamental principles of database design and normalization',
            'file_path' => 'sample-content-3.pdf',
            'status' => 'published',
            'uploaded_at' => now()
        ]);

        // Create Sample Enrollments
        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
            'enrolled_at' => now()->subDays(5),
            'status' => 'active'
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course1->id,
            'enrolled_at' => now()->subDays(3),
            'status' => 'active'
        ]);

        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
            'enrolled_at' => now()->subDays(2),
            'status' => 'active'
        ]);

        $this->command->info('Sample data created successfully!');
        $this->command->info('Admin Login: admin@clsu.edu.ph / password');
        $this->command->info('Instructor Login: maria.santos@clsu.edu.ph / password');
        $this->command->info('Student Login: john.smith@student.clsu.edu.ph / password');
    }
}