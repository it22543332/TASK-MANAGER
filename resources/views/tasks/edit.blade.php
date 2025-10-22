<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Edit Task</h2>
    </x-slot>

    <div class="mx-auto max-w-3xl py-6">
        <div class="rounded bg-white shadow">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                            <option value="pending" @selected(old('status', $task->status) === 'pending')>Pending</option>
                            <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>In Progress</option>
                            <option value="done" @selected(old('status', $task->status) === 'done')>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-gray-700">Deadline</label>
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                    </div>

                    @if($isAdmin)
                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-700">Assign To</label>
                            <select name="user_id" id="user_id" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" @selected(old('user_id', $task->user_id) == $user->id)>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('tasks.index') }}" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

