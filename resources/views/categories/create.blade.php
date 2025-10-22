@extends('layouts.app')
@section('content')
<h1>Create Category</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <label>Category Name:</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <button type="submit">Create</button>
</form>

<a href="{{ route('admin.categories.index') }}">Back to Categories</a>
@endsection
