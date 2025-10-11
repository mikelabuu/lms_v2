<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Enroll student in a course
     */
    public function enroll(Request $request, $id)
    {
        try {
            $studentId = Auth::id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1;
            $courseId = $id; // Get course ID from route parameter

            // Check if already enrolled
            $existingEnrollment = Enrollment::where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->first();

            if ($existingEnrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are already enrolled in this course.'
                ], 400);
            }

            // Create enrollment
            Enrollment::create([
                'student_id' => $studentId,
                'course_id' => $courseId,
                'enrolled_at' => now(),
                'status' => 'active',
            ]);

            // Update course enrollment count
            $course = Course::find($courseId);
            $course->increment('enrollment_count');

            return response()->json([
                'success' => true,
                'message' => 'Successfully enrolled in the course!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to enroll: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Unenroll student from a course
     */
    public function unenroll(Request $request, $id)
    {
        try {
            $studentId = Auth::id() ?? \App\Models\User::where('role', 'student')->first()->id ?? 1;
            $courseId = $id; // Get course ID from route parameter

            // Find and delete enrollment
            $enrollment = Enrollment::where('student_id', $studentId)
                ->where('course_id', $courseId)
                ->first();

            if (!$enrollment) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not enrolled in this course.'
                ], 400);
            }

            $enrollment->delete();

            // Update course enrollment count
            $course = Course::find($courseId);
            $course->decrement('enrollment_count');

            return response()->json([
                'success' => true,
                'message' => 'Successfully unenrolled from the course!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to unenroll: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get student's enrolled courses
     */
    public function getEnrolledCourses($studentId)
    {
        $enrollments = Enrollment::with(['course', 'course.instructor'])
            ->where('student_id', $studentId)
            ->where('status', 'active')
            ->get();

        return $enrollments->map(function ($enrollment) {
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
    }

    /**
     * Get available courses for enrollment
     */
    public function getAvailableCourses($studentId)
    {
        $enrolledCourseIds = Enrollment::where('student_id', $studentId)
            ->pluck('course_id')
            ->toArray();

        $courses = Course::with('instructor')
            ->where('status', 'approved')
            ->whereNotIn('id', $enrolledCourseIds)
            ->get();

        return $courses->map(function ($course) {
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
    }
}