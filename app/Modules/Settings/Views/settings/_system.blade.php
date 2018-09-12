<div class="row">
    <div class="form-group col-md-4">
        <label>Application URL: </label>
        {!! Form::text('app_url',config('app.url'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label>Debug Enabled? </label>
        {!! Form::select('debug', ['0' => 'No', '1' => 'Yes'], config('app.debug'), ['class' => 'form-control', 'disabled']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label>Database Driver: </label>
        {!! Form::text('db_driver',config('database.connections.mysql.driver'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label>Database Host: </label>
        {!! Form::text('db_host',env('DB_HOST', 'empty'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label>Database: </label>
        {!! Form::text('db_database',env('DB_DATABASE','empty'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label>Database UserName: </label>
        {!! Form::text('db_username',env('DB_USERNAME', 'empty'), ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
{{--<div class="form-group">--}}
{{--<label>Database Password: </label>--}}
{{--{!! Form::password('db_password',['class' => 'form-control', 'readonly']) !!}--}}
{{--</div>--}}

