@extends('shared::master')
@push('sidebar-list')
@include('dashboard::layouts.sidebar-list.home')
@include('dashboard::layouts.sidebar-list.users')
@endpush
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('dashboard.name') !!}
    </p>
@endsection