@extends('auth::layouts.master')

@section('content')

    <!--begin::Content-->
    <div class="d-flex flex-column flex-center text-center p-10">
        <!--begin::Wrapper-->
        <div class="card card-flush w-lg-650px py-5">
            <div class="card-body py-15 py-lg-20">

                <!--begin::Logo-->
                <div class="mb-14">
                    <a href="{{url('/')}}" class="">
                        <img alt="Logo" src="{{asset('assets/media/aatene-logo.png')}}" class="h-40px">
                    </a>
                </div>
                <!--end::Logo-->

                <!--begin::Title-->
                <h1 class="fw-bolder text-gray-900 mb-5">
                    {{__('التحقق من بريدك الإلكتروني')}}
                </h1>
                <!--end::Title-->
                @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-success">
                    {{__('لقد تم إرسال رابط جديد للتحقق من البريد الإلكتروني إليك عبر البريد الإلكتروني!')}}
                </div>
            @endif
                <!--begin::Action-->
                <div class="fs-6 mb-8">
                    <span class="fw-semibold text-gray-500">{{__('لم تتلق بريدا إلكترونيا؟')}}</span>
                    <form action="{{route('verification.send')}}" method="post" class="d-inline">
                        @csrf
                        <a href="{{route('verification.send')}}"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="link-primary fw-bold">
                            {{__('حاول مرة أخرى')}}</a>
                    </form>
                </div>
                <!--end::Action-->

                <!--begin::Link-->
                <div class="mb-11">
                    <a href="{{url('/')}}" class="btn btn-sm btn-primary">{{__('تخطي الآن')}}</a>
                </div>
                <!--end::Link-->

                <!--begin::Illustration-->
                <div class="mb-0">
                    <img src="{{asset('assets/media/auth/please-verify-your-email.png')}}"
                        class="mw-100 mh-300px theme-light-show" alt="">
                    <img src="{{asset('assets/media/auth/please-verify-your-email-dark.png')}}"
                        class="mw-100 mh-300px theme-dark-show" alt="">
                </div>
                <!--end::Illustration-->

            </div>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->



@endsection