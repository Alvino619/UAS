<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseApprovalController extends Controller
{
    /**
     * Display pending courses awaiting approval
     */
    public function index()
    {
        $pendingCourses = Course::where('status', 'pending')
            ->with('user') // Eager load the user who uploaded
            ->latest()
            ->paginate(10);

        return view('admin.courses.pending', compact('pendingCourses'));
    }

    /**
     * Approve a course (change status to published)
     */
    public function approve(Course $course)
    {
        $course->update([
            'status' => 'published',
            'rejection_reason' => null // Clear any previous rejection reason
        ]);

        return back()
            ->with('success', 'Course published successfully!');
    }

    /**
     * Reject a course with reason
     */
    public function reject(Request $request, Course $course)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:255'
        ]);

        $course->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()
            ->with('success', 'Course rejected with reason.');
    }
}