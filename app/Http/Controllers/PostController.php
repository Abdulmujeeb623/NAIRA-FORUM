<?php
// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
{
    $categories = Category::all();
    return view('posts.create', compact('categories'));
}

public function store(Request $request)
{
    // Validation logic here if needed
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'image|mimes:jpeg,png,jpg,gif,mp4,svg|max:2048',
        // Add other validation rules for image, etc.
    ]);

    // Associate the user_id with the authenticated user
    $postData = $request->all();
    $postData['user_id'] = auth()->user()->id;

    // File upload logic
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('uploads', $imageName, 'public');

        // Save the file name to the database
        $postData['image_url'] = $imageName;
    }

    // Ensure 'category_id' is set in $postData
    $category_id = $request->input('category_id');
    
    $postData['category_id'] = $category_id;
    dd($category_id);

    Post::create($postData);

    return redirect('/posts')->with('success', 'Post created successfully!');
}

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function like(Post $post)
    {
        // Handle liking logic here
        return back()->with('success', 'Post liked!');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
