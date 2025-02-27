<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <base href="" />
    <title>{{ config('app.name') }} {{ isset($title) ? ' | ' . $title : '' }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('shared::layouts.assets.img.icon')
    <!--begin::Fonts(mandatory for all pages)-->
    @include('shared::layouts.assets.css.styles')
    @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default"
    data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on">

    <!--begin::Page loading(append to body)-->
    <div class="page-loader">
        <span class="spinner-border text-primary" role="status">
            <span class="visually-hidden">تحميل...</span>
        </span>
    </div>
    <!--end::Page loading-->

    <!--begin::Theme mode setup on page load-->
    @include('shared::layouts.assets.js.theme-mode-steup')
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('shared::layouts.header.header')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                @include('shared::layouts.sidebar.sidebar')
                @yield('content')
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    @include('shared::layouts.components.scrolltop')
    @include('shared::layouts.assets.js.scripts')
    @stack('scripts')
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>