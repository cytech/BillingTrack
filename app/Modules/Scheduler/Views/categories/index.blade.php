@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ trans('fi.categories') }}</h1>
        <div class="pull-right">
            <a href="{!! route('scheduler.categories.create') !!}" class="btn btn-primary"><i
                        class="fa fa-fw fa-plus"></i> {{ trans('fi.create_category') }}</a>
        </div>

        <div class="clearfix"></div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="row">

            <div class="col-xs-12">

                <div class="box box-primary">

                    <div class="box-body no-padding">
                        @include('categories._dataTable')
                    </div>

                </div>

            </div>
        </div>
    </section>
@stop
