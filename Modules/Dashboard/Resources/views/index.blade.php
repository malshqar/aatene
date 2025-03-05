@extends('shared::master')
@push('sidebar-list')
    @includeWhen(Module::find('shared')->isEnabled(), 'dashboard::layouts.sidebar-list.home')
    @includeWhen(Module::find('user')->isEnabled(), 'dashboard::layouts.sidebar-list.users')
    @includeWhen(Module::find('admin')->isEnabled(), 'dashboard::layouts.sidebar-list.admins')
    @includeWhen(Module::find('accesscontrol')->isEnabled(), 'dashboard::layouts.sidebar-list.access-control')
    @includeWhen(Module::find('seller')->isEnabled(), 'dashboard::layouts.sidebar-list.sellers')
    @includeWhen(Module::find('store')->isEnabled(), 'dashboard::layouts.sidebar-list.stores')
    @includeWhen(Module::find('ads')->isEnabled(), 'dashboard::layouts.sidebar-list.ads')
    @includeWhen(Module::find('HubConnect')->isEnabled(), 'dashboard::layouts.sidebar-list.faqs')
@endpush
@section('content')
    <div class="p-20">
        <h1>Hello World</h1>

        <p>
            This view is loaded from module: {!! config('dashboard.name') !!}
        </p>
    </div>
@endsection
