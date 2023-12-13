<!-- resources/views/profile/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Profile Details -->

                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
                <p>{{ $post->user->followers->count() }} Followers</p>

                @auth
                    @if(auth()->user()->id !== $user->id)
                        <p>
                            @if(auth()->user()->following->contains($user))
                                <a href="{{ route('profile.follow', $user) }}">Unfollow</a>
                            @else
                                <a href="{{ route('profile.follow', $user) }}">Follow</a>
                            @endif
                        </p>
                    @endif
                @endauth

                <!-- Display Followers and Following Counts -->
                <p>Followers: <a href="{{ route('profile.followers', $user) }}">{{ $user->followers()->count() }}</a></p>
                <p>Following: <a href="{{ route('profile.following', $user) }}">{{ $user->following()->count() }}</a></p>

                <!-- Display User Posts -->
                <h2>Posts</h2>
                <!-- Iterate and display posts here -->
            </div>
        </div>
    </div>
@endsection
