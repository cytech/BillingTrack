{{-- allow reload on back button --}}
{!! header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0") !!}
{!! header("Cache-Control: post-check=0, pre-check=0", false) !!}
{!! header("Pragma: no-cache")!!}

@extends('layouts.master')

@section('content')
@include('layouts._alerts')
    <div class="container col-lg-12 mt-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-light">
                    <div class="card-header">
                        <h6 class="card-title"><i class="fa fa-fw fa-th fa-fw"></i><a
                                    href="{{ route('scheduler.index') }}">{{ trans('fi.schedule') }}</a> /{{ trans('fi.calendar') }}</h6>
                    </div>
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="calEventDialog" title="{{ trans('fi.create_event_calendar') }}" style="display: none">
            <form id="saveCalendarEvent">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
                <div class="form-group d-flex align-items-center">
                    <label for="title" class="col-sm-4 text-right text">{{ trans('fi.title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="title" name="title" class="form-control" value="">
                    </div>
                    <script>
                        $("#title").autocomplete({
                            appendTo: "#saveCalendarEvent",
                            source: "/scheduler/ajax/employee",
                            minLength: 2
                        }).autocomplete("widget");
                    </script>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="description"
                           class="col-sm-4 text-right text">{{ trans('fi.description') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="description" name="description" class="form-control"
                                value="">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="from"
                           class="col-sm-4 text-right text">{{ trans('fi.start_datetime') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="from" name="start_date"
                               class="form-control from readonly" style="cursor: pointer"
                               >
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="to"
                           class="col-sm-4 text-right text">{{ trans('fi.end_datetime') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="to" name="end_date" class="form-control to readonly"
                               style="cursor: pointer"
                               >
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="category"
                           class="col-sm-4 text-right text">{{ trans('fi.category') }}</label>
                    <div class="col-sm-8">
                        {!! Form::select('category_id',$categories,'category', ['id' => 'category', 'class'=> 'form-control']) !!}
                    </div>
                </div>

                <div id="addReminderShow">

                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="button" id="addReminderCreate" class="btn btn-primary"><i class="fa fa-plus"></i>
                            {{ trans('fi.add_reminder') }}
                        </button>
                    </div>
                </div>

                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" id="" class="btn btn-secondary"><i class="fa fa-fw fa-plus"></i>
                            {{ trans('fi.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @include('partials._createworkorder')

        <div id="editEvent" title="{{ trans('fi.update_event_calendar') }}" style="display: none">
            <form id="updateCalendarEvent">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
                <div class="form-group d-flex align-items-center">
                    <label for="editTitle"
                           class="col-sm-4 text-right text">{{ trans('fi.title') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="editTitle" name="title" class="form-control" >
                    </div>
                    <script>
                        $("#editTitle").autocomplete({
                            appendTo: "#updateCalendarEvent",
                            source: "/scheduler/ajax/employee",
                            minLength: 2
                        }).autocomplete("widget");
                    </script>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="editDescription"
                           class="col-sm-4 text-right text">{{ trans('fi.description') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="editDescription" name="description" class="form-control"
                               >
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="editStart"
                           class="col-sm-4 text-right text">{{ trans('fi.start_date') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="editStart" name="start_date" class="form-control from readonly"
                               style="cursor: pointer"
                               >
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="editEnd"
                           class="col-sm-4 text-right text">{{ trans('fi.end_date') }}</label>
                    <div class="col-sm-8">
                        <input type="text" id="editEnd" name="end_date" class="form-control to readonly"
                               style="cursor: pointer"
                               >
                        <input type="hidden" id="editID" name="id" class="form-control">
                        <input type="hidden" id="editOID" name="oid" class="form-control">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="editCategory"
                           class="col-sm-4 text-right text">{{ trans('fi.category') }}</label>
                    <div class="col-sm-8">
                        {!! Form::select('category_id',$categories,'category', ['id' => 'editCategory', 'class'=> 'form-control']) !!}
                    </div>
                </div>
                <div id="reminderShowFormCalendar">

                </div>
                <div id="updateReminderShow">

                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="button" id="updateReminderCreate" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>
                            {{ trans('fi.add_reminder') }}
                        </button>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" id="updateEvent" class="btn btn-secondary"><i class="fa fa-fw fa-edit"></i>
                            {{ trans('fi.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="addReminderView" style="display: none">
            <div class="reminder_delete_div">
                <div class="form-group d-flex align-items-center">
                    <hr class="col-sm-10 hr-clr-green"/>
                    <span class="col-sm-1 float-right reminder-cross delete_reminder" style="cursor: pointer"><i
                                class="fa fa-times-circle"></i> </span>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_date" class="col-sm-4 text-right text">{{ trans('fi.reminder_date') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="reminder_date[]" class="form-control reminder_date "
                               style="cursor: pointer" readonly>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_location" class="col-sm-4 text-right text">{{ trans('fi.reminder_location') }}</label>
                    <div class="col-sm-8">
                        <input type="text" name="reminder_location[]" class="form-control">
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="reminder_text" class="col-sm-4 text-right text">{{ trans('fi.reminder_text') }}</label>
                    <div class="col-sm-8">
                        <textarea name="reminder_text[]" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials._js_event')

@stop



