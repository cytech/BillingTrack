<div class="card card-light">
    <div class="card-body">

        <span class="float-left"><strong>{{ trans('fi.unbilled_hours') }}</strong></span>
        <span class="float-right">{{ $project->unbilled_hours }}</span>
        <div class="clearfix"></div>

        <span class="float-left"><strong>{{ trans('fi.billed_hours') }}</strong></span>
        <span class="float-right">{{ $project->billed_hours }}</span>
        <div class="clearfix"></div>

        <span class="float-left"><strong>{{ trans('fi.total_hours') }}</strong></span>
        <span class="float-right">{{ $project->hours }}</span>
        <div class="clearfix"></div>

    </div>
</div>