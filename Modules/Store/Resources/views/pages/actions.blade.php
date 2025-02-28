@extends('dashboard::index', ['title' => $store->name])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.stores.show', 'back_id' => $store->id, 'previews' => "$store->name", 'current' => "العمليات"])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    @include("store::_show_navbar", ['store' => $store])
                    <div class="card">

                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                            data-bs-target="#kt_store_delete" aria-expanded="true"
                            aria-controls="kt_store_delete">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">{{__("حذف المتجر نهائيا")}}</h3>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Content-->
                        <div id="kt_store_delete" class="collapse show">
                            <!--begin::Form-->
                            <form id="kt_store_delete_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                novalidate="novalidate" method="post" action="{{route("dashboard.stores.destroy", $store->id)}}">
                                @csrf
                                @method('DELETE')
                                <!--begin::Card body-->
                                <div class="card-body border-top p-9">

                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span
                                                class="path1"></span><span class="path2"></span><span
                                                class="path3"></span></i> <!--end::Icon-->

                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 ">
                                            <!--begin::Content-->
                                            <div class=" fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">
                                                    {{__("أنت تريد حذف هذا المتجر من المنصة بشكل نهائي")}}
                                                </h4>

                                                <div class="fs-6 text-gray-700 ">ولكن كن حذراً عند حذف هذا المتجر سيتم حذف
                                                    جميع ما يتعلق به من حسابات ومنتجات ومحادثات وطلبات ايضا.
                                                </div>
                                            </div>
                                            <!--end::Content-->

                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->

                                    <!--begin::Form input row-->
                                    <div class="form-check form-check-solid fv-row fv-plugins-icon-container">
                                        <input name="deleteStore" class="form-check-input" type="checkbox" value=""
                                            id="deleteStore">
                                        <label class="form-check-label fw-semibold ps-2 fs-6"
                                            for="deleteStore">{{__("أجل أنا متأكد من حذف هذا المتجر")}}</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Form input row-->
                                </div>
                                <!--end::Card body-->

                                <!--begin::Card footer-->
                                <div class="card-footer d-flex justify-content-start py-6 px-9">
                                    <button id="kt_store_delete_store_submit" type="submit"
                                        class="btn btn-danger fw-semibold">{{__("حذف المتجر")}}</button>
                                </div>
                                <!--end::Card footer-->

                                <input type="hidden">
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
@endsection

@push('scripts')
{{ module_vite('build-store', 'Resources/assets/js/delete.js') }}
@endpush