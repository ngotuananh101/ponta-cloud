<ol class="kt-breadcrumb">
    <li class="kt-breadcrumb-item truncate">
        <a href="{{ route('home') }}" class="kt-breadcrumb-link"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house" aria-hidden="true">
                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                <path
                    d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z">
                </path>
            </svg></a>
    </li>
    @if (!empty($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs) > 0)
        <li class="kt-breadcrumb-separator">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-right" aria-hidden="true">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </li>
        @if (count($breadcrumbs) == 1)
            <li class="kt-breadcrumb-item truncate">
                <span class="kt-breadcrumb-page">
                    {{ $breadcrumbs[0]['label'] ?? '' }}
                </span>
            </li>
        @elseif (count($breadcrumbs) == 2)
            <li class="kt-breadcrumb-item">
                <a href="{{ route('home.folder.path', ['path' => $breadcrumbs[0]['url']]) }}"
                    class="kt-breadcrumb-link">{{ $breadcrumbs[0]['label'] }}</a>
            </li>
            <li class="kt-breadcrumb-separator">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right" aria-hidden="true">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li class="kt-breadcrumb-item">
                <span class="kt-breadcrumb-page">
                    {{ $breadcrumbs[1]['label'] ?? '' }}
                </span>
            </li>
        @else
            <li class="kt-breadcrumb-item">
                <div data-kt-dropdown="true" data-kt-dropdown-trigger="click">
                    <button class="kt-btn kt-btn-icon kt-btn-dim" data-kt-dropdown-toggle="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-ellipsis" aria-hidden="true">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </button>
                    <div class="kt-dropdown-menu w-fit" data-kt-dropdown-menu="true">
                        <ul class="kt-dropdown-menu-sub">
                            @for ($i = 0; $i < count($breadcrumbs) - 1; $i++)
                                <li>
                                    <a href="{{ route('home.folder.path', ['path' => $breadcrumbs[$i]['url']]) }}"
                                        class="kt-dropdown-menu-link font-normal text-xs">
                                        {{ $breadcrumbs[$i]['label'] }}
                                    </a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </li>
            <li class="kt-breadcrumb-separator">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right" aria-hidden="true">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
            <li class="kt-breadcrumb-item">
                <span class="kt-breadcrumb-page">
                    {{ $breadcrumbs[count($breadcrumbs) - 1]['label'] ?? '' }}
                </span>
            </li>
        @endif
    @endif
</ol>
