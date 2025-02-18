@extends('dashboard::index', ['title' => 'اضافة بائع'])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.sellers.index', 'previews' => 'قائمة البائعين', 'current' => 'اضافة بائع جديد'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('dashboard.sellers.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Aside column-->
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!--begin::logo for store-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="required card-title">
                                        <h2>ارفع صورة للبائع</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body text-center pt-0">
                                    @include('shared::layouts.forms.inputs.image-with-lable', ['name' => 'avatar'])
                                    <!--begin::Hint-->
                                    <div class="text-muted">
                                        قم باضافة الصور مع مراعات ان لايزيد حجكها عن ا ميجا وتكون من نوع
                                        png,jpg,webm,jpeg,webp.
                                    </div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Card body-->

                            </div>
                            <!--end::logo for store-->

                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4 ">
                                <!--begin::Header-->
                                <div class="card-header border-0 ">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة بائع</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'name', 'lable' => 'اسم البائع', 'placeholder' => 'أدخل اسم البائع'])
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'email', 'lable' => 'بريد البائع', 'placeholder' => 'أدخل بريد البائع'])
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'phone_number', 'lable' => 'رقم هاتف البائع', 'placeholder' => 'أدخل رقم هاتف البائع', 'id' => 'phone_number'])
                                        <!--begin::Hint-->
                                        <div class="text-muted">
                                            يجب ان يتبع رقم الهاتف هذا التنسيق (+1 123 456 7890)
                                        </div>
                                        <!--end::Hint-->

                                    </div>
                                    <!--begin::Input group-->

                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.lables.lable', ['lable' => 'العملات الذهبية'])

                                        <div class="input-group mb-5">
                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-dash fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('gold_coins')])
                                                id="gold_coins" name="gold_coins" />
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    <!--begin::Input group-->
                                    <div class="mb-5">
                                        @include(
                                            'shared::layouts.forms.inputs.input-with-lable',
                                            [
                                                'name' => 'password',
                                                'lable' => '  كلمة السر ',
                                                'type' => 'password',
                                                'placeholder' => "أدخل  كلمة السر ",
                                                'autocomplete' => "off"
                                            ]
                                        )
                                    </div>
                                    <div class="mb-5">
                                        @include(
                                            'shared::layouts.forms.inputs.input-with-lable',
                                            [
                                                'name' => 'password_confirmation',
                                                'lable' => ' تاكيد كلمة السر ',
                                                'type' => 'password',
                                                'placeholder' => "أدخل تاكيد كلمة السر ",
                                                'autocomplete' => "off"
                                            ]
                                        )
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.lables.lable', ['lable' => 'حالة البائع'])

                                        <select data-control="select2" name="status" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('status'),
                                        ])
                                            placeholder="اختر حالة هذا البائع">
                                            <option value="active" @selected(old('status') == 'active')>حساب فعال</option>
                                            <option value="inactive" @selected(old('status') == 'inactive')>حساب غير فعال
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('dashboard.sellers.index') }}"
                                        class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                </div>
                                <!--begin::Footer-->
                            </div>
                        </div>
                        <!--end::Main column-->
                    </form>
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
    @push('scripts')
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        <script>
            Inputmask({
                "mask": "+1 999 999 9999"
            }).mask("#phone_number");
            Inputmask("decimal", {
            }).mask("#gold_coins");
        </script>
    @endpush

@endsection