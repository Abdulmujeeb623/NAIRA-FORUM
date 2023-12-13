<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
<style>
    .create-category-link {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    /* Add any other styles as needed */
}

</style>
    <div class="container">
        <h2>Create a New Post</h2>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image">Choose Image or Video</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
    <label for="category_id">Category</label>
    <select class="form-control" id="category_id" name="category_id" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>


            <!-- Link to create a new category -->
            <p><a href="{{ route('categories.create') }}" class="create-category-link">Create Category</a></p>


            <button type="submit" class="btn btn-success">Create Post</button>
        </form>
    </div>
@endsection
