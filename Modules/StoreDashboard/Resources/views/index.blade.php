@extends('shared::master')
@push('sidebar-list')
@include('storedashboard::layouts.sidebar-list.home')
@endpush
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('storedashboard.name') !!}
    </p>
@endsection