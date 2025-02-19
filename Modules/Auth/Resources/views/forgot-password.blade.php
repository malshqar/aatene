@extends('auth::layouts.master')

@section('content')
    <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
        <!--begin::Wrapper-->
        <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">


            <!--begin::Form-->
            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                id="kt_password_reset_form" action="{{route('password.request')}}" method="post">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder mb-3">
                        {{__('هل نسيت كلمة المرور؟')}}
                    </h1>
                    <!--end::Title-->

                    <!--begin::Link-->
                    <div class="text-gray-500 fw-semibold fs-6">
                        {{__('أدخل بريدك الإلكتروني لإعادة كلمة المرور')}}
                    </div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-success">
                        {{ session('status') }}
                    </div>
                @endif
                <!--begin::Input group--->
                <div class="fv-row mb-8 fv-plugins-icon-container">
                    <!--begin::Email-->
                    <input type="text" placeholder="{{__('البريد الإلكتروني')}}" name="email" autocomplete="off"
                        class="form-control bg-transparent">
                    <!--end::Email-->
                    @if($errors->any())
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            <ul>
                                @forelse ($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                    @endif
                </div>

                <!--begin::Actions-->
                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                    <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">
                            {{__('إرسال')}}</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            {{__('إنتظر قليلاً')}}... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress-->
                    </button>

                    <a href="{{route('login')}}" class="btn btn-light">{{__('إلغاء')}}</a>
                </div>
                <!--end::Actions-->
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
@endsection