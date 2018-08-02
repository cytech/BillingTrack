@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}
    @include('layouts._alerts')
    <div class="container col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <a href="{!! route('scheduler.categories.create') !!}" class="btn btn-success"><i
                            class="fa fa-fw fa-plus"></i> {{ trans('fi.create_category') }}</a>
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i
                                    class="fa fa-fw fa-table fa-fw"></i>{{ trans('fi.categories') }}
                        </h3>
                    </div>
                    {{--@include('layouts._alerts')--}}
                    <div class="panel-body">
                        <table id="dt-categoriestable" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('fi.category_name') }}</th>
                                <th>{{ trans('fi.category_text_color') }}</th>
                                <th>{{ trans('fi.category_bg_color') }}</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr id="{!! $category->id !!}">
                                    <td>{!! $category->id !!}</td>
                                    <td>{!! $category->name !!}</td>
                                    <td>{!! $category->text_color !!}&nbsp;&nbsp;&nbsp;<i class="fa fa-square"
                                                                                          style="color:{!! $category->text_color !!}"></i>
                                    </td>
                                    <td>{!! $category->bg_color !!}&nbsp;&nbsp;&nbsp;<i class="fa fa-square"
                                                                                        style="color:{!! $category->bg_color !!}"></i>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary iframe"
                                           href="{{ route('scheduler.categories.edit', [$category->id]) }}"><i
                                                    class="fa fa-fw fa-edit"></i>{{ trans('fi.edit') }}</a>
                                        @if($category->id > 10)
                                            {{--{!! Form::button('<i class="fa fa-fw fa-trash"></i>'.trans('fi.delete'), ['type' => 'button','class' => 'btn btn-danger delete-button',--}}
                                            {{--'onclick' => "swalConfirm(trans('fi.trash_record_warning'), route('scheduler.categories.delete', [$category->id]) )",'data-id'=> $category->id]) !!}--}}

                                            <button type="button" class="btn btn-danger delete-button"
                                                    onclick="deleteConfirm('{{ trans('fi.delete_record_warning') }}', '{{ route('scheduler.categories.delete', [$category->id]) }}')"
                                                    ><i class="fa fa-fw fa-trash"></i>{{ trans('fi.delete') }}</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
@stop
@section('javascript')

@stop
