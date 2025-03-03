@extends('dashboard::index', ['title' => 'الإعلانات'])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => 'قائمة الإعلانات'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <div class="card-title align-items-start flex-column">
                                @include('ads::_filters')
                            </div>
                            <div class="card-toolbar">
                                @can('user.create')
                                    <a href="{{ route('dashboard.ads.create') }}" class="btn btn-sm btn-light-primary fs-3">
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
                                <table class="table align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light fs-5">
                                            <th class="ps-4 min-w-50px rounded-start">#</th>
                                            <th class="min-w-225px"> {{__("الإعلان")}} </th>
                                            <th class="min-w-100px"> {{__("الرابط")}}</th>
                                            <th class="min-w-50px"> {{__("بداية الإعلان")}} </th>
                                            <th class="min-w-50px">{{__("نهاية الإعلان")}}</th>
                                            @canany(['user.edit', 'user.ban', 'user.delete'])
                                                <th class="min-w-100px text-end rounded-end px-5">{{__("العمليات")}} </th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach ($ads as $ad)
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
                                                                data-src="{{ $ad->assets['url'] }}" class="lozad rounded mw-100"
                                                                alt="" />
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $ad->name }}
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a target="_blanck" href="{{$ad->url}}">
                                                        <span
                                                            class="badge badge-light-primary fs-7 fw-bold">{{__("إضغط لعرض الرابط")}}</span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <span
                                                        class="fs-5 fw-bold">{{\Carbon\Carbon::parse($ad->start_at)->diffForHumans() }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="fs-5 fw-bold">{{ \Carbon\Carbon::parse($ad->end_at)->diffForHumans() }}</span>
                                                </td>
                                                @canany(['user.edit', 'user.ban', 'user.delete'])

                                                    <td class="text-end">
                                                        @can('user.edit')
                                                            <a href="{{ route('dashboard.ads.edit', $ad->id) }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <i class="ki-duotone ki-pencil fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </a>
                                                        @endcan 
                                                        @can('user.delete')
                                                            <a onclick="confirmDestroy('{{ route('dashboard.ads.destroy', $ad->id) }}', this)"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                <i class="ki-duotone ki-trash fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                </i>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8"> {{ $ads->WithQueryString()->links() }}</td>
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