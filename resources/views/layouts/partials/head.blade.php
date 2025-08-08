<title>
    @yield('title', config('app.name', 'Ponta Cloud')) | {{ config('app.name', 'Ponta Cloud') }}
</title>
<link rel="shortcut icon" href="{{ asset('assets/media/app/logo_circle_64.png') }}" type="image/png" />
<meta charset="utf-8" />
<meta content="follow, index" name="robots" />
<link href="{{ url(request()->path()) }}" rel="canonical" />
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
<meta content="@yield('description', config('app.name', 'Ponta Cloud'))" name="description" />
<meta content="Ponta Dev" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--begin::Fonts-->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<link href="{{ asset('assets/fa6/css/all.min.css') }}" rel="stylesheet" />
<!--end::Fonts-->
<!--begin::Compiled App Stylesheets-->
@vite(['resources/css/app.css'])
<!--end::Compiled App Stylesheets-->
<!--begin::Compiled App Scripts-->
@vite(['resources/js/app.js'])
<!--end::Compiled App Scripts-->
<!--begin::Custom Header Stylesheets-->
@stack('header_css')
<!--end::Custom Header Stylesheets-->
<!--begin::Custom Header Script-->
@stack('header_js')
<!--end::Custom Header Script-->
