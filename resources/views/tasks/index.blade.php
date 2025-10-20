<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tasks Dashboard</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <a href="{{ route('tasks.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Add Task
        </a>

        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Category</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Deadline</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $task->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->category->name }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($task->status) }}</td>
                        <td class="py-2 px-4 border-b">{{ $task->deadline }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>


