<div class="kt-drawer kt-drawer-end card flex-col max-w-[90%] w-[450px] top-5 bottom-5 end-5 rounded-xl border border-border hidden"
    data-kt-drawer="true" data-kt-drawer-container="body" id="activities_drawer" data-kt-drawer-initialized="true"
    style="">
    <div class="flex items-center justify-between gap-2.5 text-sm text-mono font-semibold px-5 py-2.5 border-b border-b-border"
        id="notifications_header">
        {{ __('message.top_50_activities') }}
        <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-dim shrink-0" data-kt-drawer-dismiss="true">
            <i class="ki-filled ki-cross">
            </i>
        </button>
    </div>
    {{-- List activities here --}}
    <div class="grow kt-scrollable-y-auto" data-kt-scrollable="true" data-kt-scrollable-dependencies="#header"
        data-kt-scrollable-max-height="auto" data-kt-scrollable-offset="20px" data-kt-scrollable-initialized="true"
        style="max-height: 795px;" id="activities_list">
        <div class="grow flex flex-col gap-5 pt-3 pb-4 divider-y divider-border">
            <div class="flex grow gap-2.5 px-5">
                <div class="kt-avatar size-8">
                    <div class="kt-avatar-image">
                        <img alt="avatar" src="{{ asset('assets/media/images/default.jpg') }}">
                    </div>
                </div>
                <div class="flex flex-col gap-3.5">
                    <div class="flex flex-col gap-1">
                        <div class="text-sm font-medium">
                            <a class="hover:text-primary text-mono font-semibold" href="#">
                                Joe Lincoln
                            </a>
                            <span class="text-secondary-foreground">
                                mentioned you in
                            </span>
                            <a class="hover:text-primary text-primary" href="#">
                                Latest Trends
                            </a>
                            <span class="text-secondary-foreground">
                                topic
                            </span>
                        </div>
                        <span class="flex items-center text-xs font-medium text-muted-foreground">
                            18 mins ago
                            <span class="rounded-full size-1 bg-mono/30 mx-1.5">
                            </span>
                            Web Design 2024
                        </span>
                    </div>
                </div>
            </div>
            <div class="border-b border-b-border">
            </div>
        </div>
    </div>
    {{-- Loading --}}
    <div class="grow flex flex-col items-center justify-center text-muted-foreground text-sm font-medium px-5 py-4"
        id="activities_loading">
        <div class="spinner">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
        <span class="ml-2 mt-3">
            {{ __('message.loading') }}
        </span>
    </div>
    {{-- No activities --}}
    <div class="flex items-center justify-center text-muted-foreground text-sm font-medium px-5 py-4"
        id="activities_empty">
        <span class="text-muted-foreground">
            {{ __('message.no_activities') }}
        </span>
    </div>

    <div class="grow flex flex-col gap-5 pt-3 pb-4 divider-y divider-border hidden" id="activities_list_template">
        <div class="flex grow gap-2.5 px-5">
            <div class="kt-avatar size-8">
                <div class="kt-avatar-image">
                    <img alt="avatar" src="{{ asset('assets/media/images/default.jpg') }}">
                </div>
            </div>
            <div class="flex flex-col gap-3.5">
                <div class="flex flex-col gap-1">
                    <div class="text-sm font-medium">
                        <span class="text-mono font-semibold actor">
                            Name
                        </span>
                        >
                        <span id="text_localized">
                            Activity Text
                        </span>
                    </div>
                    <span class="flex items-center text-xs font-medium text-muted-foreground" id="full_time">
                        Time
                    </span>
                </div>
            </div>
        </div>
        <div class="border-b border-b-border">
        </div>
    </div>
</div>
