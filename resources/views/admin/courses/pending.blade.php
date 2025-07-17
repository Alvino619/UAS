@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Pending Course Approvals</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($pendingCourses as $course)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:underline">
                            {{ $course->title }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $course->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap space-x-2">
                        <form action="{{ route('admin.courses.approve', $course) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                Approve
                            </button>
                        </form>

                        <button onclick="showRejectForm({{ $course->id }})" 
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                            Reject
                        </button>

                        <!-- Reject Reason Form (Hidden by Default) -->
                        <div id="rejectForm-{{ $course->id }}" class="hidden mt-2">
                            <form action="{{ route('admin.courses.reject', $course) }}" method="POST">
                                @csrf
                                <textarea name="rejection_reason" rows="2" 
                                    class="w-full border rounded p-2 mb-2" 
                                    placeholder="Enter rejection reason..." required></textarea>
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Submit Rejection
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        No courses pending approval.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4">
            {{ $pendingCourses->links() }}
        </div>
    </div>
</div>

<script>
    function showRejectForm(courseId) {
        const form = document.getElementById(`rejectForm-${courseId}`);
        form.classList.toggle('hidden');
    }
</script>
@endsection