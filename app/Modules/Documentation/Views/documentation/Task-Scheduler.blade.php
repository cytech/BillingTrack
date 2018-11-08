@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Task Scheduler</h2>

        <hr>

        <p><a href="#what-is-task-scheduler">What is the task scheduler?</a></p>

        <p><a href="#how-to-set-up">How do I set the task scheduler up?</a></p>

        <hr>

        <span class="anchor" id="what-is-task-scheduler"></span>
        <h3>What is the task scheduler?</h3>

        <p>The task scheduler is a crucial cron job responsible for all of the automatic processes from within
            FusionInvoice.
            Some of these processes include:</p>

        <ul>
            <li>Sending overdue notices</li>
            <li>Generating recurring invoices</li>
        </ul>

        <p>These processes will not function unless the task scheduler cron job has been created.</p>

        <hr>

        <span class="anchor" id="how-to-set-up"></span>
        <h3>How do I set the task scheduler up?</h3>

        <p>The cron job for the task scheduler should be set up to run once per day. Below is an example of how to
            create the
            cron job from an SSH command line to run the task scheduler every morning at 3am (change the hour as
            needed).</p>

        <ol>
            <li>From an SSH command line, enter the following command:<br>
                <code>crontab -e</code></li>

            <li>When in the crontab editor, enter the following command and save the file:<br>
                <code>0 3 * * * curl http://YourFusionInvoiceURL/tasks/run >> /dev/null 2>&1</code>
        </ol>

        <p>
            If you do not have SSH access and you use Godaddy or a similar company, you should have some type of account
            control
            panel from which cron jobs can be created. If this is the case but you are unsure of how to navigate the
            control
            panel to create the cron job then you will need to contact your web host or system administrator for
            assistance.
        </p>

    </div>

@stop