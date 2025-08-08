<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="dark" dir="ltr" lang="en">

<head>
    @include('layouts.partials.head')
    <style>
        .page-bg {
            background-image: url('{{ asset('assets/images/bg.png') }}');
        }

        .dark .page-bg {
            background-image: url('{{ asset('assets/images/bg-dark.png') }}');
        }
    </style>
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background">
    @include('layouts.partials.theme')
    <!--begin::Page layout-->
    <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
        <div class="kt-card max-w-[370px] w-full">
            @yield('content')
        </div>
    </div>
    <!--end::Page layout-->
    @include('layouts.partials.foot')
    @include('layouts.partials.auth.common_script')
</body>

</html>
