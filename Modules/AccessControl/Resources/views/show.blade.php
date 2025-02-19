@extends('dashboard::index', ['title' => $user->name])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.users.index', 'previews' => 'قائمة المستخدمين', 'current' => "$role->name"])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                            <!--begin::Card-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="mb-0">{{ __($role->name) }}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Permissions-->
                                    <div class="d-flex flex-column text-gray-600">
                                        @foreach ($role->permissions()->take(10)->get() as $permission)
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>{{ __('permissions.'.$permission->name) }}
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
                                <div class="card-footer pt-0">
                                    <a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                        class="btn btn-light btn-active-primary">تعديل</a>
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-10">
                            <!--begin::Card-->
                            <div class="card card-flush mb-6 mb-xl-9">
                                <!--begin::Card header-->
                                <div class="card-header pt-5">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="d-flex align-items-center">المدراء اصحاب دور
                                            {{ __('permissions.' . $role->name) }}
                                            <span class="text-gray-600 fs-6 ms-1">({{ $role->users()->count() }})</span>
                                        </h2>
                                    </div>
                                    <!--end::Card title-->

                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                                <th class="w-10px pe-2">#</th>
                                                <th class="min-w-150px">المدير</th>
                                                <th class="min-w-125px">تاريخ الانضمام</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @forelse ($role->users()->get() as $user)
                                                <tr>
                                                    <td class="w-10px pe-2">{{ $user->id }}</td>
                                                    <td class="d-flex align-items-center">
                                                        <!--begin:: Avatar -->
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <a href="{{ route('dashboard.admins.show', $user->id) }}">
                                                                <div class="symbol-label">
                                                                    <img src="{{ $user->assets['url'] }}" class="w-100" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::User details-->
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ route('dashboard.admins.show', $user->id) }}"
                                                                class="text-gray-800 text-hover-primary mb-1">{{$user->name}}</a>
                                                            <span>{{ $user->email }}</span>
                                                        </div>
                                                        <!--begin::User details-->
                                                    </td>
                                                    <td>{{ $user->created_at->format('Y/m/d | h:i:s') }}</td>
                                                </tr>
                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->

                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end:::Main-->
@endsection