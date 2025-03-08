@extends('dashboard::index', ['title' => __("المدونة")])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.blogs.index', 'previews' =>  __(" المدونة"), 'current' => __(" $blog->title")])
            <!--end::Toolbar-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <!--begin::Post card-->
                <div class="card">
                    <!--begin::Body-->
                    <div class="card-body p-lg-20 pb-lg-0">
                        <!--begin::Layout-->
                        <div class="d-flex flex-column flex-xl-row">
                            <!--begin::Content-->
                            <div class="flex-lg-row-fluid me-xl-15">
                                <!--begin::Post content-->
                                <div class="mb-17">
                                    <!--begin::Wrapper-->
                                    <div class="mb-8">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap mb-6">
                                            <!--begin::Item-->
                                            <div class="me-9 my-1">
                                                <!--begin::Icon-->
                                                <i class="ki-duotone ki-element-11 text-primary fs-2 me-1"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span><span class="path4"></span></i>
                                                <!--end::Icon-->

                                                <!--begin::Label-->
                                                <span class="fw-bold text-gray-500">{{$blog->updated_at->format('Y\/m\/d')}}</span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Item-->

                                            <!--begin::Item-->
                                            <div class="me-9 my-1">
                                                <!--begin::Icon-->
                                                <i class="ki-duotone ki-user text-primary fs-2 me-1"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <!--end::Icon-->

                                                <!--begin::Label-->
                                                <span class="fw-bold text-gray-500">{{$blog->writer}}</span>
                                                <!--begin::Label-->
                                            </div>
                                            <!--end::Item-->

                                        </div>
                                        <!--end::Info-->

                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold">
                                          {{$blog->title}}
                                        </a>
                                        <!--end::Title-->

                                        <!--begin::Container-->
                                        <div class="overlay mt-8">
                                            <!--begin::Image-->
                                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-350px"
                                                style="background-image:url('{{$blog->assets['url']}}')">
                                            </div>
                                            <!--end::Image-->

                                         
                                        </div>
                                        <!--end::Container-->
                                    </div>
                                    <!--end::Wrapper-->

                                    <!--begin::Description-->
                                    <div class="fs-5 fw-semibold text-gray-600">
                                        <!--begin::Text-->
                                        <p class="mb-8">
                                          {!!$blog->content!!}
                                        </p>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Description-->


                                </div>
                                <!--end::Post content-->

                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Layout-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Post card-->
            </div>
        </div>
    </div>
@endsection