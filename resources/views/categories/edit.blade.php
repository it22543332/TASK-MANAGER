@extends('layouts.app')
@section('content')
<h1>Edit Category</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Category Name:</label>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.categories.index') }}">Back to Categories</a>
@endsection
