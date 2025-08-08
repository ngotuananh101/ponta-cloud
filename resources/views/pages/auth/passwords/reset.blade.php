@extends('layouts.auth')

@section('title', __('Reset Password'))

@section('description', __('Enter your new password.'))

@section('content')
    <form action="{{ route('password.update') }}" class="kt-card-content flex flex-col gap-5 p-10" id="auth_form"
        method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="text-center">
            <h3 class="text-lg font-medium text-mono">
                {{ __('Reset Password') }}
            </h3>
            <span class="text-sm text-secondary-foreground">
                {{ __('Enter your new password.') }}
            </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label text-mono required">
                {{ __('New Password') }}
            </label>
            <label class="kt-input" data-kt-toggle-password="true">
                <input name="password" placeholder="Enter a new password" type="password" value=""
                    @error('password') aria-invalid="true" @enderror />
                <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                    data-kt-toggle-password-trigger="true">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="fa-regular fa-eye"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="fa-regular fa-eye-slash"></i>
                    </span>
                </div>
            </label>
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
            <label class="kt-input" data-kt-toggle-password="true">
                <input name="password_confirmation" placeholder="Re-enter a new Password" type="password" value=""
                    @error('password_confirmation') aria-invalid="true" @enderror />
                <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                    data-kt-toggle-password-trigger="true">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="fa-regular fa-eye"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="fa-regular fa-eye-slash"></i>
                    </span>
                </div>
            </label>
            @error('password_confirmation')
                <div class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="kt-btn kt-btn-primary flex justify-center grow" type="submit">
            {{ __('Reset') }}
        </button>
    </form>
@endsection
