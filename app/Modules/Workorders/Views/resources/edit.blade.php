@extends('Workorders::partials._master')
@section('content')
    <!--basic form starts-->
    {!! Form::wobreadcrumbs() !!}
    {{--@include('Workorders::partials._alerts')--}}
    <div class="col-lg-12">
        <div class="panel panel-info" id="hidepanel1">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ trans('Workorders::texts.edit_resource') }}
                </h3>

            </div>
            <div class="panel-body">
            {!! Form::model($resources, array('route' => array('resources.update', $resources->id),
                                                        'id'=>'resources_form','action'=>'#','method' => 'PUT', 'class'=>'form-horizontal')) !!}
            <!-- Name input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="name">{{ trans('Workorders::texts.resource_name') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('name',$resources->name,['id'=>'name', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Description input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="description">{{ trans('Workorders::texts.resource_description') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('description',$resources->description,['id'=>'description', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Serial Number input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="serialnum">{{ trans('Workorders::texts.resource_serialnum') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('serialnum',$resources->serialnum,['id'=>'serialnum', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Active Checkbox-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="active">{{ trans('Workorders::texts.resource_active') }}</label>
                    <div class="col-md-9">
                        {!! Form::checkbox('active',1,$resources->active,['id'=>'active', 'class'=>'checkbox']) !!}
                    </div>
                </div>
                <!-- Cost input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="cost">{{ trans('Workorders::texts.resource_cost') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('cost',$resources->cost,['id'=>'cost', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Category input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="category">{{ trans('Workorders::texts.resource_category') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('category',$resources->category,['id'=>'category', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Type input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="type">{{ trans('Workorders::texts.resource_type') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('type',$resources->type,['id'=>'type', 'class'=>'form-control']) !!}
                    </div>
                </div>
                <!-- Numstock input-->
                <div class="form-group">
                    <label class="col-md-3 control-label"
                           for="numstock">{{ trans('Workorders::texts.resource_numstock') }}</label>
                    <div class="col-md-9">
                        {!! Form::text('numstock',$resources->numstock,['id'=>'numstock', 'class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center" class="buttons">
            <a class="btn btn-warning btn-lg" href={!! route('resources.index')  !!}>{{ trans('fi.cancel') }} <span
                        class="glyphicon glyphicon-remove-circle"></span></a>
            <button type="submit" class="btn btn-success btn-lg">{{ trans('fi.save') }} <span
                        class="glyphicon glyphicon-floppy-disk"></span></button>
            {{--{!! Button::normal(trans('texts.cancel'))
                    ->large()
                    ->asLinkTo(URL::previous())
                    ->appendIcon(Icon::create('remove-circle')) !!}

            {!! Button::success('Save')
                    ->submit()
                    ->large()
                    ->appendIcon(Icon::create('floppy-disk')) !!}--}}
        </div>
        {!! Form::close() !!}
    </div>
@stop