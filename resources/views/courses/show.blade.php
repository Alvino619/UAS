@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:flex lg:items-center lg:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="{{ route('home') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Home</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <a href="{{ route('courses.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Courses</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-500">{{ $course->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $course->title }}
                </h2>
                <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Created {{ $course->created_at->diffForHumans() }}
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg>
                        {{ $course->students_count }} students
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7a.999.999 0 111.414-1.414L10 14.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ $course->category->name }}
                    </div>
                </div>
            </div>
            <div class="mt-5 flex lg:mt-0 lg:ml-4">
                @auth
                    @if($isEnrolled)
                        <form action="{{ route('courses.unenroll', $course) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Unenroll
                            </button>
                        </form>
                    @else
                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enroll Now
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login to Enroll
                    </a>
                @endauth
            </div>
        </div>
        
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Course content -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-64 bg-indigo-100 rounded-lg shadow-lg flex items-center justify-center">
                            <span class="text-indigo-500 text-lg font-medium">No thumbnail</span>
                        </div>
                    @endif
                </div>
                
                <div class="prose max-w-none">
                    {!! $course->content !!}
                </div>
                
                <!-- Comments section -->
                <div class="mt-12">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Discussion</h3>
                    
                    @auth
                        <form action="{{ route('comments.store', $course) }}" method="POST" class="mb-8">
                            @csrf
                            <div class="mb-4">
                                <label for="comment" class="sr-only">Add a comment</label>
                                <textarea id="comment" name="content" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Add a comment..."></textarea>
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Post Comment
                            </button>
                        </form>
                    @else
                        <div class="text-center py-8 border border-gray-200 rounded-lg">
                            <p class="text-gray-600">You must be <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">logged in</a> to participate in discussions.</p>
                        </div>
                    @endauth
                    
                    <div class="space-y-8">
                        @foreach($course->comments as $comment)
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            @if($comment->user->avatar)
                                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $comment->user->avatar) }}" alt="{{ $comment->user->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                                    {{ substr($comment->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $comment->user->name }}</h4>
                                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-700">{{ $comment->content }}</p>
                                            
                                            @auth
                                                <div class="mt-2 flex items-center space-x-4">
                                                    <button type="button" class="text-xs text-gray-500 hover:text-indigo-600 reply-btn" data-comment-id="{{ $comment->id }}">
                                                        Reply
                                                    </button>
                                                    @can('delete', $comment)
                                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-xs text-red-500 hover:text-red-600">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                                
                                                <!-- Reply form (hidden by default) -->
                                                <form action="{{ route('comments.store', $course) }}" method="POST" class="mt-3 hidden" id="reply-form-{{ $comment->id }}">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="mb-2">
                                                        <label for="reply-{{ $comment->id }}" class="sr-only">Reply</label>
                                                        <textarea id="reply-{{ $comment->id }}" name="content" rows="2" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Write a reply..."></textarea>
                                                    </div>
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Post Reply
                                                    </button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Replies -->
                                @if($comment->replies->count() > 0)
                                    <div class="border-t border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
                                        <div class="space-y-4 pl-10">
                                            @foreach($comment->replies as $reply)
                                                <div>
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0">
                                                            @if($reply->user->avatar)
                                                                <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . $reply->user->avatar) }}" alt="{{ $reply->user->name }}">
                                                            @else
                                                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                                                    {{ substr($reply->user->name, 0, 1) }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3 flex-1">
                                                            <div class="flex items-center justify-between">
                                                                <h4 class="text-xs font-medium text-gray-900">{{ $reply->user->name }}</h4>
                                                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="mt-1 text-xs text-gray-700">{{ $reply->content }}</p>
                                                            
                                                            @auth
                                                                @can('delete', $reply)
                                                                    <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="mt-1">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-xs text-red-500 hover:text-red-600">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endcan
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Instructor</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($course->user->avatar)
                                    <img class="h-12 w-12 rounded-full" src="{{ asset('storage/' . $course->user->avatar) }}" alt="{{ $course->user->name }}">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                        {{ substr($course->user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900">{{ $course->user->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $course->user->role }}</p>
                            </div>
                        </div>
                        @if($course->user->bio)
                            <p class="mt-4 text-sm text-gray-700">{{ $course->user->bio }}</p>
                        @endif
                    </div>
                </div>
                
                @if($course->materials->count() > 0)
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Course Materials</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="space-y-4">
                                @foreach($course->materials as $material)
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            @switch($material->type)
                                                @case('video')
                                                    <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                    </svg>
                                                    @break
                                                @case('pdf')
                                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @case('article')
                                                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                    </svg>
                                            @endswitch
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $material->title }}</h4>
                                            @if($material->description)
                                                <p class="text-xs text-gray-500 mt-1">{{ $material->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@auth
    <script>
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', () => {
                const commentId = button.getAttribute('data-comment-id');
                const form = document.getElementById(`reply-form-${commentId}`);
                form.classList.toggle('hidden');
            });
        });
    </script>
@endauth
@endsection