@extends('auth::layouts.master')

@section('content')

    <!--begin::Card-->
    <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

            <!--begin::Form-->
            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                action="{{route('password.update')}}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{request()->route('token')}}" id="">
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder mb-3">
                        {{__('إعداد كلمة مرور جديدة')}}
                    </h1>
                    <!--end::Title-->

                    <!--begin::Link-->
                    <div class="text-gray-500 fw-semibold fs-6">
                        {{__('هل قمت بإعادة تعيين كلمة المرور بالفعل؟')}}

                        <a href="{{route('login')}}" class="link-primary fw-bold">
                            {{__('تسجيل الدخول')}}
                        </a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                @if (session('status'))
                    <div class="mb-4 text-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
                    <!--begin::Email-->
                    <input type="text" placeholder="{{__('البريد الإلكتروني')}}" name="email" autocomplete="off"
                        class="form-control bg-transparent" value="{{old('email')}}">
                    <!--end::Email-->
                    @error('email')
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            <li class="text-danger">{{ $message }}</li>
                        </div>
                    @enderror
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent" type="password" placeholder="كلمة المرور"
                                name="password" autocomplete="off">

                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i> <i class="ki-duotone ki-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <!--end::Input wrapper-->

                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Hint-->
                    <div class="text-muted">
                        استخدم 8 أحرف أو أكثر مع مزيج من الحروف والأرقام والرموز.
                    </div>
                    <!--end::Hint-->
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('password')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <li class="text-danger">{{ $message }}</li>
                            </div>
                        @enderror
                    </div>
                </div>
                <!--end::Input group--->

                <!--end::Input group--->
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <!--begin::Repeat Password-->
                    <input type="password" placeholder="كرر كلمة المرور" name="password_confirmation" autocomplete="off"
                        class="form-control bg-transparent">
                    <!--end::Repeat Password-->
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        @error('password')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <li class="text-danger">{{ $message }}</li>
                            </div>
                        @enderror
                    </div>
                </div>
                <!--end::Input group--->

                <!--begin::Input group--->
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <label class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="toc" value="1">

                        <span class="form-check-label fw-semibold text-gray-700 fs-6 ms-1">
                            أنا أوافق على
                            <a href="#" class="ms-1 link-primary">الشروط والأحكام</a>.
                        </span>
                    </label>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Input group--->

                <!--begin::Action-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_new_password_submit" class="btn btn-primary">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">
                            {{__('إرسال')}}</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            {{__('الرجاء الإنتظار')}}... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress--> </button>
                </div>
                <!--end::Action-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Footer-->
        <div class="px-lg-10">
            <div class="btn btn-bg-light btn-disabled">
                <img data-kt-element="current-lang-flag" class="w-30px h-30px rounded-circle me-3"
                    src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt="">
                <span data-kt-element="current-lang-name" class="me-2">العربية</span>
            </div>
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Card-->

@endsection

@push('scripts')
    <script>

        KTUtil.onDOMContentLoaded(function () {
            KTAuthNewPassword.init();
        });
    </script>

@endpush