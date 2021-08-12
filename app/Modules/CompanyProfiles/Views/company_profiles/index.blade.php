@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3 class="float-left">
            @lang('bt.company_profiles')
        </h3>

        <div class="float-right">
            <a href="{{ route('companyProfiles.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> @lang('bt.new')</a>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class=" card card-light">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>@lang('bt.company')</th>
                        <th>@lang('bt.options')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companyProfiles as $companyProfile)
                        <tr>
                            <td>{{ $companyProfile->company }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        @lang('bt.options')
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('companyProfiles.edit', [$companyProfile->id]) }}"><i
                                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                           onclick="swalConfirm('@lang('bt.delete_record_warning')', '','{{ route('companyProfiles.delete', [$companyProfile->id]) }}');"><i
                                                    class="fa fa-trash-alt"></i> @lang('bt.delete')</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="float-right">
            {!! $companyProfiles->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop
