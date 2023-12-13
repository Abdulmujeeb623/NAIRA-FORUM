<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post);
    }
}
