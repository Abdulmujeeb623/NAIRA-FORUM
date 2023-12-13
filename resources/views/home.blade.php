@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<style>
    /* Base Styles */
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    /* Navbar Styles */
   
    #second-navbar {
        position: fixed;
        top: 80px; /* Adjust the top position based on the height of the top navbar */
        left: 0;
        width: 65%;
        height: 60px;
        z-index: 1000;
        background-color: white; /* Set the background color for the second navbar */
        padding-left: 200px; /* Adjust the left padding to not overlap with the sidebar */
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    @media (max-width: 768px) {
        #second-navbar {
            top: 110px; /* Adjust the top position based on the height of the top navbar */
            width: 100%;
            padding-left: 10px; /* Remove left padding for mobile view */
            justify-content: space-evenly; /* Center the items in mobile view */
            margin-bottom: 15px; /* Add margin at the bottom for spacing */
            height: 30px;
        }
    }

    #second-navbar a {
    color: #006400; /* Set the text color for the links */
    margin: 0 10px; /* Add margin between the links */
    text-decoration: none; /* Remove underlines from links */
    display: flex;
    align-items: center;
}

#second-navbar a i {
    margin-right: 5px; /* Add spacing between the icon and text */
    height: 40px;
    color: #00FF00; /* Set the color of the Font Awesome icon to green */
}

    /* Sidebar Styles */
    #sidebar {
    position: fixed;
    top: 56px;
    left: 0;
    height: 100%;
    z-index: 1000;
    padding-top: 3.5rem;
    background-color: #00FF00; /* Set the background color to green */
    transition: margin-top 0.3s, width 0.3s; /* Add width transition */
}

    #sidebar.collapsed {
        width: 0;
        overflow: hidden;
    }

    #sidebar .navbar-brand,
    #sidebar .nav-link {
        color: #ffffff !important;
    }

    /* Content Styles */
    #content {
    margin-left: 200px;
    margin-right: 200px;
    margin-top: 80px; /* Adjusted margin-top to accommodate the second navbar height */
    transition: margin-left 0.3s, margin-top 0.3s; /* Include margin-top in the transition */
}

    #content h5.card-title,
    #content p.card-text {
        padding-left: 10px;
        padding-right: 10px;
        /* Added padding to title and content */
    }

    /* Right Fixed Div Styles */
    #right-fixed {
        top: 56px;
        right: 0;
        height: 100%;
        width: 200px; /* Reduced width for the fixed div on the right */
        z-index: 1000;
        padding-top: 3.5rem;
        /* Add additional styling for the fixed div on the right */
    }
    .btn{
        background-color: #00FF00;
    }
    .fas{
        color: #00FF00;

    }

    @media (max-width: 768px) {
        #sidebar {
            margin-top: 0;
        }

        #sidebar.collapsed {
            margin-top: 0;
        }

        #content {
            margin-left: 20px;
            margin-right: 20px; /* Adjusted margin on both sides for mobile view */
        }

        #right-fixed {
            display: none; /* Hide the fixed div on smaller screens */
        }
    }
    /* public/css/styles.css */

/* Custom CSS styles for images */
.card-img-top {
    max-height: 75%; /* Set a maximum height for the images */
    object-fit: cover; /* Ensure images cover the entire container */
    border-radius: 8px; /* Add rounded corners for a card-like appearance */
    margin-bottom: 10px; /* Add some space below the images */
}

/* Additional styles for the card body */
.card-body {
    background-color: #f8f9fa; /* Set a light background color for the card body */
    padding: 15px; /* Add padding to the card body */
}

</style>
<div id="second-navbar">
    
    <a class="navbar-brand" href="{{ route('home', auth()->user()) }}">
        <!-- Font Awesome icon for "Create Post" -->
        <i class="fas fa-home"></i> 
    </a>

    <a class="navbar-brand" href="{{ route('posts.create', auth()->user()) }}">
        <!-- Font Awesome icon for "Create Post" -->
        <i class="fas fa-edit"></i> 
    </a>
    <a class="navbar-brand" href="#">
        <!-- Font Awesome icon for "Discover" -->
        <i class="fas fa-compass"></i> 
    </a>

    
    <a class="navbar-brand" href="{{ route('posts.index', auth()->user()) }}">
        <!-- Font Awesome icon for "Page" -->
        <i class="fas fa-file-alt"></i> 
    </a>
     
    


    
   
    <a class="navbar-brand" href="#">
        <!-- Font Awesome icon for "Create Post" -->
        <i class="fas fa-search"></i> 
    </a>

</div>


<div class="container-fluid mt-3">
    <div class="row">
        <!-- Left Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block  sidebar"> <!-- Set background color to deep red -->
        
            <div class="position-sticky">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    NAIRA FORUM
                </a>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit', auth()->user()) }}">Profile   </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create', auth()->user()) }}">Themes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.dashboard', auth()->user()) }}">Dashboard    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index', auth()->user()) }}">Languages  <i class="fas fa-language"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.followers', ['user' => auth()->user()]) }}">Followers   </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.following', ['user' => auth()->user()]) }}">Following  
                    </li>
                    
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index', auth()->user()) }}">Settings  <i class="fas fa-cogs"></i> </a>
                    </li>
                </ul>
            </div>
        </nav>

    <!-- Main Content -->
    <div id="content" class="col-md-6 mx-auto pr-md-4">
    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-header">
                <!-- Display the name of the user who posted the content -->
                {{ $post->user->name }}
                <span class="ml-4">Followers: {{ $post->user->followers->count() }}</span>
            </div>
            <center><h4>{{ $post->title }}</h4></center>
            @if ($post->image_url)
                <img src="{{ asset('storage/uploads/' . $post->image_url) }}" class="card-img-top" alt="Post Image">
            @endif
            <div class="card-body">
                <p class="card-text">{{ $post->content }}</p>

                <!-- Follow/Unfollow link -->
                @auth
                    @if(auth()->user()->id !== $post->user->id)
                        <p class="follow-link">
                            @if(auth()->user()->following->contains($post->user))
                                <a href="{{ route('profile.follow', $post->user) }}" class="btn btn-danger">Unfollow</a>
                            @else
                                <a href="{{ route('profile.follow', $post->user) }}" class="btn btn-danger">Follow</a>
                            @endif
                        </p>
                    @endif
                @endauth

                <a href="{{ route('posts.show', $post) }}" class="btn btn-danger">View Post and Write Comment</a>

                <div class="mt-3 row">
                    <div class="col">
                        <i class="fas fa-thumbs-up "></i> {{ $post->likes }}
                    </div>
                    <div class="col">
                        <i class="fas fa-eye "></i> {{ $post->views }}
                    </div>
                    <div class="col">
                        <!-- Link to show the number of comments -->
                    
                             <a class="nav-link" href="{{ route('posts.show', $post) }}">  <i class="fas fa-comment"></i> </a>
                    
                    </div>
                </div>

                <!-- Additional link to view the post and write a comment -->
                
            </div>
        </div>
    @endforeach
</div>

     <div id="right-fixed">
            <!-- Content for the fixed div on the right goes here -->
            <h3>Popular Posts</h3>
            
            @foreach ($posts as $post)
                <div class="card mb-5">
                    
                        <h5 class="card-title">{{ $post->title }}</h5>
                        @if ($post->image_url)
        <img src="{{ asset('storage/uploads/' . $post->image_url) }}" class="card-img-top" alt="Post Image">
    @endif
                        
                        <a href="{{ route('posts.show', $post) }}" class="btn">View Post</a>
                    
                </div>
            @endforeach

            <!-- Add your recent posts, popular posts, and search here -->
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional, if you need Bootstrap JavaScript features) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-Zn4vGmxQ9thtUlTbk7MLc74fIbStsd5n6uOcm7+pc3AtiAytP1R0jUv03Z70KnYTZ1Yv6O1V8BFCzW9IBy+RFw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle sidebar on mobile view when any part of the sidebar is clicked
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('content');

        sidebar.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            content.style.marginLeft = sidebar.classList.contains('collapsed') ? '0' : '200px';
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('collapsed');
                content.style.marginLeft = '200px';
            } else {
                sidebar.classList.add('collapsed');
                content.style.marginLeft = '0';
            }
        });
    });
</script>
@endsection
