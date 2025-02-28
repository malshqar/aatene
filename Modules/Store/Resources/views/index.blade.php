@extends('dashboard::index', ['title' => 'المتاجر'])

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => 'قائمة المتاجر'])
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Stats-->
                <div class="row gx-6 gx-xl-9">
                    <div class="col-lg-6 col-xxl-6">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bold">{{$stores->count()}}</div>
                                <div class="fs-3 fw-semibold text-gray-500 mb-7">{{__("المتاجر الحالية")}}</div>
                                <!--end::Heading-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Chart-->
                                    <div class="d-flex flex-center h-125px w-125px me-9 mb-5">
                                        <canvas id="aatene_stores_list_chart"></canvas>
                                    </div>
                                    <!--end::Chart-->

                                    <!--begin::Labels-->
                                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                        <!--begin::Label-->
                                        <div class="d-flex fs-3 fw-semibold align-items-center mb-3">
                                            <div class="bullet bg-primary me-3"></div>
                                            <div class="text-gray-500">{{__("مفتوح")}}</div>
                                            <div class="ms-auto fw-bold text-gray-700">{{$open}}</div>
                                        </div>
                                        <!--end::Label-->

                                        <!--begin::Label-->
                                        <div class="d-flex fs-3 fw-semibold align-items-center mb-3">
                                            <div class="bullet bg-gray me-3"></div>
                                            <div class="text-gray-500">{{__("في إجازة")}}</div>
                                            <div class="ms-auto fw-bold text-gray-700">{{$close}}</div>
                                        </div>
                                        <!--end::Label-->

                                        <!--begin::Label-->
                                        <div class="d-flex fs-3 fw-semibold align-items-center mb-3">
                                            <div class="bullet bg-danger me-3"></div>
                                            <div class="text-gray-500">{{__("معطل")}}</div>
                                            <div class="ms-auto fw-bold text-gray-700">{{$pending}}</div>
                                        </div>
                                        <!--end::Label-->

                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-lg-6 col-xxl-6">
                        <!--begin::Clients-->
                        <div class="card  h-100">
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bold">{{$sellers_count}}</div>
                                <div class="fs-4 fw-semibold text-gray-500 mb-7">{{__("البائعين")}}</div>
                                <!--end::Heading-->

                                <!--begin::Users group-->
                                <div class="symbol-group symbol-hover mb-9">
                                
                                    @foreach ($sellers as $seller)
                                        <div class="symbol symbol-50px symbol-circle" data-bs-toggle="tooltip"
                                            title="{{$seller->name}}">
                                            <img alt="Pic" src="{{$seller->assets['url']}}" />
                                        </div>
                                    @endforeach

                                    <a href="{{route('dashboard.sellers.index')}}" class="symbol symbol-50px symbol-circle">
                                        <span
                                            class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{$sellers_count - 10}}</span>
                                    </a>
                                </div>
                                <!--end::Users group-->

                                <!--begin::Actions-->
                                <div class="d-flex">
                                    <a href="{{route('dashboard.sellers.index')}}" class="btn btn-primary btn-sm me-3 fs-3">{{__("جميع البائعين")}}</a>

                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                        <!--end::Clients-->
                    </div>

                </div>
                <!--end::Stats-->
                <!--begin::Toolbar-->
                <div class="card d-flex my-5">
                    <div class="card-header align-items-center">
                        <!--begin::Heading-->
                        <h2 class="fs-2 fw-semibold my-2">
                            {{__('المتاجر')}}
                        </h2>
                        <!--end::Heading-->
                        @include("store::_filters")
                    </div>
                </div>
                <!--end::Toolbar-->

                <!--begin::Row-->
                <div class="row g-6 g-xl-9">

                    @foreach ($stores as $store)
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-4">

                            <!--begin::Card-->
                            <a href="{{route('dashboard.stores.show', $store->id)}}" class="card border-hover-primary ">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-9">
                                    <!--begin::Card Title-->
                                    <div class="card-title m-0">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img src="{{$store->assets[0]['url']}}" alt="image" class="p-3" />
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Car Title-->

                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <span
                                            class="badge {{$store->is_accepted ? $store->status == 'active' ? "badge-light-primary" : "badge-light" : "badge-light-danger"}} fw-bold fs-4 me-auto px-4 py-3">
                                            {{$store->status_ar}}</span>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end:: Card header-->

                                <!--begin:: Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Name-->
                                    <div class="fs-3 fw-bold text-gray-900">
                                        {{$store->name}}</div>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">
                                       {{\Str::limit($store->description,100)}} </p>
                                    <!--end::Description-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap mb-5">
                                        <!--begin::Due-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bold">{{$store->created_at->format("M d, Y")}}</div>
                                            <div class="fw-semibold text-gray-500">{{__("تاريخ الإنضمام")}}</div>
                                        </div>
                                        <!--end::Due-->

                                        <!--begin::Budget-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bold">{{$store->last_active_at?->diffForHumans()}}</div>
                                            <div class="fw-semibold text-gray-500">{{__("تاريخ أخر ظهور")}}</div>
                                        </div>
                                        <!--end::Budget-->
                                    </div>
                                    <!--end::Info-->

                                    <!--begin::Progress-->
                                    <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip"
                                        title="{{__("تقييم هذا المتجر هو $store->rating%")}}">
                                        <div class="bg-primary rounded h-4px" role="progressbar" style="width: {{$store->rating}}%"
                                            aria-valuenow="{{$store->rating}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->

                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover">
                                        <h3 class="me-6 text-gray-500">البائع:</h3>
                                        <!--begin::User-->
                                        <div class="symbol symbol-35px symbol-circle"
                                            title="{{$store->seller->name}}" data-bs-toggle="tooltip">
                                            <img alt="Pic" src="{{$store->seller->assets['url']}}" />
                                        </div>
                                        <!--begin::User-->
                                      
                                    </div>
                                    <!--end::Users-->
                                </div>
                                <!--end:: Card body-->
                            </a>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    @endforeach

                </div>
                <!--end::Row-->

                <!--begin::Pagination-->
                <div class="pt-10">
                    {{$stores->withQueryString()->links()}}
                </div>
                <!--end::Pagination-->

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

    </div>
    <!--end::Content wrapper-->

@endsection



@push('styles')
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{--
    <script src="/assets/js/custom/apps/projects/list/list.js"></script> --}}
    <script src="/assets/js/widgets.bundle.js"></script>
    <script src="/assets/js/custom/widgets.js"></script>
    <script>
        const activeStores = {{$open}};
        const InactiveStores = {{$close}};
        const PendingStores = {{$pending}}
            "use strict";
        var KTProjectList = {
            init: function () {
                !(function () {
                    var t = document.getElementById("aatene_stores_list_chart");
                    if (t) {
                        var e = t.getContext("2d");
                        new Chart(e, {
                            type: "doughnut",
                            data: {
                                datasets: [
                                    {
                                        data: [activeStores, InactiveStores, PendingStores],
                                        backgroundColor: [
                                            "#00A3FF",
                                            "#50CD89",
                                            "#f1416c",

                                        ],
                                    },
                                ],
                                labels: ["مفتوح", "في اجازة", "معطل"],
                            },
                            options: {
                                chart: { fontFamily: "inherit" },
                                borderWidth: 0,
                                cutout: "75%",
                                cutoutPercentage: 65,
                                responsive: !0,
                                maintainAspectRatio: !1,
                                title: { display: !1 },
                                animation: { animateScale: !0, animateRotate: !0 },
                                stroke: { width: 0 },
                                tooltips: {
                                    enabled: !0,
                                    intersect: !1,
                                    mode: "nearest",
                                    bodySpacing: 5,
                                    yPadding: 10,
                                    xPadding: 10,
                                    caretPadding: 0,
                                    displayColors: !1,
                                    backgroundColor: "#20D489",
                                    titleFontColor: "#ffffff",
                                    cornerRadius: 4,
                                    footerSpacing: 0,
                                    titleSpacing: 0,
                                },
                                plugins: { legend: { display: !1 } },
                            },
                        });
                    }
                })();
            },
        };
        KTUtil.onDOMContentLoaded(function () {
            KTProjectList.init();
        });

    </script>
    <!--end::Custom Javascript-->
@endpush