<x-app-layout>
    <x-slot name="header">
        <h2>{{ isset($task) ? 'Edit Task' : 'Add Task' }}</h2>
    </x-slot>

    <form action="{{ isset($task) ? route('tasks.update',$task) : route('tasks.store') }}" method="POST" class="p-4">
        @csrf
        @if(isset($task)) @method('PUT') @endif

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ $task->title ?? old('title') }}">
        </div>

        <div>
            <label>Category</label>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($task) && $task->category_id==$category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="pending" @if(isset($task) && $task->status=='pending') selected @endif>Pending</option>
                <option value="in_progress" @if(isset($task) && $task->status=='in_progress') selected @endif>In Progress</option>
                <option value="done" @if(isset($task) && $task->status=='done') selected @endif>Done</option>
            </select>
        </div>

        <div>
            <label>Deadline</label>
            <input type="date" name="deadline" value="{{ $task->deadline ?? old('deadline') }}">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded">Submit</button>
    </form>
</x-app-layout>

