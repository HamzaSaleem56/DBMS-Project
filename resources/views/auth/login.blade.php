@extends('layouts.auth')

@section('title')
  {{ __('Login') }}
@endsection

@section('header')
  <div class="text-center mb-4"> {{-- Changed mt-4 to mb-4 for better spacing --}}
    <h1 class="h2">{{ __('Welcome back') }}</h1>
    <p class="lead">
      {{ __('Sign in to your account to continue') }}
    </p>
  </div>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6"> {{-- Constrain width for better form size --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <div class="card shadow-sm"> {{-- Added shadow for depth --}}
          <div class="card-body p-4">
            <div class="text-center mb-4">
              {{-- Reduced image size --}}
              <img src="{{ asset('img/avatars/dummy.png') }}" 
                   alt="User avatar" 
                   class="img-fluid rounded-circle" 
                   width="96" 
                   height="96">
            </div>

            <form method="POST" action="{{ route('login') }}">
              @csrf

              {{-- Email Input --}}
              <div class="mb-3">
                <label class="form-label">{{ __('Email Address') }}</label>
                <input class="form-control @error('email') is-invalid @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="your@email.com"
                       autocomplete="email"
                       required
                       autofocus>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Password Input --}}
              <div class="mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                <input class="form-control @error('password') is-invalid @enderror" 
                       type="password" 
                       name="password" 
                       placeholder="••••••••"
                       autocomplete="current-password"
                       required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Remember Me & Forgot Password --}}
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input class="form-check-input" 
                         type="checkbox" 
                         name="remember" 
                         id="remember" 
                         {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                    {{ __('Remember me') }}
                  </label>
                </div>
                
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="text-decoration-none">
                    {{ __('Forgot Password?') }}
                  </a>
                @endif
              </div>

              {{-- Submit Button --}}
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                  {{ __('Sign in') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection