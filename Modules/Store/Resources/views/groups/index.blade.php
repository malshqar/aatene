@extends('dashboard::index', ['title' => 'المجموعات'])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => 'قائمة المجموعات'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">

                        @forelse ($groups as $group)
                            <!--begin::Col-->
                            <div class="col-md-4" id="deleted-item">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="d-flex flex-center overflow-hidden ">
                                        <img src="{{    asset('assets/media/misc/spinner.gif')  }}"
                                            data-src="{{ $group->assets['url']  }}" class="lozad rounded-top mw-100" alt="" />
                                    </div>

                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{ __($group->name) }} </h2>
                                        </div>
                                        <!--end::Card title-->

                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">عدد المتاجر الذين ينتمون الى هذه المجموعة:
                                            {{ $group->stores()->count() }}
                                        </div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            @foreach ($group->stores()->take(10)->get() as $store)
                                                <div class="d-flex align-items-center py-2">
                                                    <span
                                                        class="bullet bg-primary me-3"></span>{{ $store->name }}
                                                </div>
                                            @endforeach
                                            @if($group->stores()->count() > 10)
                                                <div class='d-flex align-items-center py-2'>
                                                    <span class='bullet bg-primary me-3'></span>
                                                    <em>{{__("و اكثر من ذلك ...")}}</em>
                                                </div>
                                            @elseif ($group->stores()->count() == 0)
                                                <div class='d-flex align-items-center py-2'>
                                                    <span class='bullet bg-primary me-3'></span>
                                                    <em>{{__('لايوجد اي متجر حاليا.')}}</em>
                                                </div>
                                            @endif

                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        {{-- <a href="{{ route('dashboard.groups.show', $group->id) }}"
                                            class="btn btn-light btn-active-light-primary my-1">عرض </a> --}}
                                        <a href="{{ route('dashboard.groups.edit', $group->id) }}"
                                            class="btn btn-light btn-active-light-success my-1">تعديل
                                        </a>
                                        <a onclick="confirmDestroy('{{ route('dashboard.groups.destroy', $group->id) }}', this)"
                                            class="btn btn-light btn-active-light-danger my-1">حذف
                                        </a>

                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        @empty
                        @endforelse
                        <!--begin::Add new card-->
                        <div class="ol-md-4">
                            <!--begin::Card-->
                            <div class="card h-md-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center">
                                    <!--begin::Button-->
                                    <a href="{{ route('dashboard.groups.create') }}"
                                        class="btn btn-clear d-flex flex-column flex-center">
                                        <!--begin::Illustration-->
                                        <img src="{{ asset('assets/media/illustrations/sketchy-1/4.png') }}" alt=""
                                            class="mw-100 mh-150px mb-7" />
                                        <!--end::Illustration-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">
                                            {{__("إضافة مجموعة جديدة")}}
                                        </div>
                                        <!--end::Label-->
                                    </a>
                                    <!--begin::Button-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--begin::Add new card-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content wrapper-->

            </div>
            <!--end:::Main-->
            @push('scripts')

                <!--begin::Vendors Javascript(used for this page only)-->
                <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
                <!--end::Vendors Javascript-->
                @include('shared::layouts.assets.js.delete-script', ['closest' => '#deleted-item'])
            @endpush
@endsection