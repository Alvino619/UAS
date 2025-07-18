<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // Remove constructor - middleware applied in routes instead
    
    public function index()
    {
        $courses = auth()->user()->courses()->with('category')->latest()->get();
        return view('courses.manage.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('courses.manage.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            
            // Copy file ke public/storage untuk akses langsung
            $this->copyToPublicStorage($thumbnailPath);
        }

        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'thumbnail' => $thumbnailPath,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('courses.manage.show', $course)->with('success', 'Course created successfully and submitted for approval.');
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);
        $course->load(['materials', 'comments.user', 'comments.replies.user']);
        return view('courses.manage.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        $categories = Category::all();
        return view('courses.manage.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
                $this->deleteFromPublicStorage($course->thumbnail);
            }
            
            // Upload file baru
            $course->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            
            // Copy file ke public/storage
            $this->copyToPublicStorage($course->thumbnail);
        }

        $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $course->status === 'published' ? 'published' : 'pending',
        ]);

        return redirect()->route('courses.manage.show', $course)->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
            $this->deleteFromPublicStorage($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('courses.manage.index')->with('success', 'Course deleted successfully.');
    }

    public function enroll(Course $course)
    {
        if ($course->status !== 'published') {
            return redirect()->back()->with('error', 'Course is not available for enrollment.');
        }

        $user = auth()->user();

        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        $user->enrollments()->create([
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Successfully enrolled in the course.');
    }

    public function unenroll(Course $course)
    {
        $user = auth()->user();
        $user->enrollments()->where('course_id', $course->id)->delete();

        return redirect()->back()->with('success', 'Successfully unenrolled from the course.');
    }

    public function storeMaterial(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:article,image,pdf,audio,video',
            'file_path' => 'nullable|file',
            'content' => 'nullable|string',
            'order' => 'integer|min:0',
        ]);

        $materialData = $request->only(['title', 'description', 'type', 'content', 'order']);
        
        if ($request->hasFile('file_path')) {
            $materialData['file_path'] = $request->file('file_path')->store('materials', 'public');
            
            // Copy material file ke public/storage juga
            $this->copyToPublicStorage($materialData['file_path']);
        }

        $course->materials()->create($materialData);

        return redirect()->back()->with('success', 'Material added successfully');
    }

    public function destroyMaterial(Course $course, CourseMaterial $material)
    {
        $this->authorize('update', $course);

        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
            $this->deleteFromPublicStorage($material->file_path);
        }

        $material->delete();

        return redirect()->back()->with('success', 'Material deleted successfully');
    }

    /**
     * Copy file dari storage/app/public ke public/storage
     */
    private function copyToPublicStorage($filePath)
    {
        if (!$filePath) return;

        try {
            $sourcePath = storage_path('app/public/' . $filePath);
            $targetPath = public_path('storage/' . $filePath);
            
            // Buat directory jika belum ada
            $targetDir = dirname($targetPath);
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            
            // Copy file
            if (file_exists($sourcePath)) {
                copy($sourcePath, $targetPath);
            }
        } catch (\Exception $e) {
            // Log error tapi jangan stop process
            \Log::error('Failed to copy file to public storage: ' . $e->getMessage());
        }
    }

    /**
     * Hapus file dari public/storage
     */
    private function deleteFromPublicStorage($filePath)
    {
        if (!$filePath) return;

        try {
            $targetPath = public_path('storage/' . $filePath);
            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
        } catch (\Exception $e) {
            // Log error tapi jangan stop process
            \Log::error('Failed to delete file from public storage: ' . $e->getMessage());
        }
    }
}