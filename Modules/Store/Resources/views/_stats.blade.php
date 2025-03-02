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
                        <div class="symbol symbol-50px symbol-circle" data-bs-toggle="tooltip" title="{{$seller->name}}">
                            <img alt="Pic" src="{{$seller->assets['url']}}" />
                        </div>
                    @endforeach

                    <a href="{{route('dashboard.sellers.index')}}" class="symbol symbol-50px symbol-circle">
                        <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{$sellers_count - 10}}</span>
                    </a>
                </div>
                <!--end::Users group-->

                <!--begin::Actions-->
                <div class="d-flex">
                    <a href="{{route('dashboard.sellers.index')}}"
                        class="btn btn-primary btn-sm me-3 fs-3">{{__("جميع البائعين")}}</a>

                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Clients-->
    </div>

</div>
<!--end::Stats-->