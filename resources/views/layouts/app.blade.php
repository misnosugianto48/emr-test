@extends('adminlte::page')

@section('title', 'EMR Hospital')

@section('content_header')
    <h1>@yield('page-title')</h1>
@stop

@section('content')

    @include('components.alert')

    @yield('content-body')

@stop
