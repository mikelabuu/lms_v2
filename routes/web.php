<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\EnrollmentController;

Route::get('/', function () {
    return view('welcome');
});

// Debug route to check student data
Route::get('/debug/student/{id}', function ($id) {
    $student = \App\Models\User::find($id);
    $enrollments = \App\Models\Enrollment::where('student_id', $id)->with('course')->get();
    $availableCourses = \App\Models\Course::where('status', 'approved')->get();
    
    return response()->json([
        'student' => $student,
        'enrollments' => $enrollments,
        'available_courses' => $availableCourses->count(),
        'total_courses' => $availableCourses->count()
    ]);
});

// Debug route to list all students
Route::get('/debug/students', function () {
    $students = \App\Models\User::where('role', 'student')->get(['id', 'name', 'email']);
    return response()->json($students);
});

// Debug route to check enrollments
Route::get('/debug/enrollments', function () {
    $enrollments = \App\Models\Enrollment::with(['student', 'course'])->get();
    return response()->json($enrollments);
});

// Test student dashboard with specific student ID
Route::get('/test/student/{id}', [StudentController::class, 'dashboard']);

// Debug route for instructor course
Route::get('/debug/instructor/course/{id}', function($id) {
    $course = \App\Models\Course::find($id);
    if (!$course) {
        return response()->json(['error' => 'Course not found', 'id' => $id]);
    }
    return response()->json([
        'id' => $course->id,
        'title' => $course->title,
        'code' => $course->code,
        'status' => $course->status
    ]);
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/catalog', [StudentController::class, 'catalog'])->name('catalog');
    Route::get('/courses/{id}', [StudentController::class, 'showCourse'])->name('course.show');
    Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'enroll'])->name('course.enroll');
    Route::post('/courses/{id}/unenroll', [EnrollmentController::class, 'unenroll'])->name('course.unenroll');
    
    Route::get('/schedule', function () {
        return view('student.schedule');
    })->name('schedule');
    
    Route::get('/assignments', function () {
        return view('student.assignments');
    })->name('assignments');
    
    Route::get('/grades', function () {
        return view('student.grades');
    })->name('grades');
    
    Route::get('/discussions', function () {
        return view('student.discussions');
    })->name('discussions');
    
    Route::get('/resources', [StudentController::class, 'resources'])->name('resources');
});

// Instructor Routes
Route::prefix('instructor')->name('instructor.')->group(function () {
    Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses', [InstructorController::class, 'courses'])->name('courses');
    Route::get('/courses/{id}', [InstructorController::class, 'showCourse'])->name('course.show');
    Route::get('/courses/{id}/edit', [InstructorController::class, 'editCourse'])->name('course.edit');
    Route::put('/courses/{id}', [InstructorController::class, 'updateCourse'])->name('course.update');
    Route::get('/course/create', [InstructorController::class, 'createCourse'])->name('course.create');
    Route::post('/course', [InstructorController::class, 'storeCourse'])->name('course.store');
    Route::post('/courses/{id}/contents', [CourseContentController::class, 'store'])->name('course.content.store');
    Route::put('/courses/{id}/contents/{contentId}', [CourseContentController::class, 'update'])->name('course.content.update');
    Route::delete('/courses/{id}/contents/{contentId}', [CourseContentController::class, 'destroy'])->name('course.content.delete');
    
    Route::get('/students', [InstructorController::class, 'students'])->name('students');
    Route::get('/students/{id}', [InstructorController::class, 'showStudent'])->name('student.show');
    
    Route::get('/assignments', [InstructorController::class, 'assignments'])->name('assignments');
    Route::get('/assignments/{id}', [InstructorController::class, 'showAssignment'])->name('assignment.show');
    Route::get('/assignment/create', [InstructorController::class, 'createAssignment'])->name('assignment.create');
    
    Route::get('/grades', [InstructorController::class, 'grades'])->name('grades');
    Route::get('/analytics', [InstructorController::class, 'analytics'])->name('analytics');
    Route::get('/discussions', [InstructorController::class, 'discussions'])->name('discussions');
    Route::get('/resources', [InstructorController::class, 'resources'])->name('resources');
    Route::get('/schedule', [InstructorController::class, 'schedule'])->name('schedule');
    Route::get('/settings', [InstructorController::class, 'settings'])->name('settings');
});

// File serving route for course content
Route::get('/course-content/{instructor}/{file}', [CourseContentController::class, 'serve'])->name('course.content.serve');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Instructor Management
    Route::get('/instructors', [AdminController::class, 'instructors'])->name('instructors');
    Route::get('/instructors/create', [AdminController::class, 'createInstructor'])->name('instructors.create');
    Route::post('/instructors', [AdminController::class, 'storeInstructor'])->name('instructors.store');
    Route::get('/instructors/{instructor}', [AdminController::class, 'showInstructor'])->name('instructors.show');
    Route::get('/instructors/{instructor}/edit', [AdminController::class, 'editInstructor'])->name('instructors.edit');
    Route::put('/instructors/{instructor}', [AdminController::class, 'updateInstructor'])->name('instructors.update');
    Route::delete('/instructors/{instructor}', [AdminController::class, 'destroyInstructor'])->name('instructors.destroy');
    
    // Student Management
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('students.create');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('students.store');
    Route::get('/students/{student}', [AdminController::class, 'showStudent'])->name('students.show');
    Route::get('/students/{student}/edit', [AdminController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{student}', [AdminController::class, 'updateStudent'])->name('students.update');
    Route::delete('/students/{student}', [AdminController::class, 'destroyStudent'])->name('students.destroy');
    
    // Course Management
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::get('/courses/{course}', [AdminController::class, 'showCourse'])->name('courses.show');
    Route::get('/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
    Route::put('/courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{course}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
});
