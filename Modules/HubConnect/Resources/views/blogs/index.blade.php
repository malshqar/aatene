@extends('dashboard::index', ['title' => __("المدونة")])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => __(" المدونة")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            @include("hubconnect::blogs._filters")
                            <div class="card-toolbar">
                                @can('user.create')
                                    <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-sm btn-light-primary fs-3">
                                        <i class="ki-duotone ki-plus "></i> {{__("تدوين")}} </a>
                                @endcan
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light fs-5">
                                            <th class="ps-4 min-w-50px rounded-start">#</th>
                                            <th class="min-w-225px"> {{__("العنوان")}} </th>
                                            <th class="min-w-225px"> {{__("المحرر")}} </th>
                                            <th class="min-w-225px"> {{__("الحالة")}} </th>
                                            <th class="min-w-50px">{{__("تاريخ آخر تعديل")}} </th>
                                            @canany(['user.edit', 'user.ban', 'user.delete'])
                                                <th class="min-w-100px text-end rounded-end px-5">{{__("العمليات")}}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach($blogs as $blog)
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                                                        {{ $loop->iteration }}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="symbol symbol-50px me-5">
                                                                                            <img src="{{ asset('assets/media/misc/spinner.gif') }}"
                                                                                                data-src="{{ $blog->assets['url'] }}"
                                                                                                class="lozad rounded mw-100" alt="" />
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-start flex-column">
                                                                                            <a href="{{route('dashboard.blogs.show', $blog->id)}}"
                                                                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $blog->title }}
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$blog->admin->name}}
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <span @class([
                                                                                        "badge-light-warning" => !$blog->is_published,
                                                                                        'badge-light-success' => $blog->is_published,
                                                                                        'badge',
                                                                                        'fs-7 fw-bold',
                                                                                    ])>
                                                                                        {{$blog->status}}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    <div>
                                                                                        {{$blog->updated_at}}
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-end">
                                                                                    <form class="d-inline" method="post"
                                                                                        action="{{ route('dashboard.blogs.publish', $blog->id) }}">
                                                                                        @csrf

                                                                                        <a onclick="event.preventDefault(); this.closest('form').submit()"
                                                                                            href="{{ route('dashboard.blogs.publish', $blog->id) }}"
                                                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                                            <i @class(["ki-duotone  fs-2", 'ki-toggle-on' => !$blog->is_published, 'ki-toggle-off' => $blog->is_published])>
                                                                                                <span class="path1"></span>
                                                                                                <span class="path2"></span>
                                                                                            </i>
                                                                                        </a>
                                                                                    </form>
                                                                                    <a href="{{ route('dashboard.blogs.edit', $blog->id) }}"
                                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                                        <i class="ki-duotone ki-pencil fs-2">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                    <a onclick="confirmDestroy('{{ route('dashboard.blogs.destroy', $blog->id) }}', this)"
                                                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                                        <i class="ki-duotone ki-trash fs-2">
                                                                                            <span class="path1"></span>
                                                                                            <span class="path2"></span>
                                                                                            <span class="path3"></span>
                                                                                            <span class="path4"></span>
                                                                                            <span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="8"> {{ $blogs->withQueryString()->links() }}</td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
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

        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        @include('shared::layouts.assets.js.delete-script')
    @endpush
@endsection