@extends('layouts.master')

@section('content')

    <section class="content-header">
        <h3>@lang('fi.addons')</h3>
        <div class="clearfix"></div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>@lang('fi.name')</th>
                        <th>@lang('fi.author')</th>
                        <th>@lang('fi.web_address')</th>
                        <th>@lang('fi.status')</th>
                        <th>@lang('fi.options')</th>
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
                                    <span class="badge badge-success">@lang('fi.enabled')</span>
                                @else
                                    <span class="badge badge-danger">@lang('fi.disabled')</span>
                                @endif
                            </td>
                            <td>
                                @if ($addon->enabled)
                                    <a href="#" class="btn btn-sm btn-secondary"
                                       onclick="swalConfirm('@lang('fi.uninstall_addon_warning')', '{{ route('addons.uninstall', [$addon->id]) }}');">@lang('fi.disable')</a>
                                    @if ($addon->has_pending_migrations)
                                        <a href="{{ route('addons.upgrade', [$addon->id]) }}"
                                           class="btn btn-sm btn-info">@lang('fi.complete_upgrade')</a>
                                    @endif
                                @else
                                    <a href="{{ route('addons.install', [$addon->id]) }}"
                                       class="btn btn-sm btn-secondary">@lang('fi.install')</a>
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