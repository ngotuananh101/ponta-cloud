@extends('layouts.auth')

@section('title', __('Forgot Password'))

@section('content')
    <form action="{{ route('password.email') }}" class="kt-card-content flex flex-col gap-5 p-10" id="auth_form" method="post">
        @csrf
        <div class="text-center">
            <h3 class="text-lg font-medium text-mono">
                {{ __('Your email') }}
            </h3>
            <span class="text-sm text-secondary-foreground">
                {{ __('Enter your email address to reset your password.') }}
            </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono required">
                {{ __('Email') }}
            </label>
            <input class="kt-input" placeholder="email@email.com" name="email" type="text"
                value="{{ old('email') }}" />
        </div>
        <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
            {{ __('Continue') }}
            <i class="ki-filled ki-black-right"></i>
        </button>
    </form>
@endsection
