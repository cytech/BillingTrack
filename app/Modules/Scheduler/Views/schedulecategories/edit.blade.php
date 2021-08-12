@extends('layouts.master')

@section('content')
    @include('layouts._alerts')

    <section class="content-header">
        {!! Form::model($categories, array('route' => array('scheduler.categories.update', $categories->id),
                               'id'=>'categories_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal')) !!}
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw"></i>
                    @lang('bt.edit_category')
                </h3>
                    <a class="btn btn-warning float-right" href={!! URL::previous()  !!}><i
                                class="fa fa-ban"></i> @lang('bt.cancel') </a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.update')</button>
            </div>
            <div class="card-body">

                <!-- Name input-->
                <div class="form-group">
                    {!! Form::label('name',trans('bt.category_name'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="col-md-3">
                        {!! Form::text('name',$categories->name,['id'=>'name', 'placeholder'=>'Category Name', 'class'=>'form-control', 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <!-- text_color input-->
                <div id="cp1" class="form-group colorpicker-component">
                    {!! Form::label('text_color',trans('bt.category_text_color'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="input-group col-md-3">
                        {!! Form::text('text_color',$categories->text_color,['id'=>'text_color', 'placeholder'=>'Text Color', 'class'=>'form-control', 'autocomplete' => 'off']) !!}
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-square cp1icon"
                                                              style="color:{!!  $categories->text_color !!} "></i></span>
                        </div>
                    </div>
                </div>
                <!-- text_color input-->
                <div id="cp2" class="form-group colorpicker-component">
                    {!! Form::label('bg_color',trans('bt.category_bg_color'),['class'=>'col-sm-2 col-form-label']) !!}
                    <div class="input-group col-md-3">
                        {!! Form::text('bg_color',$categories->bg_color,['id'=>'bg_color', 'placeholder'=>'Background Color', 'class'=>'form-control', 'autocomplete' => 'off']) !!}
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-square cp2icon"
                                                              style="color:{!!  $categories->bg_color !!}"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {!! Form::close() !!}

    <script>
        $('#cp1').colorpicker({format: 'hex'});
        $('#cp1').on('colorpickerChange', function (event) {
            $('.cp1icon').css('color', event.color.toString());
        });
        $('#cp2').colorpicker({format: 'hex'});
        $('#cp2').on('colorpickerChange', function (event) {
            $('.cp2icon').css('color', event.color.toString());
        });
    </script>

@stop
@section('javaScript')
    {{--<link href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    {{--<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}" type="text/javascript"></script>--}}
    {!! Html::style('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}
    {!! Html::script('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}
@stop
