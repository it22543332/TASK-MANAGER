<h1>All Tasks</h1>

<form method="GET" action="{{ route('admin.tasks') }}">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search tasks">
    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>User</th>
        <th>Title</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->user->name }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ $task->status }}</td>
        <td>
            <a href="{{ route('admin.tasks.edit', $task->id) }}">Edit</a>
            <form method="POST" action="{{ route('admin.tasks.destroy', $task->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $tasks->links() }}
