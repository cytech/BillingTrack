<div class="row col-md-6">

    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('bt.display_profile_image'): </label>
            {!! Form::select('setting[displayProfileImage]', $yesNoArray, config('bt.displayProfileImage'), ['class' => 'form-control']) !!}
        </div>
    </div>

</div>

@foreach ($dashboardWidgets as $widget)

    <h4 style="font-weight: bold; clear: both;">{{ $widget }}</h4>

    <div class="row col-md-6">
        <div class="col-md-4">
            <div class="form-group">
                <label>@lang('bt.enabled'): </label>
                {!! Form::select('setting[widgetEnabled' . $widget . ']', $yesNoArray, config('bt.widgetEnabled' .
                $widget), ['id' => 'widgetEnabled' . $widget, 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>@lang('bt.display_order'): </label>
                {!! Form::select('setting[widgetDisplayOrder' . $widget . ']', $displayOrderArray,
                config('bt.widgetDisplayOrder' . $widget),
                ['id' => 'widgetDisplayOrder' . $widget, 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>@lang('bt.column_width'): </label>
                {!! Form::select('setting[widgetColumnWidth' . $widget . ']', $colWidthArray,
                config('bt.widgetColumnWidth' . $widget), ['id' => 'widgetColumnWidth' . $widget, 'class' =>
                'form-control']) !!}
            </div>
        </div>
    </div>

    @if (view()->exists($widget . 'WidgetSettings'))
        <div class="col-md-6">
        @include($widget . 'WidgetSettings')
        </div>
    @endif

@endforeach
<div class="row"></div>
