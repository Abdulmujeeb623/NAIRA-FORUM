<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'url'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            Auth::login($user);

            // Update profile image if a new one is provided
            if (isset($data['profile_image'])) {
                $user->update(['profile_image' => $data['profile_image']]);
            }

            return $user;
        }

        $profileImage = null;

        if (isset($data['profile_image'])) {
            $profileImage = $data['profile_image'];
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => $profileImage,
        ]);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $registeredUser = $this->findOrCreateUser($user, 'facebook');
        Auth::login($registeredUser, true);
        return redirect()->intended('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $registeredUser = $this->findOrCreateUser($user, 'google');
        Auth::login($registeredUser, true);
        return redirect()->intended('/');
    }

    protected function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => null,
            'provider' => $provider,
            'provider_id' => $user->id,
            'profile_image' => null,
        ]);
    }
}
