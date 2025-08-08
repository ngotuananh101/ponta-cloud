@extends('layouts.auth')

@section('title', __('Sign In'))

@section('description', __('Sign in to your account'))

@section('content')
    <form action="{{ route('login') }}" class="kt-card-content flex flex-col gap-4 p-10" id="auth_form" method="post">
        @csrf
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                {{ __('Sign In') }}
            </h3>
            <div class="flex items-center justify-center">
                <span class="text-sm text-secondary-foreground me-1.5">
                    {{ __('Need an account?') }}
                </span>
                <a class="text-sm font-medium link" href="{{ route('register') }}">
                    {{ __('Sign Up') }}
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2.5">
            <a class="kt-btn kt-btn-outline justify-center" href="{{ route('oauth.redirect', ['provider' => 'google']) }}">
                <img alt="" class="size-3.5 shrink-0" src="{{ asset('assets/icons/google.svg') }}" />
                {{ __('Use') }} Google
            </a>
            <a class="kt-btn kt-btn-outline justify-center" href="{{ route('oauth.redirect', ['provider' => 'github']) }}">
                <img alt="" class="size-3.5 shrink-0" src="{{ asset('assets/icons/github.svg') }}" />
                {{ __('Use') }} GitHub
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="border-t border-border w-full">
            </span>
            <span class="text-xs text-muted-foreground font-medium uppercase">
                {{ __('Or') }}
            </span>
            <span class="border-t border-border w-full">
            </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono required">
                {{ __('Email') }}
            </label>
            <input class="kt-input" placeholder="email@email.com" type="text" name="email" value="{{ old('email') }}"
                required @error('email') aria-invalid="true" @enderror />
            @error('email')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex items-center justify-between gap-1">
                <label class="kt-form-label font-normal text-mono required">
                    {{ __('Password') }}
                </label>
                <a class="text-xs kt-link shrink-0" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            </div>
            <div class="kt-input" data-kt-toggle-password="true">
                <input name="password" placeholder="Enter Password" type="password" value="{{ old('password') }}" required
                    @error('password') aria-invalid="true" @enderror />
                <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                    data-kt-toggle-password-trigger="true" type="button">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="fa-regular fa-eye"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="fa-regular fa-eye-slash"></i>
                    </span>
                </button>
            </div>
            @error('password')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <label class="kt-label">
            <input class="kt-checkbox kt-checkbox-sm" name="remember_me" type="checkbox" value="1" />
            <span class="kt-checkbox-label text-xs">
                {{ __('Remember Me') }}
            </span>
        </label>
        <button class="kt-btn kt-btn-primary flex justify-center grow" type="submit">
            {{ __('Sign In') }}
        </button>
    </form>
@endsection
