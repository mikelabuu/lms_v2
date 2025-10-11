<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    /**
     * Store a newly created course content.
     */
    public function store(Request $request, $courseId)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:draft,published,archived',
                'file' => 'required|file|mimes:pdf|max:10240', // 10MB max
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        }

        try {
            $course = Course::findOrFail($courseId);
            
            // Get the instructor name for directory structure
            $instructorName = $course->instructor->name ?? 'instructor';
            $instructorName = Str::slug($instructorName);
            
            // Generate unique filename
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(16) . '.' . $extension;
            
            // Store file in instructor-specific directory
            $path = $file->storeAs(
                "course_contents/{$instructorName}/{$courseId}",
                $filename,
                'public'
            );

            // Create course content record
            $content = CourseContent::create([
                'course_id' => $courseId,
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path,
                'status' => $request->status,
                'uploaded_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Course content uploaded successfully!',
                'content' => $content
            ]);

        } catch (\Exception $e) {
            \Log::error('Course content upload failed', [
                'course_id' => $courseId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified course content.
     */
    public function update(Request $request, $courseId, $contentId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        try {
            $content = CourseContent::where('course_id', $courseId)
                ->where('id', $contentId)
                ->firstOrFail();

            $content->title = $request->title;
            $content->description = $request->description;
            $content->status = $request->status;

            // Handle file replacement if provided
            if ($request->hasFile('file')) {
                // Delete old file
                if ($content->file_path && Storage::disk('public')->exists($content->file_path)) {
                    Storage::disk('public')->delete($content->file_path);
                }

                // Upload new file
                $course = Course::findOrFail($courseId);
                $instructorName = $course->instructor->name ?? 'instructor';
                $instructorName = Str::slug($instructorName);
                
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(16) . '.' . $extension;
                
                $path = $file->storeAs(
                    "course_contents/{$instructorName}/{$courseId}",
                    $filename,
                    'public'
                );

                $content->file_path = $path;
                $content->uploaded_at = now();
            }

            $content->save();

            return response()->json([
                'success' => true,
                'message' => 'Course content updated successfully!',
                'content' => $content
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified course content.
     */
    public function destroy($courseId, $contentId)
    {
        try {
            $content = CourseContent::where('course_id', $courseId)
                ->where('id', $contentId)
                ->firstOrFail();

            // Delete file from storage
            if ($content->file_path && Storage::disk('public')->exists($content->file_path)) {
                Storage::disk('public')->delete($content->file_path);
            }

            $content->delete();

            return response()->json([
                'success' => true,
                'message' => 'Course content deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Serve course content files.
     */
    public function serve(Request $request, $instructor, $file)
    {
        try {
            // Build file path
            $filePath = "course_contents/{$instructor}/{$file}";
            
            // Check if file exists
            if (!Storage::disk('public')->exists($filePath)) {
                abort(404, 'File not found');
            }

            // Get file info
            $fullPath = Storage::disk('public')->path($filePath);
            $mimeType = Storage::disk('public')->mimeType($filePath);
            
            // Validate it's a PDF
            if ($mimeType !== 'application/pdf') {
                abort(400, 'Invalid file type');
            }

            // Set headers for PDF viewing
            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
                'Cache-Control' => 'public, max-age=3600',
            ]);

        } catch (\Exception $e) {
            abort(404, 'File not found');
        }
    }
}