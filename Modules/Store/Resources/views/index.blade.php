@extends('dashboard::index', ['title' => 'المتاجر'])

@section('content')

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => 'قائمة المتاجر'])
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                {{-- @include('store::_stats') --}}
                <!--begin::Toolbar-->
                <div class="card d-flex my-5">
                    <div class="card-header align-items-center border-0">
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
                                        {{$store->name}}
                                    </div>
                                    <!--end::Name-->

                                    <!--begin::Description-->
                                    <p class="text-gray-500 fw-semibold fs-5 mt-1 mb-7">
                                        {{\Str::limit($store->description, 100)}}
                                    </p>
                                    <!--end::Description-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap mb-5">
                                        <!--begin::Due-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bold">
                                                {{$store->created_at->format("M d, Y")}}
                                            </div>
                                            <div class="fw-semibold text-gray-500">
                                                {{__("تاريخ الإنضمام")}}
                                            </div>
                                        </div>
                                        <!--end::Due-->

                                        <!--begin::Budget-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bold">
                                                {{$store->last_active_at?->diffForHumans()}}
                                            </div>
                                            <div class="fw-semibold text-gray-500">
                                                {{__("تاريخ أخر ظهور")}}
                                            </div>
                                        </div>
                                        <!--end::Budget-->

                                    </div>
                                    <!--end::Info-->

                                    <!--begin::Progress-->
                                    <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip"
                                        title="{{__("تقييم هذا المتجر هو $store->rating%")}}">
                                        <div class="bg-primary rounded h-4px" role="progressbar"
                                            style="width: {{$store->rating}}%" aria-valuenow="{{$store->rating}}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <!--end::Progress-->


                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover">
                                        <h3 class="me-6 text-gray-500">البائع:</h3>
                                        <!--begin::User-->
                                        <div class="symbol symbol-35px symbol-circle" title="{{$store->seller->name}}"
                                            data-bs-toggle="tooltip">
                                            <img alt="Pic" src="{{$store->seller->assets['url']}}" />
                                        </div>
                                        <!--begin::User-->
                                    </div>
                                    <!--end::Users-->

                                    <!--begin::Groups-->
                                        @foreach ($store->groups as $group)
                                            <p class="badge badge-light-primary py-4 mt-5">{{$group->name}}</p>
                                        @endforeach
                                
                                    <!--end::Groups-->
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
    </script>
    {{ module_vite('build-store', 'Resources/assets/js/app.js') }}


    <!--end::Custom Javascript-->
@endpush