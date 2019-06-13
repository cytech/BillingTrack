{{-- allow reload on back button --}}
{!! header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0") !!}
{!! header("Cache-Control: post-check=0, pre-check=0", false) !!}
{!! header("Pragma: no-cache")!!}

@extends('layouts.master')
@include('partials._js_event')

@section('content')
@include('layouts._alerts')
    <section class="content-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">
                    <div class="card-header">
                        <h6 class="card-title"><i class="fa fa-fw fa-th fa-fw"></i><a
                                    href="{{ route('scheduler.index') }}">@lang('bt.schedule')</a> @lang('bt.calendar')</h6>
                    </div>
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="calEventDialog" title="" style="display: none">
            <form id="saveCalendarEvent">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
                <input type="hidden" id="id" name="id" class="form-control">
                <input type="hidden" id="oid" name="oid" class="form-control">
                <div class="form-group d-flex align-items-center">
                    <label for="title" class="col-sm-4 text-right text">@lang('bt.title')</label>
                    <div class="col-sm-8">
                        <input type="text" id="title" name="title" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="description" class="col-sm-4 text-right text">@lang('bt.description')</label>
                    <div class="col-sm-8">
                        <input type="text" id="description" name="description" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="from" class="col-sm-4 text-right text">@lang('bt.start_datetime')</label>
                    <div class="col-sm-8">
                        <input type="text" id="from" name="start_date" class="form-control from readonly" autocomplete="off" style="cursor: pointer">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="to" class="col-sm-4 text-right text">@lang('bt.end_datetime')</label>
                    <div class="col-sm-8">
                        <input type="text" id="to" name="end_date" class="form-control to readonly" autocomplete="off" style="cursor: pointer">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="category" class="col-sm-4 text-right text">@lang('bt.category')</label>
                    <div class="col-sm-8">
                        {!! Form::select('category_id',$categories,'category', ['id' => 'category', 'class'=> 'form-control']) !!}
                    </div>
                </div>

                <div id="addReminderShow">

                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="button" id="addReminderCreate" class="btn ui-button"><i class="fa fa-plus"></i>
                            @lang('bt.add_reminder')
                        </button>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" id="" class="btn btn-secondary"><i class="fa fa-fw fa-plus"></i>
                            @lang('bt.create')
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @include('partials._createworkorder')

        <div class="addReminderView" style="display: none">
            <div class="reminder_delete_div">
                <div class="form-group d-flex align-items-center">
                    <hr class="col-sm-10 hr-clr-green"/>
                    <span class="col-sm-1 float-right reminder-cross delete_reminder" style="cursor: pointer"><i
                                class="fa fa-times-circle"></i> </span>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_date" class="col-sm-4 text-right text">@lang('bt.reminder_date')</label>
                    <div class="col-sm-8">
                        <input type="text" name="reminder_date[]" id="reminder_date" class="form-control reminder_date " style="cursor: pointer" readonly>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_location" class="col-sm-4 text-right text">@lang('bt.reminder_location')</label>
                    <div class="col-sm-8">
                        <input type="text" name="reminder_location[]" id="reminder_location" class="form-control">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_text" class="col-sm-4 text-right text">@lang('bt.reminder_text')</label>
                    <div class="col-sm-8">
                        <textarea name="reminder_text[]" id="reminder_text" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop



