@extends('Workorders::partials._master')

@section('content')
	{!! Form::wobreadcrumbs() !!}
	<div class="col-lg-3">
		<a href="{{ route('employees.create') }}" class="btn btn-primary create-resource"><i
					class="fa fa-plus"></i> {{ trans('Workorders::texts.create_employee') }}</a>
	</div>
	{{--@include('Workorders::partials._alerts')--}}
	<div class="col-lg-12">
		<div class="panel panel-info" id="hidepanel1">
			<div class="panel-heading">
				<h3 class="panel-title">
					Employee Table
				</h3>
			</div>
			<div class="panel-body">
				@include('Workorders::employees._table')
			</div>
		</div>
	</div>
@stop