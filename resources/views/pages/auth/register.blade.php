@extends('layouts.auth')

@section('title', __('Sign Up'))

@section('description', __('Please fill in the form to create an account.'))

@section('content')
    <form action="{{ route('register') }}" class="kt-card-content flex flex-col gap-5 p-10" id="auth_form" method="post">
        @csrf
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                {{ __('Sign Up') }}
            </h3>
            <div class="flex items-center justify-center">
                <span class="text-sm text-secondary-foreground me-1.5">
                    {{ __('Already have an account?') }}
                </span>
                <a class="text-sm link" href="{{ route('login') }}">
                    {{ __('Sign In') }}
                </a>
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label text-mono required">
                {{ __('Name') }}
            </label>
            <input class="kt-input" name="name" placeholder="Nguyen Van A" type="text" value="{{ old('name') }}"
                required @error('name') aria-invalid="true" @enderror />
            @error('name')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label text-mono required">
                {{ __('Email') }}
            </label>
            <input class="kt-input" name="email" placeholder="email@email.com" type="text" value="{{ old('email') }}"
                required @error('email') aria-invalid="true" @enderror />
            @error('email')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono required">
                {{ __('Password') }}
            </label>
            <div class="kt-input" data-kt-toggle-password="true">
                <input name="password" placeholder="Enter Password" type="password" value="" required
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
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono required">
                {{ __('Confirm Password') }}
            </label>
            <div class="kt-input" data-kt-toggle-password="true">
                <input name="password_confirmation" placeholder="Re-enter Password" type="password" value="" required
                    @error('password_confirmation') aria-invalid="true" @enderror />
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
            @error('password_confirmation')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label class="kt-checkbox-group flex items-center gap-2">
                <input class="kt-checkbox kt-checkbox-sm" name="accept_term" type="checkbox" value="1" />
                <span class="kt-checkbox-label text-sm">
                    {{ __('I agree to the') }}
                    <a class="text-sm link text-blue-500" href="#">
                        {{ __('Terms and Conditions') }}
                    </a>
                </span>
            </label>
            @error('accept_term')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="kt-btn kt-btn-primary flex justify-center grow" type="submit">
            {{ __('Sign Up') }}
        </button>
    </form>
@endsection
