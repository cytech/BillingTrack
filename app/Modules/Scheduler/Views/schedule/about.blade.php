@extends('layouts.master')

@section('content')
    {{--@if(config('app.name') == 'FusionInvoice') {!! Form::breadcrumbs() !!} @endif--}}

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {{--cut and paste doc start--}}
                <p style="margin-bottom: 0in; line-height: 100%"><font size="4" style="font-size: 16pt"><u><b>Scheduler
                                Addon for FusionInvoice v 2.1.1</b></u></font></p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%">This addon adds the
                    capability to FusionInvoice for creation of a FullCalendar Schedule.
                    If enabled, it integrates directly with the  Workorder addon for
                    FusionInvoice functionality. Events and recurring events can be
                    created and edited with categories and reminders.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Dashboard</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Shows a quick look
                    at the status of events.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Calendar</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">An event is a
                    calendar entry.<br/>
                    An event may be created by clicking in a day
                    cell. A reminder (or multiple reminders) can be created with the
                    event.</p>
                <p style="margin-bottom: 0in; line-height: 100%">An event can be
                    edited by clicking on the existing event.</p>
                <p style="margin-bottom: 0in; line-height: 100%">If the event was
                    created by the Workorder Addon, clicking on the event will take you
                    to the assigned workorder.</p>
                <p style="margin-bottom: 0in; line-height: 100%">If the event is a
                    recurring event , you will be warned about editing. Although it can
                    be edited individually here, if the recurrence is updated, this local
                    edit will be overwritten. Recurring events should be updated using
                    the RECURRING EVENT menu.</p>
                <p style="margin-bottom: 0in; line-height: 100%; background: transparent">
                    <i><b>(Create Workorder only available with the paid Workorders for
                            FusionInvoice Addon)</b></i></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Create Workorder Icon</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    When enabled in settings, This will launch a dialog to populate for
                    an automatic Workorder creation.  Customer will do a typeahead lookup
                    of the FusionInvoice client database (same rules apply as workorder
                    creation in FusionInvoice). Only Available Employees and Resources
                    (un-scheduled) for the day are shown in the item selection. THIS ONLY
                    TAKES INTO EFFECT SCHEDULED EMPLOYEES AND ITEMS FOR THE ENTIRE DAY.
                    It does not look at time slots during the day. Resources are
                    calculated against the number in inventory and the resources
                    scheduled for the day. When all selections are made, select CREATE
                    WORKORDER and the information will be send to FusionInvoice and
                    create a draft workorder containing all the information.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Create Event</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Event creation
                    outside the calendar view</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Event Table</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Shows and allows
                    editing and creating of events in a table format. You can also
                    “trash” an event here</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Recurring Event</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">Edit or Create a
                    recurring event. This can be very complex. Hover over the Set
                    Recurrence labels for explanations of how they work. “Show proposed
                    recurrence” button will attempt to give you a Human readable text
                    of your selected recurrence rule. This text does not currently
                    include additions to the Position, MonthDay, Yearday or Weeknumber
                    fields.</p>
                <p style="margin-bottom: 0in; line-height: 100%">A reminder (or
                    reminders) may be assign to recurrent events.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Utilities</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <b>Table Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    A table view based report from selected start and end dates.</p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <b>Calendar Report</b></p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    A calendar view based report from selected start and end dates.</p>
                <p style="margin-left: 0.98in; margin-bottom: 0in; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Trash</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Contains any items “trashed” from Table Event or Recurring
                    Events.</p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Event can be restored or permanently deleted.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Categories</b></p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    Assign and edit custom calendar categories and colors. Note (3)
                    default categories and custom categories assigned to events cannot be
                    deleted.</p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-left: 0.49in; margin-bottom: 0in; line-height: 100%">
                    <b>Settings</b></p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent; page-break-before: auto">
                    <b>Number of past days to load</b> – Restricts calendar loading to
                    a certain number of past days. This can substantially speed up
                    Fullcalendar load performance.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Number of events to show per day</b> – How many events to show
                    in a day cell before the “+ number more” button is shown.</p>
                <p style="margin-bottom: 0in; line-height: 100%; background: transparent">
                    <i><b>	(Create Workorder only available with the paid Workorders for
                            FusionInvoice Addon)</b></i></p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Enable “Create Workorder” functionality</b> -  If “on”,
                    displays a “Create Workorder” icon in the day cell header which
                    will launch a dialog to allow population of a FusionInvoice
                    Workorder.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>FullCalendar ThemeSystem –</b> Choose between 3 theme systems
                    for FullCalendar.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Default Timepicker step in minutes </b>– Choose 60, 30, 15, 10,
                    5 or 1. Sets default step for timepicker in Create/Edit Event and
                    Create/Edit Recurring Event.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>FullCalendar </b><b>Aspect Ratio</b><b> –</b> Sets width to
                    height ratio for FullCalendar from 1 to 2 in 0.05 increments. Higher
                    value makes a “shorter” calendar. (an aspect ratio of 2 makes the
                    calendar twice as wide as it is high.)</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Core Events to show on calendar</b> – Select to enable display
                    of system core events on Scheduler calendar. Shows a selectable link
                    to the core event. “Due date/Expires at” takes precedence over
                    event date if available.</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Display criteria:</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Quotes: Sent or approved, not invoiced</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Invoices: Sent, not paid</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Payments: All payments made</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Expenses: Not billed</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <i><b>(Projects and tasks only available with the paid FusionInvoice
                            TimeTracking Addon)</b></i></p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Projects: Active</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    Tasks: Not Billed</p>
                <p style="margin-left: 0.75in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>	About</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    This Document.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Requirements</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Currently FusionInvoice 2018-4 or higher and its requirements.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Support</b></p>
                <p style="margin-bottom: 0in; line-height: 100%"><span style="font-variant: normal"><font color="#333333"><font face="Cabin, sans-serif"><font size="2" style="font-size: 10pt"><span style="letter-spacing: normal"><span style="font-style: normal"><span style="font-weight: normal">Technical
support is provided via email: </span></span></span></font></font></font></span><span style="font-variant: normal"><font color="#333333"><font face="Cabin, sans-serif"><font size="2" style="font-size: 10pt"><span style="letter-spacing: normal"><span style="font-style: normal"><span style="font-weight: normal">support@cytech-eng.com</span></span></span></font></font></font></span></p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Release Notes</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.0</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Initial release</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.1</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2016-16</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__564_519684288"></a>
                    Cytech Scheduler Addon for FusionInvoice version 1.0.2</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2016-17</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.3</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__574_519684288"></a>
                    Changed fullcalendar css for larger border between cells</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Changed tooltip in event to position itself midway in cell</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__284_104827714"></a>
                    Cytech Scheduler Addon for FusionInvoice version 1.0.4</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__576_519684288"></a>
                    Corrected event view fail when backslash occurred in summary line</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Corrected client lookup to only include active clients</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Added additional translations</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.5</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__286_104827714"></a>
                    Corrected link to last/next event calendars in Dashboard</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%"><a name="__DdeLink__288_104827714"></a>
                    Added a Scheduler Summary Widget</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.6</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2017-2</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 1.0.7</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2017-7</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 2.0.0</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    FusionInvoice 2017-13 minimum requirement.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Overhaul all resources and optimized code. Added navbar and
                    ThemeSystem.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 2.0.1</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2018-4 minimum requirement.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Cytech Scheduler Addon for FusionInvoice version 2.1.1</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Updated for FusionInvoice 2018-7 minimum requirement.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Addition of system core event display on calendar.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><a name="__DdeLink__339_4050228220"></a>
                    <b>Installation or Update:</b></p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent; page-break-before: auto">
                    <b>Initial Installation or update from Scheduler v2.0.</b><b>1</b><b>
                        and later:</b><br/>
                    <br/>
                    1.) Unzip &quot;scheduler_v2.1.1.tar.gz&quot;
                    to temporary directory<br/>
                    2.) Upload the unzipped files and
                    directories to your FusionInvoice web folder, keeping the   directory
                    structure.<br/>
                    3.) Change permissions as necessary for your website
                    setup.<br/>
                    4.) In FusionInvoice:<br/>
                    <b>Initial Install:</b><br/>
                    Select
                    System (gear icon) Addons.<br/>
                    Select Install button next to
                    Scheduler Addon.<br/>
                    <b>To Update:</b><br/>
                    Select System (gear
                    icon) Addons.<br/>
                    Select Update button next to Scheduler
                    Addon.<br/>
                    <br/>
                    <b>Update from Scheduler v</b><b>2.0.0</b><b> or
                        earlier:</b><br/>
                    <br/>
                    1.) Delete the
                    &lt;FusionInvoice&gt;/custom/addons/Scheduler directory in your
                    FusionInvoice web server directory.<br/>
                    2.) Unzip
                    &quot;scheduler_v2.1.1.tar.gz&quot; to temporary directory<br/>
                    3.)
                    Upload the unzipped files and directories to your FusionInvoice web
                    folder, keeping the directory structure.<br/>
                    4.) Change permissions
                    as necessary for your website setup.<br/>
                    5.) In
                    FusionInvoice:<br/>
                    Select System (gear icon) Addons.<br/>
                    Select
                    Update button next to Scheduler Addon.</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    <br/>

                </p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Scheduler menu - Utilities - Settings</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Set options to your preference.</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    If running the Workorders Addon for FusionInvoice:</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Set Enable &quot;Create Workorder&quot; functionality to &quot;Yes&quot;</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">

                </p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; line-height: 100%; background: transparent">
                    <b>Optional:</b></p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    FusionInvoice System menu - Settings - Dashboard:</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Enable scheduler summary widget</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Set display order = 4, column width = 6</p>
                <p style="margin-left: 0.31in; margin-bottom: 0in; font-weight: normal; line-height: 100%; background: transparent">
                    Set invoice display order = 2, quote display order = 3</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>FAQ</b></p>
                <p style="margin-bottom: 0in; line-height: 100%">None at this time.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>License</b></p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Cytech Scheduler
                        Addon for FusionInvoice License Agreement</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    This license is a legal agreement between you and Cytech for the use
                    of Cytech Scheduler Addon for FusionInvoice  (the &quot;Software&quot;).
                    By downloading any version of Cytech Scheduler Addon for
                    FusionInvoice  you agree to be bound by the terms and conditions of
                    this license. Cytech reserves the right to alter or terminate this
                    agreement at any time, for any reason, with or without notice.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Permitted Use</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    This license permits a single installation in a production
                    environment and a single ancillary &quot;development use only&quot;
                    installation to support the live installation (such as testing
                    environments). Additional installations require additional license
                    purchases.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>License
                        Restrictions</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Unless you have been granted prior, written consent from Cytech, you
                    may not:</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    <br/>

                </p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Use the Software as the basis of a hosted service, or to provide
                    hosted services to others.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Reproduce, distribute, or transfer the Software, or portions thereof,
                    to any third party.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Sell, rent, lease, assign, or sublet the Software or portions
                    thereof.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Grant rights to any other person.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Use the Software in violation of any U.S. or international law or
                    regulation.</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Display of Copyright Notices</p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    All copyright and proprietary notices within the Software files must
                    remain intact.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Making Copies</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    You may make copies of the Software for back-up purposes, provided
                    that you reproduce the Software in its original form and with all
                    proprietary notices on the back-up copy.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Software
                        Modification</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    You may alter, modify, or extend the Software for your own use, or
                    commission a third-party to perform modifications for you, but you
                    may not resell, redistribute or transfer the modified or derivative
                    version without prior written consent from Cytech. Components from
                    the Software may not be extracted and used in other programs without
                    prior written consent from Cytech.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Refund Policy</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    Due to the non-returnable nature of downloadable software, Cytech
                    does not issue refunds once a transaction has been completed. If you
                    have questions about whether or not Cytech Scheduler Addon for
                    FusionInvoice  will work for you, please contact us with any
                    questions.
                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Indemnity</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    You agree to indemnify and hold harmless Cytech for any third-party
                    claims, actions or suits, as well as any related expenses,
                    liabilities, damages, settlements or fees arising from your use or
                    misuse of the Software, or a violation of any terms of this license.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Disclaimer Of
                        Warranty</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND,
                    EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF
                    QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS
                    FOR A PARTICULAR PURPOSE. FURTHER, Cytech DOES NOT WARRANT THAT THE
                    SOFTWARE OR ANY RELATED SERVICE WILL ALWAYS BE AVAILABLE.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><b>Limitations Of
                        Liability</b></p>
                <p style="margin-bottom: 0in; font-weight: normal; line-height: 100%">
                    YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE
                    SOFTWARE. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE
                    SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING
                    FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE. LICENSE HOLDERS ARE
                    SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND
                    ASSUME ALL RISKS ASSOCIATED WITH ITS USE, INCLUDING BUT NOT LIMITED
                    TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR
                    SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.</p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                <p style="margin-bottom: 0in; line-height: 100%"><br/>

                </p>
                {{--cut and paste doc end--}}
            </div>
        </div>
    </div>
@stop