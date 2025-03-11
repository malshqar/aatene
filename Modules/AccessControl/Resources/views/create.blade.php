@extends('dashboard::index', ['title' => 'اضافة دور جديد'])
@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.roles.index', 'previews' => 'قائمة الأدوار', 'current' => 'اضافة دور جديد'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-4">
                            <div class="card-title align-items-start flex-column ">

                            </div>
                            <div class="card-body">
                                <!--begin::Form-->
                                <form id="kt_modal_add_role_form" class="form" action="{{ route('dashboard.roles.store') }}"
                                    method="POST">
                                    @csrf
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_role_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <div class="mb-5">
                                                @include('shared::layouts.forms.inputs.input-with-lable', ['name' => 'name', 'lable' => 'اسم الدور', 'placeholder' => 'أدخل اسم الدور'])
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Permissions-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-bold form-label mb-2">الصلاحيات</label>
                                            <!--end::Label-->
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="text-gray-600 fw-semibold">
                                                        <!--begin::Table row-->
                                                        <tr>
                                                            <td class="text-gray-800">تعيين
                                                                {{ trans('permissions.super_admin') }} <span class="ms-2"
                                                                    data-bs-toggle="popover" data-bs-trigger="hover"
                                                                    data-bs-html="true"
                                                                    data-bs-content="Allows a full access to the system">
                                                                    <i class="ki-duotone ki-information fs-7">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                        <span class="path3"></span>
                                                                    </i>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-custom form-check-solid me-9">
                                                                    <input class="form-check-input" type="checkbox" value=""
                                                                        id="checkAll" />
                                                                    <span class="form-check-label" for="checkAll">اختيار
                                                                        الكل</span>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            </td>
                                                        </tr>
                                                        <!--end::Table row-->
                                                        @foreach ($permissions->split(14) as $permissions)
                                                            <!--begin::Table row-->
                                                            <tr>
                                                                @foreach ($permissions as $permission)
                                                                    <!--begin::Options-->
                                                                    <td>
                                                                        <!--begin::Wrapper-->
                                                                        <div class="d-flex">
                                                                            <!--begin::Checkbox-->
                                                                            <label
                                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                <input class="checkbox form-check-input"
                                                                                    type="checkbox" value="{{ $permission->id }}"
                                                                                    name="permission_ids[]" />
                                                                                <span
                                                                                    class="form-check-label">{{ trans('permissions.' . $permission->name)}}</span>
                                                                            </label>
                                                                            <!--end::Checkbox-->
                                                                        </div>
                                                                        <!--end::Wrapper-->
                                                                    </td>
                                                                    <!--end::Options-->
                                                                @endforeach
                                                            </tr>
                                                            <!--end::Table row-->
                                                        @endforeach

                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button class="btn btn-primary  btn-sm w-150px">حفظ</button>
                                        <a href="{{ route('dashboard.roles.index') }}"
                                            class="btn btn-danger  btn-sm  w-150px">عودة</a>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->

                            </div>

                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Tables Widget 11-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
    @push('scripts')
        <script>
            const checkAllCheckbox = document.getElementById('checkAll');
            const checkboxes = document.getElementsByClassName('checkbox');

            checkAllCheckbox.addEventListener('change', function () {
                const isChecked = checkAllCheckbox.checked;

                for (let i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = isChecked;
                }
            });

            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', function () {
                    // Uncheck "Check All" checkbox if any checkbox is unchecked
                    if (!this.checked) {
                        checkAllCheckbox.checked = false;
                    }

                    // Check if all checkboxes are checked and update "Check All" checkbox state
                    checkAllCheckbox.checked = Array.from(checkboxes).every(checkbox => checkbox.checked);
                });
            }
        </script>
    @endpush
@endsection