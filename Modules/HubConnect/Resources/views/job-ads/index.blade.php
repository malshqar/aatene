@extends('dashboard::index', ['title' => __("إعلانات الوظائف")])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => __(" إعلانات الوظائف")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            @include("hubconnect::job-ads._filters")
                            <div class="card-toolbar">
                                @can('user.create')
                                    <a href="{{ route('dashboard.job-ads.create') }}" class="btn btn-sm btn-light-primary fs-3">
                                        <i class="ki-duotone ki-plus "></i> {{__("إضافة إعلان")}} </a>
                                @endcan
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle  gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light align-middle fs-5">
                                            <th class="ps-4 min-w-50px rounded-start">#</th>
                                            <th class="min-w-250px"> {{__("العنوان")}} </th>
                                            <th class="min-w-50px"> {{__("الموقع")}} </th>
                                            <th class="min-w-50px"> {{__("المبلغ")}} </th>
                                            <th class="min-w-50px"> {{__("الشركة")}} </th>
                                            <th class="min-w-50px"> {{__("النوع")}} </th>
                                            <th class="min-w-50px"> {{__("نوع العمل")}} </th>
                                            <th class="min-w-50px">{{__("صالح حتى")}} </th>
                                            <th class="min-w-50px">{{__("تاريخ آخر تعديل")}} </th>
                                            @canany(['user.edit', 'user.ban', 'user.delete'])
                                                <th class="min-w-100px text-end rounded-end px-5">{{__("العمليات")}}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach($job_ads as $job_ad)
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                                                        {{ $loop->iteration }}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="symbol symbol-50px me-5">
                                                                                            <img src="{{ asset('assets/media/misc/spinner.gif') }}"
                                                                                                data-src="{{ $job_ad->assets['url'] }}"
                                                                                                class="lozad rounded mw-100" alt="" />
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-start flex-column">
                                                                                            <a href="{{route('dashboard.job-ads.show', $job_ad->id)}}"
                                                                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $job_ad->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$job_ad->location}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <span @class([
                                                                                        'badge-light-success',
                                                                                        'badge',
                                                                                        'fs-7 fw-bold',
                                                                                    ])>
                                                                                        {{$job_ad->salary}}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$job_ad->company}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{__($job_ad->type)}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{__($job_ad->place)}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$job_ad->deadline->format('Y-m-d')}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$job_ad->updated_at}}
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-end">

                                                                                    <a href="{{ route('dashboard.job-ads.edit', $job_ad->id) }}"
                                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                                        <i class="ki-duotone ki-pencil fs-2">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                    <a onclick="confirmDestroy('{{ route('dashboard.job-ads.destroy', $job_ad->id) }}', this)"
                                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <i class="ki-duotone ki-trash fs-2">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                            <span class="path3"></span>
                                                                                            <span class="path4"></span>
                                                                                            <span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="8"> {{ $job_ads->withQueryString()->links() }}</td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 11-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
    @push('scripts')

        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        @include('shared::layouts.assets.js.delete-script')
    @endpush
@endsection