<!--begin::Navbar-->
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{$store->assets[0]['url']}}" alt="image" />
                    @if($store->seller->last_active_at == now())
                        <div
                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                        </div>
                    @endif
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::store-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$store->name}}</a>
                            @if ($store->is_accepted)
                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            @endif

                        </div>
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mt-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2 pe-5">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>{{$store->seller->name}}</a>

                            <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-geolocation fs-4 me-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                                {{$store->location ?? "لا يوجد" }}
                            </a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>{{$store->seller->email}}</a>

                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::store-->
                    @if (!$store->is_accepted)
                        <div class="d-flex my-4">
                            <form method="post" action="{{route('dashboard.stores.accept', $store->id)}}">
                                @csrf
                                <a onclick="event.preventDefault(); this.closest('form').submit()"
                                    href="{{route('dashboard.stores.accept', $store->id)}}" class="btn btn-sm btn-light me-2"
                                    id="kt_user_follow_button">
                                    <i class="ki-duotone ki-check fs-3 d-none"></i>
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        {{__("تفعيل المتجر")}}</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        {{__("إنتظر قليلاً")}}... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress-->
                                </a>
                            </form>
                        </div>
                        @else
                        <div class="d-flex my-4">
                            <form method="post" action="{{route('dashboard.stores.accept', $store->id)}}">
                                @csrf
                                <a onclick="event.preventDefault(); this.closest('form').submit()"
                                    href="{{route('dashboard.stores.accept', $store->id)}}" class="btn btn-sm btn-light me-2"
                                    id="kt_user_follow_button">
                                    <i class="ki-duotone ki-check fs-3 d-none"></i>
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        {{__("تعطيل المتجر")}}</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        {{__("إنتظر قليلاً")}}... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress-->
                                </a>
                            </form>
                        </div>
                    @endif
                </div>
                <!--end::Title-->
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-2 fw-bold counted" data-kt-countup="true"
                                        data-kt-countup-value="4500" data-kt-countup-prefix="$" data-kt-initialized="1">
                                        $4,500</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-500">المراجعات</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="80"
                                        data-kt-initialized="1">80</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-500">المنتجات</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    <div class="fs-2 fw-bold counted" data-kt-countup="true" data-kt-countup-value="60"
                                        data-kt-countup-prefix="%" data-kt-initialized="1">%60</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-500">الطلبات </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Progress-->
                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                            <span class="fw-semibold fs-6 text-gray-500">التقييم</span>
                            <span class="fw-bold fs-6">{{$store->rating}}%</span>
                        </div>

                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                            <div class="bg-success rounded h-5px" role="progressbar" style="width: {{$store->rating}}%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end::Progress-->
                </div>
            </div>
            <!--end::Info-->

        </div>
        <!--end::Details-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Route::is('dashboard.stores.show', $store->id) ? "active" : ""}}"
                    href="/metronic8/demo1/pages/user-profile/overview.html">
                    نظرة عامة </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                    href="/metronic8/demo1/pages/user-profile/projects.html">
                    المنتجات </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                    href="/metronic8/demo1/pages/user-profile/campaigns.html">
                    الطلبات </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                    href="/metronic8/demo1/pages/user-profile/documents.html">
                    المراجعات </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                    href="/metronic8/demo1/pages/user-profile/followers.html">
                    المتابعين </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 "
                    href="/metronic8/demo1/pages/user-profile/activity.html">
                    الأنشطة </a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{Route::is('dashboard.stores.actions', $store->id) ? "active" : ""}}"
                    href="{{route('dashboard.stores.actions', $store->id)}}">
                    العمليات </a>
            </li>
            <!--end::Nav item-->
        </ul>
    </div>
</div>
<!--end::Navbar-->