@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Release Notes</h2>

        <hr>
        <h3>BillingTrack 5.0.0 (Mar 19, 2019)</h3>
        <ul>
            <li>- PHP requirement >=7.2</li>
            <li>- update to Laravel 5.8.*</li>
            <li>- update to sweetalert2 v8</li>
            <li>- fixed errors when saving online payments</li>
            <li>- fix filter in OrphanCheck</li>
            <li>- fix error in recurr Show Proposed recurrence</li>
            <li>- "fixed" top navbar</li>
            <li>- added global "back to top" of page</li>
            <li>- corrected numerous export errors</li>
            <li>- add client_id to payment importer</li>
            <li>- update resources</li>
            <li>- update to mix 4</li>
        </ul>

        <hr>
        <h3>BillingTrack 4.1.2 (Dec 17, 2018)</h3>
        <ul>
            <li>- disable scroll in datetimepicker inputs</li>
        </ul>

        <hr>
        <h3>BillingTrack 4.1.1 (Dec 16, 2018)</h3>
        <ul>
            <li>- add formatted_summary to truncate display</li>
            <li>- correct some datatables sorting</li>
            <li>- correct duplicate class btn-enter-payment</li>
            <li>- @{{ trans() }} to @@lang</li>
            <li>- save manage trash tab state</li>
            <li>- add workorder_to_invoice default date setting (job_date or current date)</li>
        </ul>

        <hr>
        <h3>BillingTrack 4.1.0 (Nov 29, 2018)</h3>
        <ul>
            <li>- upgrade to laravel 5.7.*</li>
            <li>- migrate to Bootstrap 4.1.*</li>
            <li>- start resource move to laravel mix where applicable</li>
            <li>- fix email cc and bcc</li>
            <li>- documentation</li>
            <li>- "enabled module" in sidebar (system setting)</li>
            <li>- enabled update checker</li>
            <li>- added JQuery-UI theme config</li>
            <li>- clean and optimize scheduler</li>
            <li>- enable live demo</li>
        </ul>
        <hr>
        <h3>BillingTrack 4.0.2 (Oct 14, 2018)</h3>
            <ul>
                <li>- added resource quantity selection to createworkoorder modal</li>
                <li>- corrected some error response dialogs</li>
                <li>- validation for end_time greater than start_time</li>
                <li>- calendar create workorder-redirect to workorder if no client address (new client)</li>
        </ul>
        <hr>
        <h3>BillingTrack 4.0.1 (Sept 20, 2018)</h3>
        <ul>
            <li>- added "todays workorder" widget</li>
            <li>- added "recent payments" widget</li>
            <li>- modified setup for upgrade</li>
            <li>- added resources/lang/en-cust where client = customer</li>
            <li>- added system info (.env settings) tab to system settings</li>
            <li>- added modal Enter Payment function, with client lookup and payable invoices</li>
            <li>- server side datatables for scheduler categories, events, recurring events</li>
            <li>- correct employee lookup in calendar to approved workorders</li>
            <li>- workorder datatable sort by job date instead of expires_at</li>
            <li>- added orphan check utility for Scheduler (checks workorders for Unschedulable employees)</li>
        </ul>

        <hr>
        <h3>BillingTrack 4.0.0 (Sept 6, 2018)</h3>
        <ul>
            <li>- change server to public directory (requires apache change)</li>
            <li>- configure from .env (copy .env.example to .env and change required variables)</li>
            <li>- clean, consolidate and restructure mysql database</li>
            <li>- transfer existing 2018-8 database to new structure upon setup</li>
            <li>- move high profile sortables to server side datatables</li>
            <li>- implement softdeletes, with trash management</li>
            <li>- update to laravel 5.6.*</li>
            <li>- update all resources</li>
            <li>- add toolbox</li>
            <li>- add products</li>
            <li>- add employees</li>
            <li>- item lookup modal in quotes and invoices</li>
            <li>- extend skin configuration</li>
            <li>- integrate timetracking (projects/tasks/timers)</li>
            <li>- integrate workorders</li>
            <li>- integrate Scheduler</li>
        </ul>

        <hr>

    </div>
@stop
