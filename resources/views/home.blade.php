@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-white">
    <!-- Hero section -->
    <div class="relative bg-indigo-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="">
            <div class="absolute inset-0 bg-indigo-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Learn new skills online</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">Browse hundreds of courses taught by expert instructors. Start learning today with our online courses with EduMate.</p>
            <div class="mt-10">
                <a href="{{ route('courses.index') }}" class="inline-block bg-indigo-500 border border-transparent rounded-md py-3 px-8 font-medium text-white hover:bg-indigo-600">Browse Courses</a>
            </div>
        </div>
    </div>

    <!-- Featured courses -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Featured Courses
            </h2>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Start learning from our most popular courses
            </p>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($courses as $course)
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
                                View course
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Categories -->
    <div class="bg-gray-100">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Browse by Categories
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Learn from courses in various categories
                </p>
            </div>

            <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach($categories as $category)
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="{{ route('courses.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $category->courses_count }} courses
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Ready to dive in?</span>
                <span class="block">Start learning today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">
                Join thousands of students learning new skills every day.
            </p>
            <a href="{{ route('register') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                Sign up for free
            </a>
        </div>
    </div>
</div>
@endsection