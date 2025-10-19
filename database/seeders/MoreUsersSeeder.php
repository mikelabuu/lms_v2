<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MoreUsersSeeder extends Seeder
{
    public function run()
    {
        // Create more students
        $students = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '123 University Ave, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '456 College St, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Carol Davis',
                'email' => 'carol.davis@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'pending',
                'address' => '789 Campus Rd, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '321 Academic Blvd, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Eva Brown',
                'email' => 'eva.brown@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '654 Scholar St, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Frank Miller',
                'email' => 'frank.miller@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'rejected',
                'address' => '987 Education Ave, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Grace Lee',
                'email' => 'grace.lee@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '147 Learning Ln, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Henry Garcia',
                'email' => 'henry.garcia@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '258 Knowledge Dr, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Ivy Martinez',
                'email' => 'ivy.martinez@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'pending',
                'address' => '369 Study St, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Jack Anderson',
                'email' => 'jack.anderson@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '741 Research Rd, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Kate Taylor',
                'email' => 'kate.taylor@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '852 Innovation Ave, Science City of Muñoz, Nueva Ecija'
            ],
            [
                'name' => 'Liam Thomas',
                'email' => 'liam.thomas@student.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'address' => '963 Discovery Dr, Science City of Muñoz, Nueva Ecija'
            ]
        ];

        foreach ($students as $student) {
            User::create($student);
        }

        // Create more instructors
        $instructors = [
            [
                'name' => 'Dr. Sarah Williams',
                'email' => 'sarah.williams@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Computer Science Department, CLSU'
            ],
            [
                'name' => 'Prof. Michael Brown',
                'email' => 'michael.brown@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Information Technology Department, CLSU'
            ],
            [
                'name' => 'Dr. Jennifer Davis',
                'email' => 'jennifer.davis@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'pending',
                'address' => 'Software Engineering Department, CLSU'
            ],
            [
                'name' => 'Prof. Robert Wilson',
                'email' => 'robert.wilson@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Data Science Department, CLSU'
            ],
            [
                'name' => 'Dr. Lisa Garcia',
                'email' => 'lisa.garcia@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Cybersecurity Department, CLSU'
            ],
            [
                'name' => 'Prof. James Martinez',
                'email' => 'james.martinez@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'rejected',
                'address' => 'Network Engineering Department, CLSU'
            ],
            [
                'name' => 'Dr. Maria Rodriguez',
                'email' => 'maria.rodriguez@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Artificial Intelligence Department, CLSU'
            ],
            [
                'name' => 'Prof. David Thompson',
                'email' => 'david.thompson@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Web Development Department, CLSU'
            ],
            [
                'name' => 'Dr. Anna White',
                'email' => 'anna.white@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'pending',
                'address' => 'Mobile Development Department, CLSU'
            ],
            [
                'name' => 'Prof. Kevin Harris',
                'email' => 'kevin.harris@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Database Systems Department, CLSU'
            ],
            [
                'name' => 'Dr. Rachel Clark',
                'email' => 'rachel.clark@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'Cloud Computing Department, CLSU'
            ],
            [
                'name' => 'Prof. Mark Lewis',
                'email' => 'mark.lewis@instructor.clsu.edu.ph',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'status' => 'approved',
                'address' => 'DevOps Department, CLSU'
            ]
        ];

        foreach ($instructors as $instructor) {
            User::create($instructor);
        }

        $this->command->info('Created 12 students and 12 instructors for testing pagination!');
    }
}
