<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Categories</h2>

        <!-- Display categories here -->
        @foreach ($categories as $category)
            <p>{{ $category->name }}</p>
        @endforeach
    </div>
@endsection
