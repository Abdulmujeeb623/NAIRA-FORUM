@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<style>
    body {
        font-size: 14px;
        padding: 10px;
    }

    .container {
        max-width: 80%;
        margin: 10px auto; /* Adjusted margin for better visibility on mobile */
    }

    h2 {
        font-size: 1.5em;
    }

    .card {
        margin-bottom: 10px;
        padding: 10px;
    }

    .card-img-top {
        height: 40%;
    }

    .card-body {
        font-size: 1em;
    }

    .btn {
        font-size: 0.9em;
    }
    .btn{
        background-color: #00FF00;
    }
   

    .mt-4 {
        margin-top: 10px;
    }

    .card-text {
        margin-bottom: 5px;
    }

    .form-label,
    .form-control,
    .btn {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .card-img-top {
            height: auto;
        }

        .card {
            padding: 5px;
        }

        .container {
            margin: 10px auto; /* Adjusted margin for better visibility on mobile */
        }
    }
</style>

<div class="container">
    <br><br><br>
    <h2>{{ $post->title }}</h2>

    <div class="card mb-2">
    <div>
    {{ $post->user->name }}
                <span class="ml-4">Followers: {{ $post->user->followers->count() }}</span>
</div>
        @if ($post->image_url)
            <img src="{{ asset('storage/uploads/' . $post->image_url) }}" class="card-img-top" alt="Post Image">
        @endif
        <div class="card-body">
            <p class="card-text">{{ $post->content }}</p>
        </div>
    </div>

    <form action="{{ route('posts.like', $post) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">Like</button>
    </form>

    <div class="mt-4">
        <h4>Comments</h4>
        @if ($post->comments)
            @foreach ($post->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="card-text">{{ $comment->content }}</p>
                        <small class="text-muted">Commented by {{ $comment->user->name }} on {{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @endforeach
        @else
            <p>No comments yet.</p>
        @endif

        @auth
            <form action="{{ route('comments.store', $post) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Add Comment</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Submit Comment</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add comments.</p>
        @endauth
    </div>
</div>
@endsection
