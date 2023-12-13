<!-- resources/views/categories/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $category->name }} Category</h2>

        <!-- Display posts within the category -->
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
