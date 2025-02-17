@extends('dashboard::index', ['title' => 'المستخدمين'])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => 'قائمة المستخدمين'])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Row-->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">

                        @forelse ($roles as $role)
                            <!--begin::Col-->
                            <div class="col-md-4" id="deleted-item">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{ __( $role->name) }} </h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">مجموع المستخدمين الذين يمتلكون هذا
                                            الدور: {{ $role->users()->count() }}
                                        </div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            @foreach ($role->permissions()->take(5)->get() as $permission)
                                                <div class="d-flex align-items-center py-2">
                                                    <span
                                                        class="bullet bg-primary me-3"></span>{{ trans('permissions.' . $permission->name) }}
                                                </div>
                                            @endforeach
                                            <div class='d-flex align-items-center py-2'>
                                                <span class='bullet bg-primary me-3'></span>
                                                <em>و اكثر من ذلك ...</em>
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="{{ route('dashboard.roles.show', $role->id) }}"
                                            class="btn btn-light btn-active-light-primary my-1">عرض </a>
                                        <a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                            class="btn btn-light btn-active-light-success my-1">تعديل
                                        </a>
                                        <a onclick="confirmDestroy('{{ route('dashboard.roles.destroy',$role->id) }}', this)"
                                            class="btn btn-light btn-active-light-danger my-1">حذف
                                        </a>

                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        @empty
                        @endforelse
                        <!--begin::Add new card-->
                        <div class="ol-md-4">
                            <!--begin::Card-->
                            <div class="card h-md-100">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center">
                                    <!--begin::Button-->
                                    <a href="{{ route('dashboard.roles.create') }}"
                                        class="btn btn-clear d-flex flex-column flex-center">
                                        <!--begin::Illustration-->
                                        <img src="{{ asset('assets/media/illustrations/sketchy-1/4.png') }}" alt=""
                                            class="mw-100 mh-150px mb-7" />
                                        <!--end::Illustration-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">إضافة دور جديد</div>
                                        <!--end::Label-->
                                    </a>
                                    <!--begin::Button-->
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--begin::Card-->
                        </div>
                        <!--begin::Add new card-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content wrapper-->

            </div>
            <!--end:::Main-->
            @push('scripts')

                <!--begin::Vendors Javascript(used for this page only)-->
                <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
                <!--end::Vendors Javascript-->
                @include('shared::layouts.assets.js.delete-script',['closest'=>'#deleted-item'])
            @endpush
@endsection