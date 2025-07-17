<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isInstructor()) {
            return $this->instructorDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'pending_courses' => Course::pending()->count(),
            'published_courses' => Course::published()->count(),
        ];

        $pendingCourses = Course::pending()->with('user')->latest()->take(5)->get();

        return view('dashboard.admin', compact('stats', 'pendingCourses'));
    }

    private function instructorDashboard()
    {
        $courses = auth()->user()->courses()->withCount('students')->latest()->get();

        return view('dashboard.instructor', compact('courses'));
    }

    private function studentDashboard()
    {
        $enrolledCourses = auth()->user()->enrolledCourses()->latest()->get();

        return view('dashboard.student', compact('enrolledCourses'));
    }
}