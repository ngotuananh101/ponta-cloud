<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="dark" dir="ltr" lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body
    class="antialiased flex h-full text-base text-foreground bg-background [--header-height:60px] [--sidebar-width:270px] lg:overflow-hidden">
    @include('layouts.partials.theme')
    <!--begin::Page layout-->
    <div class="flex grow">
        @include('layouts.partials.home.header')
        <div class="flex flex-col lg:flex-row grow pt-(--header-height) lg:pt-0">
            @include('layouts.partials.home.sidebar')
            <div class="flex flex-col grow lg:ms-(--sidebar-width) mt-0 lg:mt-2">
                @yield('header')
                <div class="flex flex-col grow lg:rounded-l-xl border border-input kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto] bg-background"
                    id="scrollable_content">
                    <main class="grow flex" role="content">
                        @yield('content')
                    </main>
                </div>
                @include('layouts.partials.home.footer')
            </div>
        </div>
    </div>
    <!--end::Page layout-->
    @include('layouts.partials.foot')
</body>

</html>
