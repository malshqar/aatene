@extends('shared::master', ['title', 'الرئيسية'])
@push('sidebar-list')
    @include('dashboard::layouts.sidebar-list.home')
    @include('dashboard::layouts.sidebar-list.users')
    @include('dashboard::layouts.sidebar-list.admins')
    @include('dashboard::layouts.sidebar-list.access-control')
@endpush
@section('content')
    <div class="p-20">
        <h1>Hello World</h1>

        <p>
            This view is loaded from module: {!! config('dashboard.name') !!}
        </p>
    </div>
@endsection