<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('naira_welcome');
});

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/profile/{user}/follow', [ProfileController::class, 'follow'])->name('profile.follow')->middleware('auth');
Route::get('/profile/{user}/followers', [ProfileController::class, 'followers'])->name('profile.followers');

Route::get('/profile/{user}/following', [ProfileController::class, 'following'])->name('profile.following');
// web.php

// web.php

Route::get('/profile/{user}/dashboard', [ProfileController::class, 'dashboard'])
    ->name('profile.dashboard')
    ->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::resource('categories', CategoryController::class);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/login/facebook', function () {
    return Socialite::driver('facebook')->redirect();
});

Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'facebookCallback']);

Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'googleCallback']);

Route::get('/register/facebook', [App\Http\Controllers\Auth\RegisterController::class, 'redirectToFacebook']);
Route::get('/register/facebook/callback', [App\Http\Controllers\Auth\RegisterController::class, 'handleFacebookCallback']);

Route::get('/register/google', [App\Http\Controllers\Auth\RegisterController::class, 'redirectToGoogle']);
Route::get('/register/google/callback', [App\Http\Controllers\Auth\RegisterController::class, 'handleGoogleCallback']);
