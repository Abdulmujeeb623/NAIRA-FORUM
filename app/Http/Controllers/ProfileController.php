<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', compact('user'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        return view('profiles.dashboard', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    // Validation logic here if needed

    $user->update($request->all());

    // Update profile image if a new one is provided
    if ($request->hasFile('profile_image')) {
        $profileImage = $request->file('profile_image')->store('profile_images', 'public');

        // Extract the file name from the path and update the database
        $fileName = pathinfo($profileImage, PATHINFO_BASENAME);
        $user->update(['profile_image' => $fileName]);
    }

    return redirect()->route('home', $user)->with('success', 'Profile updated successfully!');
}

    public function follow(User $user)
    {
        auth()->user()->following()->toggle($user->id);
        return back();
    }

    public function followers(User $user)
    {
        $followers = $user->followers;
        return view('profiles.followers', compact('followers', 'user'));
    }

    public function following(User $user)
    {
        $following = $user->following;
        return view('profiles.following', compact('following', 'user'));
    }
}
