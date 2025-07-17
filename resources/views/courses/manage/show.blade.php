@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:flex lg:items-center lg:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('courses.manage.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Courses</a>
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
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @switch($course->status)
                            @case('published') bg-green-100 text-green-800 @break
                            @case('pending') bg-yellow-100 text-yellow-800 @break
                            @case('draft') bg-gray-100 text-gray-800 @break
                            @case('rejected') bg-red-100 text-red-800 @break
                        @endswitch">
                        {{ ucfirst($course->status) }}
                    </span>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    {{ $course->students_count }} students
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    Created {{ $course->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        <div class="mt-5 flex lg:mt-0 lg:ml-4 space-x-3">
            <a href="{{ route('courses.manage.edit', $course) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Edit
            </a>
            <a href="{{ route('courses.show', $course) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                View Public
            </a>
        </div>
    </div>
    
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Course Overview</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
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
        </div>
    </div>
    
    <!-- Course materials -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Course Materials</h3>
                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="add-material-btn">
                    Add Material
                </button>
            </div>
        </div>
        
        <!-- Add material form (hidden by default) -->
        <form action="{{ route('courses.manage.materials.store', $course) }}" method="POST" enctype="multipart/form-data" class="px-4 py-5 sm:p-6 border-b border-gray-200 hidden" id="add-material-form">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="material-title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="material-title" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div>
                    <label for="material-description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                    <textarea id="material-description" name="description" rows="2"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                
                <div>
                    <label for="material-type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select id="material-type" name="type" required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="article">Article</option>
                        <option value="video">Video</option>
                        <option value="pdf">PDF</option>
                        <option value="image">Image</option>
                        <option value="audio">Audio</option>
                    </select>
                </div>
                
                <div id="material-content-field">
                    <label for="material-content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="material-content" name="content" rows="4"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                
                <div id="material-file-field" class="hidden">
                    <label for="material-file" class="block text-sm font-medium text-gray-700">File</label>
                    <input type="file" name="file_path" id="material-file"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div>
                    <label for="material-order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="material-order" value="0"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancel-material-btn" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Material
                    </button>
                </div>
            </div>
        </form>
        
        @if($course->materials->isEmpty())
            <div class="px-4 py-5 sm:p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No materials yet</h3>
                <p class="mt-1 text-sm text-gray-500">Add materials to your course to help students learn.</p>
            </div>
        @else
            <div class="bg-white overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($course->materials as $material)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $material->title }}</div>
                                    @if($material->description)
                                        <div class="text-sm text-gray-500 mt-1">{{ $material->description }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 capitalize">
                                        {{ $material->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $material->order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('courses.manage.materials.destroy', [$course, $material]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    <!-- Comments -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Discussion</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($course->comments->isEmpty())
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No comments yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Be the first to start the discussion.</p>
                </div>
            @else
                <div class="space-y-6">
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
                                        
                                        @can('delete', $comment)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
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
                                                        
                                                        @can('delete', $reply)
                                                            <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="mt-1">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-xs text-red-500 hover:text-red-600">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endcan
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
            @endif
        </div>
    </div>
</div>

<script>
    // Toggle add material form
    document.getElementById('add-material-btn').addEventListener('click', function() {
        document.getElementById('add-material-form').classList.toggle('hidden');
    });
    
    document.getElementById('cancel-material-btn').addEventListener('click', function() {
        document.getElementById('add-material-form').classList.add('hidden');
    });
    
    // Toggle between content and file fields based on material type
    document.getElementById('material-type').addEventListener('change', function() {
        const type = this.value;
        const contentField = document.getElementById('material-content-field');
        const fileField = document.getElementById('material-file-field');
        
        if (type === 'article') {
            contentField.classList.remove('hidden');
            fileField.classList.add('hidden');
        } else {
            contentField.classList.add('hidden');
            fileField.classList.remove('hidden');
        }
    });
</script>
@endsection