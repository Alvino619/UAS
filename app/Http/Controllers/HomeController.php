<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::published()
            ->with(['user', 'category'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('courses')->get();

        return view('home', compact('courses', 'categories'));
    }

    public function courses(Request $request)
    {
        $query = Course::published()->with(['user', 'category']);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(12);
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        if ($course->status !== 'published') {
            abort(404);
        }

        $course->load(['user', 'category', 'materials']);

        $isEnrolled = auth()->check() && auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists();

        return view('courses.show', compact('course', 'isEnrolled'));
    }
}