@extends('dashboard::index',['title'=>'إضافة مدير'])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.admins.index', 'previews' => 'قائمة المدراء', 'current' => 'اضافة مدير جديد'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <form class="form d-flex flex-column flex-lg-row" action="{{ route('dashboard.admins.store') }}"
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
                                        <h2>ارفع صورة للمدير</h2>
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
                                        <span class="card-label fw-bold fs-3 mb-1"> إضافة مدير</span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-3">
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'name', 'lable' => 'اسم المدير', 'placeholder' => 'أدخل اسم المدير'])
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'email', 'lable' => 'بريد المدير', 'placeholder' => 'أدخل بريد المدير'])
                                    </div>
                                    <div class="mb-5">
                                        @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'phone_number', 'lable' => 'رقم هاتف المدير', 'placeholder' => 'أدخل رقم هاتف المدير'])
                                        <!--begin::Hint-->
                                        <div class="text-muted">
                                            يجب ان يتبع رقم الهاتف هذا التنسيق (+1 123 456 7890)
                                        </div>
                                        <!--end::Hint-->

                                    </div>
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
                                        @include('shared::layouts.forms.lables.lable', ['lable' => 'حالة المدير'])

                                        <select data-control="select2" name="status" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('status'),
                                        ])
                                            placeholder="اختر حالة هذا الموظف">
                                            <option value="active" @selected(old('status') == 'active')>حساب فعال</option>
                                            <option value="inactive" @selected(old('status') == 'inactive')>حساب غير فعال</option>
                                        </select>
                                    </div>
                                    <div class="mb-5">
                                    @include('shared::layouts.forms.lables.lable', ['lable' => 'دور المدير'])

                                        <select data-control="select2" name="role_ids[]" @class([
                                            'form-select',
                                            'form-select-solid ',
                                            'is-invalid' => $errors->has('role_ids'),
                                        ])
                                            multiple placeholder="اختر دور هذا المدير">
                                            @foreach ($roles??[] as $role)
                                                <option value="{{ $role->id }}" @if (old('role_ids') && in_array($role->id, old('role_ids'))) selected @endif>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!--begin::Body-->
                                <!--begin::Footer-->
                                <div class="card-footer py-3">
                                    <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                    <a href="{{ route('dashboard.admins.index') }}"
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
    @endpush
@endsection