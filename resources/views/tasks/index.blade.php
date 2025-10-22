<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $isAdmin ? 'All Tasks' : 'My Tasks' }}</h2>
                <p class="text-sm text-gray-600">Manage {{ $isAdmin ? 'team assignments and statuses' : 'your assigned tasks' }}.</p>
            </div>
            <a href="{{ $isAdmin ? route('tasks.create') : route('tasks.create') }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                Create Task
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white shadow rounded">
            <form method="GET" class="border-b border-gray-200 p-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-{{ $isAdmin ? '4' : '2' }}">
                    @if($isAdmin)
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Category</label>
                            <select name="category" class="mt-1 w-full rounded border-gray-300 text-sm">
                                <option value="">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(($filters['category'] ?? null) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Assigned To</label>
                            <select name="assigned_to" class="mt-1 w-full rounded border-gray-300 text-sm">
                                <option value="">Anyone</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @selected(($filters['assigned_to'] ?? null) == $user->id)>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Status</label>
                        <select name="status" class="mt-1 w-full rounded border-gray-300 text-sm">
                            <option value="">All</option>
                            <option value="pending" @selected(($filters['status'] ?? null) === 'pending')>Pending</option>
                            <option value="in_progress" @selected(($filters['status'] ?? null) === 'in_progress')>In Progress</option>
                            <option value="done" @selected(($filters['status'] ?? null) === 'done')>Completed</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="inline-flex items-center rounded bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white hover:bg-gray-700">Filter</button>
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-gray-600 hover:bg-gray-50">Reset</a>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Category</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Deadline</th>
                            @if($isAdmin)
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Assigned To</th>
                            @endif
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($tasks as $task)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $task->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $task->category->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide
                                        @class([
                                            'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                            'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                            'bg-green-100 text-green-800' => $task->status === 'done',
                                        ])
                                    ">
                                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $task->deadline->format('M d, Y') }}</td>
                                @if($isAdmin)
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $task->user->name }}</td>
                                @endif
                                <td class="px-4 py-3 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-500" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 6 : 5 }}" class="px-4 py-5 text-center text-sm text-gray-500">No tasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($tasks, 'links'))
                <div class="border-t border-gray-200 p-4">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


