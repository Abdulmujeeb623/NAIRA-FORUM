@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>{{ __('NAIRA-FORUM') }}</h2>
                        <p>Welcome to NAIRA-FORUM. Login to your account.</p>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="mb-3">
                            <a href="{{ url('login/facebook') }}" class="btn btn-primary btn-block">
                                <i class="fab fa-facebook"></i> Login with Facebook
                            </a>
                            <a href="{{ url('login/google') }}" class="btn btn-danger btn-block">
                                <i class="fab fa-google"></i> Login with Google
                            </a>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="mb-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Register Link -->
                        <div class="mb-0">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-link">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
