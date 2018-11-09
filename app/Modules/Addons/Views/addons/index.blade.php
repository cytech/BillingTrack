@extends('layouts.master')

@section('content')

    <section class="container-fluid p-3">
        <h3>{{ trans('fi.addons') }}</h3>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('fi.name') }}</th>
                        <th>{{ trans('fi.author') }}</th>
                        <th>{{ trans('fi.web_address') }}</th>
                        <th>{{ trans('fi.status') }}</th>
                        <th>{{ trans('fi.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($addons as $addon)
                        <tr>
                            <td>{{ $addon->name }}</td>
                            <td>{{ $addon->author_name }}</td>
                            <td>{{ $addon->author_url }}</td>
                            <td>
                                @if ($addon->enabled)
                                    <span class="badge badge-success">{{ trans('fi.enabled') }}</span>
                                @else
                                    <span class="badge badge-danger">{{ trans('fi.disabled') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($addon->enabled)
                                    <a href="#" class="btn btn-sm btn-secondary"
                                       onclick="swalConfirm('{{ trans('fi.uninstall_addon_warning') }}', '{{ route('addons.uninstall', [$addon->id]) }}');">{{ trans('fi.disable') }}</a>
                                    @if ($addon->has_pending_migrations)
                                        <a href="{{ route('addons.upgrade', [$addon->id]) }}"
                                           class="btn btn-sm btn-info">{{ trans('fi.complete_upgrade') }}</a>
                                    @endif
                                @else
                                    <a href="{{ route('addons.install', [$addon->id]) }}"
                                       class="btn btn-sm btn-secondary">{{ trans('fi.install') }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@stop