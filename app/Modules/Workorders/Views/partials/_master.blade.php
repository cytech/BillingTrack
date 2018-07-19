@extends('layouts.master')

@section('head')
    @parent
    @include('Workorders::partials._head')
@endsection

@section('javascript')

    @yield('javascript')

@endsection
