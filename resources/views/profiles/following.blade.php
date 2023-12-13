<!-- resources/views/following/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }} is Following</h1>

        @forelse($following as $followed)
            <div>
                <p>{{ $followed->name }} ({{ $followed->email }})</p>
            </div>
        @empty
            <p>Not following anyone yet.</p>
        @endforelse
    </div>
@endsection
