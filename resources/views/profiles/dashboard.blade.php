@extends('layouts.app')

@section('content')
<br><br>
    <div class="container">
        <h1>{{ $user->name }}'s World</h1>

        <div class="card mb-4">
            <div class="card-header">
                Profile
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                    @if($user->profile_image)
                    <img src="{{ asset('storage/uploads/mmm.jpg' ) }}" alt="Profile Image" class="img-thumbnail" width="200">


                        @else
                            <!-- Default image or placeholder if no profile image -->
                            <img src="{{ asset('path/to/default/image.jpg') }}" alt="Profile Image" class="img-thumbnail" width="200">
                        @endif

</div>

                    <div class="col-md-9">
                    <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p> <!-- Add any additional details you want to display for the profile -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Followers and Following
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Followers</th>
                            <th>Following</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h5>Followers: {{ $user->followers()->count() }}</h5>
                                @forelse($user->followers as $follower)
                                    <div class="mb-2">
                                        <p>{{ $follower->name }}</p>
                                    </div>
                                @empty
                                    <p>No followers yet.</p>
                                @endforelse
                            </td>
                            <td>
                                <h5>Following: {{ $user->following()->count() }}</h5>
                                @forelse($user->following as $following)
                                    <div class="mb-2">
                                        <p>{{ $following->name }}</p>
                                    </div>
                                @empty
                                    <p>Not following anyone yet.</p>
                                @endforelse
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Your Posts
            </div>
            <div class="card-body">
                @forelse(auth()->user()->posts as $post)
                    <div class="mb-3">
                        <h5>{{ $post->title }}</h5>
                        <p>{{ $post->content }}</p>
                        <img src="{{ asset('storage/uploads/' . $post->image_url) }}" alt="Post Image" class="img-thumbnail" width="200">
                        <!-- Adjusted width for larger post images -->
                        <!-- Add any additional details you want to display for each post -->
                    </div>
                    <hr>
                    
                @empty
                    <p>No posts yet.</p>
                @endforelse
            </div>
        </div>
    </div>
    
@endsection
