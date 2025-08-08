@extends('layouts.auth')

@section('title', __('Verify Email'))

@section('description', __('Please verify your email address to continue.'))

@section('content')
    <form action="{{ route('verification.resend') }}" class="kt-card-content p-10" id="auth_form" method="post">
        @csrf
        <div class="flex justify-center py-10">
            <img alt="image" class="dark:hidden max-h-[130px]" src="{{ asset('assets/images/email.svg') }}" />
            <img alt="image" class="light:hidden max-h-[130px]" src="{{ asset('assets/images/email-dark.svg') }}" />
        </div>
        <h3 class="text-lg font-medium text-mono text-center mb-3">
            {{ __('Check Your Email') }}
        </h3>
        <div class="text-sm text-center text-secondary-foreground mb-7.5">
            {{ __('Please click the link we send to') }}
            <a class="text-sm text-mono font-medium hover:text-primary" href="mailto:{{ auth()->user()->email }}">
                {{ auth()->user()->email }}
            </a>
            <br />
            {{ __('to verify your email address.') }}
        </div>
        <div class="flex justify-center mb-5">
            <a class="kt-btn kt-btn-primary flex justify-center" href="{{ route('home') }}">
                {{ __('Back to Home') }}
            </a>
        </div>
        <div class="flex items-center justify-center gap-1">
            <span class="text-secondary-foreground text-xs">
                {{ __('Did not receive the email?') }}
            </span>
            <button class="font-medium kt-link text-xs" type="submit" id="resend_email_btn">
                {{ __('Resend') }}
            </button>
        </div>
    </form>
@endsection
