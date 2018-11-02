@extends('layouts.master')

@section('content')

    <section class="content m-3">
        <h3 class="float-left">
            {{ trans('fi.groups') }}
        </h3>
        <div class="float-right">
            <a href="{{ route('groups.create') }}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{ trans('fi.new') }}</a>
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
                        <th>{!! Sortable::link('name', trans('fi.name')) !!}</th>
                        <th>{!! Sortable::link('format', trans('fi.format')) !!}</th>
                        <th>{!! Sortable::link('next_id', trans('fi.next_number')) !!}</th>
                        <th>{!! Sortable::link('left_pad', trans('fi.left_pad')) !!}</th>
                        <th>{!! Sortable::link('reset_number', trans('fi.reset_number')) !!}</th>
                        <th>{{ trans('fi.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->format }}</td>
                            <td>{{ $group->next_id }}</td>
                            <td>{{ $group->left_pad }}</td>
                            <td>{{ $resetNumberOptions[$group->reset_number] }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                        {{ trans('fi.options') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('groups.edit', [$group->id]) }}"><i
                                                        class="fa fa-edit"></i> {{ trans('fi.edit') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"
                                               onclick="swalConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('groups.delete', [$group->id]) }}');"><i
                                                        class="fa fa-trash-alt"></i> {{ trans('fi.delete') }}</a>
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
            {!! $groups->appends(request()->except('page'))->render() !!}
        </div>
    </section>

@stop