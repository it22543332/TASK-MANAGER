@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">All Tasks</h1>
            <p class="mt-1 text-sm text-gray-500">Manage tasks created by users — search, edit, delete and review status.</p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                ← Admin Dashboard
            </a>

            <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                + New Task
            </a>
        </div>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('admin.tasks.index') }}" class="mb-6">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ request('search', $search ?? '') }}"
                placeholder="Search tasks by title or user..."
                class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-300"
            />
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Search</button>
            <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 bg-gray-100 rounded-md border border-gray-200 hover:bg-gray-200">Reset</a>
        </div>
    </form>

    <!-- Table card -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-semibold">
                                    {{ strtoupper(substr($task->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $task->user->name ?? '—' }}</div>
                                    <div class="text-xs text-gray-500">{{ $task->user->email ?? '' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-normal">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($task->title, 70) }}</div>
                            @if($task->description)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($task->description, 100) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $task->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($task->status === 'Finished')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Finished</span>
                            @elseif($task->status === 'Doing')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Doing</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ $task->status }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $task->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex gap-2 justify-end">
                            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="px-3 py-1 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Edit</a>

                            <form method="POST" action="{{ route('admin.tasks.destroy', $task->id) }}" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded-md bg-red-600 text-white hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            No tasks found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 flex items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing <span class="font-medium">{{ $tasks->firstItem() ?? 0 }}</span> to <span class="font-medium">{{ $tasks->lastItem() ?? 0 }}</span> of <span class="font-medium">{{ $tasks->total() }}</span> results
            </div>

            <div>
                {{ $tasks->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

