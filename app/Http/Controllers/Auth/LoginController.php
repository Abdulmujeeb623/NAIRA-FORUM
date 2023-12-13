<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Redirect the user to the provider authentication page.
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Obtain the user information from the provider.
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login using ' . $provider);
        }

        // Check if the user already exists
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            // Create a new user with the data from the social provider
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('password'), // Set a default password or generate one
            ]);

            Auth::login($newUser, true);
        }

        return redirect('/home');
    }

    // Handle the user after the logout process.
    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        return redirect('/login'); // Redirect to the login page after logout
    }
}
