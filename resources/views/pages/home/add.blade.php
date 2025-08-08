@extends('layouts.home')

@section('content')
    <div class="flex flex-col grow p-5">
        <h1 class="text-lg">{{ __('Select cloud provider you want to add') }}</h1>
        <div class="grow flex flex-col w-full h-full overflow-hidden mt-5">
            <div id="select-cloud" class="kt-scrollable grow overflow-y-auto pe-2 w-full" data-kt-scrollable="true"
                data-kt-scrollable-height="auto" data-kt-scrollable-dependencies="#header,#footer"
                data-kt-scrollable-wrappers="#select-cloud" data-kt-scrollable-offset="150px">
                <div
                    class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7">
                    @foreach ($clouds as $key => $cloud)
                        <div>
                            <a href="javascript:void(0);"
                                class="p-3 kt-card kt-card-flush kt-card-bordered hover:shadow-lg transition-all duration-300"
                                data-kt-modal-toggle="#add_cloud_{{ $key }}">
                                <div class="kt-card-body flex flex-col items-center justify-center">
                                    <img src="{{ $cloud['icon'] }}" alt="{{ $cloud['name'] }}" class="w-12 h-12 mb-3">
                                    <h4 class="text-sm font-normal">{{ $cloud['name'] }}</h4>
                                </div>
                            </a>
                            @if (view()->exists('pages.home.add_cloud.' . $key))
                                @include('pages.home.add_cloud.' . $key)
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
