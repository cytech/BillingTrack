@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($paymentMethod, ['route' => ['paymentMethods.update', $paymentMethod->id]]) !!}
    @else
        {!! Form::open(['route' => 'paymentMethods.store']) !!}
    @endif

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.payment_method_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('paymentMethods.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <div class="control-group">
                    <label>@lang('bt.payment_method'): </label>
                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
