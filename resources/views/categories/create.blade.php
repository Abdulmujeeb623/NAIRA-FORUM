<!-- resources/views/categories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Category</h2>

        <!-- Category creation form -->
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-success">Create Category</button>
        </form>
    </div>
@endsection
