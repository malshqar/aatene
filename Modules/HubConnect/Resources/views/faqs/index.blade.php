@extends('dashboard::index', ['title' => __(" الأسئلة الشائعة")])

@section('content')
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('shared::layouts.components.elements.toolbar', ['back_url' => 'dashboard.index', 'previews' => 'الرئيسية', 'current' => __(" الأسئلة الشائعة")])
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Tables Widget 11-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            @include("hubconnect::faqs._filters")
                            <div class="card-toolbar">
                                @can('user.create')
                                    <a href="{{ route('dashboard.faqs.create') }}"
                                        class="btn btn-sm btn-light-primary fs-3">
                                        <i class="ki-duotone ki-plus "></i> {{__("إضافة سؤال")}} </a>
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
                                            <th class="min-w-225px"> {{__("السؤال")}} </th>
                                            <th class="min-w-225px"> {{__("الإجابة")}} </th>
                                            <th class="min-w-225px"> {{__("القسم")}} </th>
                                            <th class="min-w-50px">تاريخ </th>
                                            @canany(['user.edit', 'user.ban', 'user.delete'])
                                                <th class="min-w-100px text-end rounded-end px-5">{{__("العمليات")}}</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                            <tr>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary mb-1 me-5 ps-4 fs-6">
                                                        {{ $loop->iteration }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $faq->question }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $faq->answer }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $faq->category?->name }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-5 fw-bold">{{ \Carbon\Carbon::parse( $faq->created_at)->format('Y\/m\/d') }}</span>
                                                </td>
                                              
                                                @canany(['user.edit', 'user.ban', 'user.delete'])

                                                    <td class="text-end">


                                                        @can('user.edit')
                                                            <a href="{{ route('dashboard.faqs.edit', $faq->id) }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <i class="ki-duotone ki-pencil fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </a>
                                                        @endcan 

                                                        @can('user.delete')
                                                            <a onclick="confirmDestroy('{{ route('dashboard.faqs.destroy', $faq->id) }}', this)"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                <i class="ki-duotone ki-trash fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                </i>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8"> {{ $faqs->WithQueryString()->links() }}</td>
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