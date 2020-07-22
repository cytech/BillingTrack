@extends('layouts.master')

@section('content')
    <!--basic form starts-->
    {{--{!! Form::wobreadcrumbs() !!}--}}
    @include('layouts._alerts')
    <section class="content-header">
        {!! Form::model($categories, array('route' => array('categories.update', $categories->id),
                                                       'id'=>'categories_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal')) !!}

        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title"><i
                            class="fa fa-edit fa-fw float-left"></i>
                    @lang('bt.edit_category')
                </h3>
                    <a class="btn btn-warning float-right" href={!! route('categories.index')  !!}><i
                                class="fa fa-ban"></i> @lang('bt.cancel')</a>
                    <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save"></i> @lang('bt.save') </button>
            </div>
            <div class="card-body">

                <!-- Name input-->
                <div class="form-group d-flex align-items-center">
                    <label class="col-sm-2 text-right text"
                           for="name">@lang('bt.category_name')</label>
                    <div class="col-md-4">
                        {!! Form::text('name',$categories->name,['id'=>'name', 'class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@stop
