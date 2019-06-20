@extends('layouts.master')

@section('content')

    <script type="text/javascript">
        $(function () {
            $('#name').focus();

            @if ($editMode == true)
            $('#btn-delete-logo').click(function () {
                $.post("{{ route('companyProfiles.deleteLogo', [$companyProfile->id]) }}").done(function () {
                    $('#div-logo').html('');
                });
            });
            @endif
        });
    </script>

    @if ($editMode == true)
        {!! Form::model($companyProfile, ['route' => ['companyProfiles.update', $companyProfile->id], 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'companyProfiles.store', 'files' => true]) !!}
    @endif

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.company_profile_form')
        </h3>
        <a class="btn btn-warning float-right" href={!! route('companyProfiles.index')  !!}><i
                    class="fa fa-ban"></i> @lang('bt.cancel')</a>
        <button type="submit" class="btn btn-primary float-right"><i
                    class="fa fa-save"></i> @lang('bt.save') </button>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">

        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                @include('company_profiles._form')
            </div>
        </div>
    </section>

    {!! Form::close() !!}
@stop
