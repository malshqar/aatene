@extends('shared::master', ['title', 'الرئيسية'])
@push('sidebar-list')
    @includeWhen(Module::find('shared')->isEnabled(), 'dashboard::layouts.sidebar-list.home')
    @includeWhen(Module::find('user')->isEnabled(), 'dashboard::layouts.sidebar-list.users')
    @includeWhen(Module::find('admin')->isEnabled(), 'dashboard::layouts.sidebar-list.admins')
    @includeWhen(Module::find('accesscontrol')->isEnabled(), 'dashboard::layouts.sidebar-list.access-control')
@endpush
@section('content')
    <div class="p-20">
        <h1>Hello World</h1>

        <p>
            This view is loaded from module: {!! config('dashboard.name') !!}
        </p>
    </div>
@endsection
