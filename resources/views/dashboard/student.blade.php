@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Student Dashboard</h1>
    
    <!-- Enrolled courses -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Your Enrolled Courses</h3>
            <p class="mt-1 text-sm text-gray-500">All courses you're currently enrolled in.</p>
        </div>
        <div class="bg-white overflow-hidden">
            @if($enrolledCourses->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No enrolled courses</h3>
                    <p class="mt-1 text-sm text-gray-500">Browse our courses and enroll to get started.</p>
                    <div class="mt-6">
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Browse Courses
                        </a>
                    </div>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 p-6">
                    @foreach($enrolledCourses as $course)
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                @if($course->thumbnail)
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-indigo-500 text-lg font-medium">No thumbnail</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        @if($course->user->avatar)
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $course->user->avatar) }}" alt="{{ $course->user->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                                {{ substr($course->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $course->user->name }}
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            <span>{{ $course->category->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500 line-clamp-2">
                                        {{ $course->description }}
                                    </p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('courses.show', $course) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        Continue Learning
                                    </a>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        Enrolled
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection