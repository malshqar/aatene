@extends('dashboard::index')

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.users.index', 'previews' => 'قائمة المستخدمين', 'current' => "$user->name"])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Navbar-->
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <!--begin: Pic-->
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{$user->image}}" alt="image" />
                                        @if($user->last_active_at == now())
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
                                        <!--begin::User-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Name-->
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#"
                                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{$user->name}}</a>
                                                <a href="#">
                                                    <i class="ki-duotone ki-verify fs-1 text-primary">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </a>
                                            </div>
                                            <!--end::Name-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">

                                                <a href="#"
                                                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                    <i class="ki-duotone ki-sms fs-4 me-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>{{$user->email}}</a>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Title-->
                                    <div class="d-flex my-4">
                                        @if(!is_null($user->ban_at))
                                            <form method="post" action="{{route('dashboard.users.cancel-ban', $user->id)}}">
                                                @csrf
                                                <button class="btn btn-sm btn-danger me-3">إلغاء الحظر</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Info-->

                            </div>
                            <!--end::Details-->

                        </div>
                    </div>
                    <!--end::Navbar-->
                    @if(is_null($user->ban_at))
                        <form action="{{ route('dashboard.users.blocked', $user->id) }}" method="post">
                            @csrf
                            <!--begin::details View-->
                            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                <!--begin::Card header-->
                                <div class="card-header cursor-pointer">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">حظر المستخدم</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Row-->
                                    <div class="row mb-10">
                                        <div class="col-lg-8">
                                            @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'ban_reason', 'lable' => 'سبب الحظر ', 'placeholder' => 'أدخل سبب حظر  المستخدم'])
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <div class="row mb-4">
                                        <div class="col-lg-8">
                                            <label for="" class="form-label required">حدد مدة حظر {{ $user->name }}</label>
                                            <input class="form-control form-control-solid" placeholder="حدد المدة"
                                                id="kt_datepicker_1" name="ban_at" />

                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->

                                </div>
                                <!--end::Card body-->
                                <!--begin::Footer-->
                                <div class="card-footer">
                                    <button class="btn btn-primary  btn-sm w-150px">حظر</button>
                                    <a href="{{ route('dashboard.users.index') }}"
                                        class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                </div>
                                <!--begin::Footer-->
                            </div>
                            <!--end::details View-->

                        </form>
                    @endif
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
@endsection

@push('styles')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script>
        $("#kt_datepicker_1").flatpickr({
            enableTime: true,
            enableSeconds: true,
            dateFormat: "d-m-Y H:i:s",
        });
    </script>
@endpush