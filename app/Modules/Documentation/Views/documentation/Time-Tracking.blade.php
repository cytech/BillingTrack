@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Time Tracking</h2>

        <p>The Time Tracking add-on for BillingTrack lets you easily build projects, add tasks, track your time and
            most importantly - bill
            for that time!</p>

        <hr>

        <h3>Installing the Time Tracking Add-on</h3>

        <p>See the <a href="Installation#how-to-install-an-add-on">add-on installation documentation</a>.
        </p>

        <hr>

        <h3>Creating a Project</h3>

        <p>Time tracking starts with creating a project, so let's do that now. Click the Time Tracking link from the
            left-hand navigation menu.</p>
        <a href="/img/documentation/time_tracking1.png" target="_blank">
            <img src="/img/documentation/time_tracking1_small.png" class="img-responsive">
        </a>

        <p>Press the Create Project button.</p>
        <a href="/img/documentation/time_tracking_create_project1.png" target="_blank">
            <img src="/img/documentation/time_tracking_create_project1_small.png" class="img-responsive">
        </a>

        <p>Provide a name for the project, start typing the client name and select the name from the dropdown, and set
            the hourly rate
            for the project. Press the Save button when done.</p>
        <a href="/img/documentation/time_tracking_create_project2.png" target="_blank">
            <img src="/img/documentation/time_tracking_create_project2_small.png" class="img-responsive">
        </a>

        <hr>
        <h3>Adding Tasks</h3>

        <p>Now that we have a project created, let's start adding tasks. Press the Add Task button.</p>
        <a href="/img/documentation/time_tracking_add_task1.png" target="_blank">
            <img src="/img/documentation/time_tracking_add_task1_small.png" class="img-responsive">
        </a>

        <p>Provide the task name and press the Submit and Add Another Task button to continue adding tasks or press the
            Submit
            and Close button once you're finished adding tasks.</p>
        <a href="/img/documentation/time_tracking_add_task2.png" target="_blank">
            <img src="/img/documentation/time_tracking_add_task2_small.png" class="img-responsive">
        </a>

        <hr>
        <h3>Managing Timers</h3>

        <p>Now that we have some tasks added, we can start timers on one or more tasks by pressing the green Start Timer
            button for the appropriate task(s).</p>

        <p>* Note: Running tasks will continue to run even if you log out of BillingTrack or close your browser.</p>
        <a href="/img/documentation/time_tracking_add_task3.png" target="_blank">
            <img src="/img/documentation/time_tracking_add_task3_small.png" class="img-responsive">
        </a>

        <p>Timers can be manually added or deleted to a task by clicking the Show Timers icon.</p>
        <a href="/img/documentation/time_tracking_task_timers1.png" target="_blank">
            <img src="/img/documentation/time_tracking_task_timers1_small.png" class="img-responsive">
        </a>

        <p>Any timers currently associated with the task will be listed here.</p>
        <a href="/img/documentation/time_tracking_task_timers2.png" target="_blank">
            <img src="/img/documentation/time_tracking_task_timers2_small.png" class="img-responsive">
        </a>

        <p>To manually add a timer, click the calendar icon, choose the start date and end date along with the start
            time
            and end time and press the Apply button.</p>
        <a href="/img/documentation/time_tracking_task_timers3.png" target="_blank">
            <img src="/img/documentation/time_tracking_task_timers3_small.png" class="img-responsive">
        </a>

        <hr>
        <h3>Billing Tasks</h3>

        <p>When you're ready to bill for the time tracked on a task, press the Bill Task icon. Alternatively, multiple
            tasks may be billed at once by selecting each of the tasks to be billed and pressing the Bulk Actions button
            and selecting Bill Tasks.</p>
        <a href="/img/documentation/time_tracking_bill_task1.png" target="_blank">
            <img src="/img/documentation/time_tracking_bill_task1_small.png" class="img-responsive">
        </a>

        <p>Tasks can be billed to a new invoice or to an existing invoice. Selecting the appropriate options and
            pressing
            the Submit button will add the tasks as line items to an invoice.</p>
        <a href="/img/documentation/time_tracking_bill_task2.png" target="_blank">
            <img src="/img/documentation/time_tracking_bill_task2_small.png" class="img-responsive">
        </a>

        <p>Once tasks have been billed, they will appear under the Billed Tasks area.</p>
        <a href="/img/documentation/time_tracking_bill_task3.png" target="_blank">
            <img src="/img/documentation/time_tracking_bill_task3_small.png" class="img-responsive">
        </a>

    </div>

@stop
