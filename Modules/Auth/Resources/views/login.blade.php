@extends('auth::layouts.master')

@section('content')
{{config('fortify.guard')}}
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">

            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">تسجيل الدخول </h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="أدخل البريد الاكتروني" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" />
                        <!--end::Email-->
                        @error('email')
                            <div>
                                <p class="mt-1 text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-3">
                        <!--begin::Password-->
                        <input type="password" placeholder="ادخل كلمة السر " name="password" autocomplete="off" class="form-control bg-transparent @error('password') is-invalid @enderror" />
                        <!--end::Password-->
                        @error('password')
                            <div>
                                <p class="mt-1 text-danger">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <!--begin::Link-->
                        <a href="/metronic8/demo1/authentication/layouts/creative/reset-password.html" class="link-primary">
                            هل نسيت كلمة السر؟
                        </a>
                        <!--end::Link-->
                        <div></div>
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">تسجيل دخول</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                </form>
                <!--end::Form-->
            </div>
            <!--begin::Toggle-->
            <div class="px-10">
                <div class="btn btn-bg-light btn-disabled">
                    <img data-kt-element="current-lang-flag" class="w-30px h-30px rounded-circle me-3"
                        src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt="">
                    <span data-kt-element="current-lang-name" class="me-2">العربية</span>
                </div>
            </div>

            <!--end::Wrapper-->

        </div>
        <!--end::Card-->
    </div>
    <!--end::Body-->
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
@endpush