<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Dashboard</h2>
                <p class="text-sm text-gray-600">Welcome back, {{ $user->name }}.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('tasks.index') }}" class="inline-flex items-center rounded border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    View Tasks
                </a>
                <a href="{{ route('tasks.create') }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                    Create Task
                </a>

                @if ($user->isAdmin())
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center rounded border border-indigo-600 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50">
                        Create Category
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-{{ $user->isAdmin() ? '5' : '3' }}">
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Total Tasks</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_tasks'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Pending</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['pending_tasks'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Completed</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['completed_tasks'] }}</p>
        </div>

        @if ($user->isAdmin())
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Categories</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['categories'] }}</p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Users</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['users'] }}</p>
            </div>
        @else
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Active Categories</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['categories'] }}</p>
            </div>
        @endif
    </div>
</x-app-layout>


