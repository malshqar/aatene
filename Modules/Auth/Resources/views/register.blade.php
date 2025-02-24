@extends('auth::layouts.master')

@section('content')
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @forelse ($errors->all() as $error)
                            <li class="text-dark">{{ $error }}</li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            @endif

            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form class="form w-100" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">{{__('تسجيل حساب')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Name-->
                        <input type="text" placeholder="{{__('أدخل الإسم كامل  ')}}" name="name" autocomplete="off"
                            class="form-control bg-transparent @error('name') is-invalid @enderror" />
                        <!--end::Name-->
                        @error('name')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <li class="text-danger">{{ $message }}</li>
                            </div>
                        @enderror
                    </div>
                    <!--begin::Input group-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="{{__('أدخل البريد الاكتروني')}}" name="email" autocomplete="off"
                            class="form-control bg-transparent @error('email') is-invalid @enderror" />
                        <!--end::Email-->
                        @error('email')
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                <li class="text-danger">{{ $message }}</li>
                            </div>
                        @enderror
                    </div>
                    <!--begin::Input group-->
                    <div class="mb-5">
                        <!--begin::Input group=-->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="{{__('أدخل  رقم الهاتف')}}" name="phone_number" id="phone_number" autocomplete="off"
                                class="form-control bg-transparent @error('phone_number') is-invalid @enderror" />
                            <!--end::phone_number-->
                            @error('phone_number')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <li class="text-danger">{{ $message }}</li>
                                </div>
                            @enderror
                        </div>
                        <!--begin::Input group-->
                        <!--begin::Hint-->
                        <div class="text-muted">
                            يجب ان يتبع رقم الهاتف هذا التنسيق (+1 123 456 7890)
                        </div>
                        <!--end::Hint-->

                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent @error('password') is-invalid @enderror"
                                    type="password" placeholder="كلمة المرور" name="password" autocomplete="off">

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-2"></i> <i
                                        class="ki-duotone ki-eye fs-2 d-none"></i>
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
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
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
                            class="form-control bg-transparent @error('password') is-invalid @enderror">
                        <!--end::Repeat Password-->
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            @error('password')
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    <li class="text-danger">{{ $message }}</li>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group--->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <!--begin::Link-->
                        <a href="{{route('login')}}" class="link-primary">
                            {{__('هل لديك حساب بالفعل؟')}}
                        </a>
                        <!--end::Link-->
                        <div></div>
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Input group--->
                    <div class="fv-row mb-8 fv-plugins-icon-container">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="toc" required value="1">
                            <span class="form-check-label fw-semibold text-gray-700 fs-6 ms-1">
                                أنا أوافق على
                                <a href="#" class="ms-1 link-primary">الشروط والأحكام</a>.
                            </span>
                        </label>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Input group--->
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
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>

    <script>

        KTUtil.onDOMContentLoaded(function () {
            KTAuthNewPassword.init();
        });
        Inputmask({
            "mask": "+1 999 999 9999"
        }).mask("#phone_number");
    </script>

@endpush