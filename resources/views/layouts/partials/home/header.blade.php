<!-- Header -->
<header
    class="flex lg:hidden items-center fixed z-10 top-0 start-0 end-0 shrink-0 bg-mono dark:bg-background h-(--header-height)"
    id="header">
    <!-- Container -->
    <div class="kt-container-fixed flex items-center justify-between flex-wrap gap-3">
        <a href="{{ route('home') }}">
            <img class="size-[34px]" src="{{ asset('assets/logo/logo_circle_250.png') }}" />
        </a>
        <button class="kt-btn kt-btn-icon kt-btn-dim hover:text-white -me-2" data-kt-drawer-toggle="#sidebar">
            <i class="fa-regular fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- End of Container -->
</header>
<!-- End of Header -->
