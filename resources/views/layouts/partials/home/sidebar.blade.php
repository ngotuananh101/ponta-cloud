<!-- Sidebar -->
<div class="flex-col fixed top-0 bottom-0 z-20 hidden lg:flex items-stretch shrink-0 w-(--sidebar-width) dark [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false] justify-between h-full max-h-full"
    data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start flex top-0 bottom-0" id="sidebar">
    <!-- Sidebar Header -->
    <div class="flex flex-col gap-2.5" id="sidebar_header">
        <div class="flex items-center gap-2.5 px-3.5 h-[70px]">
            <a href="{{ route('home') }}">
                <img class="size-[34px]" src="{{ asset('assets/logo/logo_circle_250.png') }}" />
            </a>
            <span class="text-lg font-medium text-inverse grow">
                {{ config('app.name') }}
            </span>
        </div>
        <div class="flex items-center gap-2.5 px-3.5">
            <!-- Input -->
            <a class="kt-btn kt-btn-secondary text-white [&_i]:text-white justify-center min-w-[198px]"
                href="html/demo10/public-profile/projects/3-columns.html">
                <i class="ki-filled ki-plus">
                </i>
                Add New
            </a>
            <!-- End of Input -->
            <button class="kt-btn kt-btn-icon kt-btn-secondary [&_i]:text-white" data-kt-modal-toggle="#search_modal">
                <i class="ki-filled ki-magnifier">
                </i>
            </button>
        </div>
    </div>
    <!-- End of Sidebar Header -->
    <!-- Sidebar menu -->
    <div class="flex flex-col w-full h-full overflow-hidden">
        <div id="content" class="kt-scrollable grow overflow-y-auto p-4 pe-2 w-full" data-kt-scrollable="true"
            data-kt-scrollable-height="auto" data-kt-scrollable-dependencies="#header,#footer"
            data-kt-scrollable-wrappers="#content" data-kt-scrollable-offset="10px">
            <div class="w-full grow"></div>
        </div>
    </div>
    <!-- End of Sidebar kt-menu-->
    <!-- Footer -->
    <div class="flex flex-col flex-center justify-between shrink-0 px-3 mb-3" id="sidebar_footer">
        @if (!empty($storageInfo ?? []) && isset($cloud))
            <!-- Storage info -->
            <div class="flex flex-col flex-center justify-between shrink-0 mb-3.5 gap-2" id="sidebar_storage_info">
                <span class="text-xs font-medium">
                    {{ __('Storage') }}
                    @if (isset($cloud))
                        ({{ $cloud?->display_name }})
                    @endif
                </span>
                <div class="kt-progress">
                    <div class="kt-progress-indicator"
                        style="width: {{ data_get($storageInfo ?? [], 'used_percentage', 0) }}%;">
                    </div>
                </div>
                <span class="text-xs font-medium">
                    {{ implode(' ', [data_get($storageInfo ?? [], 'used_string', '0 B'), __('used of'), data_get($storageInfo ?? [], 'total_string', '0 B')]) }}
                    ({{ data_get($storageInfo ?? [], 'used_percentage', 0) }}%)
                </span>
            </div>
            <!-- End of Storage info -->
        @endif
        <div class="flex flex-center justify-between">
            <!-- User -->
            <div data-kt-dropdown="true" data-kt-dropdown-offset="10px, 10px" data-kt-dropdown-offset-rtl="-20px, 10px"
                data-kt-dropdown-placement="bottom-start" data-kt-dropdown-placement-rtl="bottom-end"
                data-kt-dropdown-trigger="click">
                <div class="cursor-pointer shrink-0" data-kt-dropdown-toggle="true">
                    <img alt="User avatar" class="size-9 rounded-full border-2 border-mono/25 shrink-0 cursor-pointer"
                        src="{{ auth()->user()->avatar }}" />
                </div>
                <div class="kt-dropdown-menu w-[230px] max-w-[230px] !opacity-70" data-kt-dropdown-menu="true">
                    <div class="flex items-center justify-between px-2.5 py-1.5 gap-1.5">
                        <div class="grow flex items-center gap-2">
                            <img alt="" class="w-8 h-8 shrink-0 rounded-full border-2 border-green-500"
                                src="{{ auth()->user()->avatar }}" />
                            <div class="grow flex flex-col gap-1.5 max-w-[150px]">
                                <span class="text-sm text-foreground leading-none truncate">
                                    {{ auth()->user()->name }}
                                </span>
                                <a class="text-xs text-secondary-foreground hover:text-primary leading-none truncate"
                                    href="mailto:{{ auth()->user()->email }}">
                                    {{ auth()->user()->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <ul class="kt-dropdown-menu-sub">
                        <li>
                            <div class="kt-dropdown-menu-separator">
                            </div>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link font-normal text-xs"
                                href="html/demo10/account/home/user-profile.html">
                                <i class="ki-filled ki-profile-circle">
                                </i>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a class="kt-dropdown-menu-link text-xs" href="https://ponta.dev">
                                <i class="ki-filled ki-message-programming">
                                </i>
                                Dev Tools
                            </a>
                        </li>
                        <li data-kt-dropdown="true" data-kt-dropdown-placement="right-start"
                            data-kt-dropdown-trigger="hover">
                            <button class="kt-dropdown-menu-toggle py-1" data-kt-dropdown-toggle="true">
                                <span class="flex items-center gap-2 text-xs">
                                    <i class="ki-filled ki-icon">
                                    </i>
                                    Language
                                </span>
                                <span class="ms-auto kt-badge kt-badge-stroke shrink-0">
                                    English
                                    <img alt="" class="inline-block size-3.5 rounded-full"
                                        src="assets/media/flags/united-states.svg" />
                                </span>
                            </button>
                            <div class="kt-dropdown-menu w-[180px]" data-kt-dropdown-menu="true">
                                <ul class="kt-dropdown-menu-sub">
                                    <li class="active">
                                        <a class="kt-dropdown-menu-link" href="?dir=ltr">
                                            <span class="flex items-center gap-2">
                                                <img alt="" class="inline-block size-4 rounded-full"
                                                    src="assets/media/flags/united-states.svg" />
                                                <span class="kt-menu-title">
                                                    English
                                                </span>
                                            </span>
                                            <i class="ki-solid ki-check-circle ms-auto text-green-500 text-base">
                                            </i>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a class="kt-dropdown-menu-link" href="?dir=rtl">
                                            <span class="flex items-center gap-2">
                                                <img alt="" class="inline-block size-4 rounded-full"
                                                    src="assets/media/flags/saudi-arabia.svg" />
                                                <span class="kt-menu-title">
                                                    Arabic(Saudi)
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a class="kt-dropdown-menu-link" href="?dir=ltr">
                                            <span class="flex items-center gap-2">
                                                <img alt="" class="inline-block size-4 rounded-full"
                                                    src="assets/media/flags/spain.svg" />
                                                <span class="kt-menu-title">
                                                    Spanish
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a class="kt-dropdown-menu-link" href="?dir=ltr">
                                            <span class="flex items-center gap-2">
                                                <img alt="" class="inline-block size-4 rounded-full"
                                                    src="assets/media/flags/germany.svg" />
                                                <span class="kt-menu-title">
                                                    German
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a class="kt-dropdown-menu-link" href="?dir=ltr">
                                            <span class="flex items-center gap-2">
                                                <img alt="" class="inline-block size-4 rounded-full"
                                                    src="assets/media/flags/japan.svg" />
                                                <span class="kt-menu-title">
                                                    Japanese
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="kt-dropdown-menu-separator">
                            </div>
                        </li>
                    </ul>
                    <div class="px-2.5 pt-1.5 mb-2.5 flex flex-col gap-3.5">
                        <div class="flex items-center gap-2 justify-between">
                            <span class="flex items-center gap-2">
                                <i class="ki-filled ki-moon text-base text-muted-foreground">
                                </i>
                                <span class="font-medium text-xs">
                                    {{ __('Dark Mode') }}
                                </span>
                            </span>
                            <input class="kt-switch" data-kt-theme-switch-state="dark"
                                data-kt-theme-switch-toggle="true" name="check" type="checkbox" value="1" />
                        </div>
                        <a class="kt-btn kt-btn-outline justify-center w-full" href="{{ route('logout') }}">
                            {{ __('Log out') }}
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of User -->
            <div class="flex items-center gap-1.5">
                <!-- End of Notifications -->
                <a class="kt-btn kt-btn-ghost kt-btn-icon size-8" href="{{ route('logout') }}">
                    <i class="fa-regular fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- End of Footer -->
</div>
<!-- End of Sidebar -->
