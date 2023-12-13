<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<style>
    .btn{
        background-color: #00FF00;
    }
</style>
<div class="container">
    <h2>Posts</h2>

    @foreach ($posts as $post)
        <div class="card mb-3">
            @if ($post->image_url)
                <img src="{{ asset('storage/uploads/' . $post->image_url) }}" class="card-img-top" alt="Post Image">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                
                <a href="{{ route('posts.show', $post) }}" class="btn btn-danger">View Post</a>
            </div>
        </div>
    @endforeach

</div>
@endsection
