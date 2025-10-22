@extends('layouts.app')
@section('content')
<h1>Categories</h1>
<a href="{{ route('admin.categories.create') }}">Create New Category</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Tasks Count</th>
        <th>Actions</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->tasks->count() }}</td>
        <td>
            <a href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this category?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
