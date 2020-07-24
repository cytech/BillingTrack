@extends('client_center.layouts.master')

@section('sidebar')

    <aside class="main-sidebar sidebar-light-light elevation-2">
        <a href="/" class="brand-link border-bottom">
            <img src="/img/billingtrack_logo.svg" alt="BillingTrack Logo" class="brand-image img-circle elevation-3 img-sm"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('bt.headerTitleText', config('app.name','BillingTrack')) }}</span>
        </a>

        <div class="sidebar bg-light">

            @if (config('bt.displayProfileImage'))
                <div class="user-panel">
                    <div class="float-left image">
                        <img src="{{ profileImageUrl(auth()->user()) }}" alt="User Image"/>
                    </div>
                    <div class="float-left info">
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                </div>
            @endif


            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientCenter.dashboard') }}">
                            <i class="fa fa-tachometer-alt"></i>
                            <p>@lang('bt.dashboard')</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientCenter.quotes') }}">
                            <i class="far fa-file-alt"></i> <span>@lang('bt.quotes')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientCenter.workorders') }}">
                            <i class="far fa-file-alt"></i> <span>@lang('bt.workorders')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientCenter.invoices') }}">
                            <i class="far fa-file-alt"></i> <span>@lang('bt.invoices')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientCenter.payments') }}">
                            <i class="fa fa-credit-card"></i> <span>@lang('bt.payments')</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
@stop

@section('header')
    <div class="navbar-nav ml-auto">

        <li class="nav-item"><a class="nav-link" href="{{ route('session.logout') }}"><i
                        class="fa fa-power-off"></i></a></li>

    </div>
@stop
