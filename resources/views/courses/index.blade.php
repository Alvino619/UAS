@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">All Courses</h1>
                
                <div class="mt-4 md:mt-0 w-full md:w-auto">
                    <form action="{{ route('courses.index') }}" method="GET">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Search courses..." 
                                class="block w-full md:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="{{ request('search') }}">
                            <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Filters -->
                <div class="w-full md:w-64">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-indigo-600 {{ !request('category') ? 'font-medium text-indigo-600' : '' }}">
                                All Categories
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('courses.index', ['category' => $category->slug]) }}" 
                                    class="text-gray-600 hover:text-indigo-600 {{ request('category') == $category->slug ? 'font-medium text-indigo-600' : '' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Course list -->
                <div class="flex-1">
                    @if($courses->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No courses found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                        </div>
                    @else
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
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
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $course->students_count }} students
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-8">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection