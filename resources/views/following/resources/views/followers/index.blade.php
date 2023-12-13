<!-- resources/views/followers/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Followers</h1>

        @forelse($followers as $follower)
            <div>
                <p>{{ $follower->name }} ({{ $follower->email }})</p>
            </div>
        @empty
            <p>No followers yet.</p>
        @endforelse
    </div>
@endsection
