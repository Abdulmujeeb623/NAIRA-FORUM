<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\Post;
use App\Models\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Get recent posts
        $posts = Post::latest()->limit(5)->get();
    
        // Pass the user and posts data to the view
        return view('home', compact('user', 'posts'));
    }
    }


