@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Workorders</h2>

        <hr>

        <p><a href="#create-workorder">How do I create a workorder?</a></p>
        <p><a href="#email-workorder">How do I email a workorder?</a></p>
        <p><a href="#convert-to-invoice">How do I convert a workorder to an invoice?</a></p>
        <p><a href="#copy-workorder">How do I copy a workorder?</a></p>
        <p><a href="#attach-files-workorder">How do I attach files to a workorder?</a></p>

        <hr>

        <span class="anchor" id="create-workorder"></span>
        <h3>How do I create a workorder?</h3>

        <p>Click the Workorders menu item and press the New button.</p>
        {{--<a href="/img/documentation/workorder_create.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_create_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <p>The Create Workorder screen will prompt you for the client name, workorder date, company profile and group.</p>
        <p>If the workorder is for a new client, type the client's name in full. You will be able to edit the other details
            for this client record from the next screen. If the workorder is for an existing client, start typing the
            client's
            name and you will be able to select your existing client from the list that appears.</p>
        <p>The date defaults to today's date but can be changed if necessary.</p>
        <p>The company profile is where the workorder will pull your company name, address, phone number, and other company
            specific details from.</p>
        <p>The group controls the format of the number assigned to each workorder.</p>
        <p>Press Submit when done and you'll be taken to the Workorder Edit screen.</p>

        {{--<a href="/img/documentation/workorder_create2.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_create2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <p>The Workorder Edit screen is where you'll add line items as well as define further properties and options
            for your workorder.</p>
        <p><strong>1. Summary</strong></p>
        <p>Entering a brief summary or description of the workorder will make the workorder easier to find and search for.</p>

        <p><strong>2. From/To</strong></p>
        <p>The from and to areas display who the workorder is issued from and who the workorder is being sent to. If you
            created the workorder with the wrong company profile selected by mistake, you can easily change that by pressing
            the Change button on the From area and choose the correct company profile. Similarly, if you created the
            workorder
            with the wrong client selected, you can easily correct that by pressing the Change button on the To area and
            choose
            the correct client.</p>

        <p><strong>3. Items</strong></p>
        <p>This is where you'll enter each of your line items. Press the Add Item button to add additional lines for
            your items.</p>

        <p><strong>4. Additional, Notes and Attachments</strong></p>
        <p>Terms and conditions as well as text to appear in the footer of your workorder may be entered on the Additional
            tab. Defaults
            for these fields may be set in System Settings on the Workorders tab (default values for these fields will not
            appear on workorders
            already created).</p>
        <p>Public or private notes may be entered on the Notes tab. Notes entered on this tab will be visible to clients
            viewing
            the workorder using the public link unless they are marked as private. Clients may leave notes on a workorder when
            viewing
            the workorder using the public link as well.</p>
        <p>File attachments may be uploaded to a workorder on the Attachments tab. See <a href="#attach-files-workorder">How do
                I attach files
                to a workorder?</a> for details.
        <p><strong>5. Options</strong></p>
        <p>A number of other options and values are defined in the options area.</p>
        <ul>
            <li>Job Date - The calendar date for the actual workorder job</li>
            <li>Start Time - Job start time</li>
            <li>End Time - Job end time</li>
            <li>Will Call - Arbitrary tag that can be used for client pickup, etc.</li>
            <li>Workorder # - This is generated according to the group selected when the workorder was created.</li>
            <li>Date - The date the workorder was issued.</li>
            <li>Expires - The date the price reflected on the workorder expires.</li>
            <li>Discount - A percentage based discount can be applied to the workorder.</li>
            <li>Currency - The currency the workorder will be issued in. The default currency can be changed on both the
                client
                record and in System Settings. If the client record has a different currency than System Settings, the
                currency on the client
                record will override System Settings.
            </li>
            <li>Exchange Rate - If a currency other than your base currency is selected, the exchange rate will
                automatically update
                itself based on the current rate.
            </li>
            <li>Status - The current status of the workorder. Once a workorder has been emailed, the status will automatically
                update itself to Sent. If
                a client has accepted or rejected a workorder from the public workorder link, it will update itself to the
                appropriate status.
            </li>
            <li>Template - This is the template the workorder will use when viewed using the public link or when generating
                the workorder PDF. The
                default template can be changed on both the client record and in System Settings. If the client record
                has a different default template
                than System Settings, the client record will override System Settings. This behavior allows you use a
                specific template as default
                for most of your workorders while specifying a different template for a particular client or clients.
            </li>
        </ul>

        {{--<a href="/img/documentation/workorder_edit.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_edit_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <hr>

        <span class="anchor" id="email-workorder"></span>
        <h3>How do I email a workorder?</h3>

        <p>Press the Email button from the Workorder Edit screen.</p>
        <p style="font-style: italic;">* Note that the Email button will not appear unless you have configured your
            email settings in System
            Settings on the Email tab.</p>

        {{--<a href="/img/documentation/workorder_email.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_email_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <p>The Email Workorder screen allows you to add additional recipients, change the subject and / or body, if
            necessary.</p>
        <p>Press the Send button to send the email.</p>

        {{--<a href="/img/documentation/workorder_email2.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_email2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <hr>

        <span class="anchor" id="convert-to-invoice"></span>
        <h3>How do I convert a workorder to an invoice?</h3>

        <p>Once a client has accepted your workorder, you can convert it to an invoice on the Workorder Edit screen by clicking
            the Options button and choosing Workorder to Invoice.</p>

        {{--<a href="/img/documentation/workorder_to_invoice.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_to_invoice_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <p>Review the date and group, adjust if necessary and press the Submit button. Once submitted, you will
            be taken to the Invoice Edit screen for the new invoice.</p>

        {{--<a href="/img/documentation/workorder_to_invoice2.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_to_invoice2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <hr>

        <span class="anchor" id="copy-workorder"></span>
        <h3>How do I copy a workorder?</h3>

        <p>Press the Other button and choose Copy from the Workorder Edit screen.</p>

        {{--<a href="/img/documentation/workorder_copy.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_copy_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <p>Change the client's name if the copy will be for a different client.</p>
        <p>Review the date, company profile, and group. Change if necessary.</p>
        <p>Press the Submit button to complete the copy.</p>

        {{--<a href="/img/documentation/workorder_copy2.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_copy2_small.png" class="img-responsive">--}}
        {{--</a>--}}

        <hr>

        <span class="anchor" id="attach-files-workorder"></span>
        <h3>How do I attach files to a workorder?</h3>

        <p>Files of any type may be uploaded as an attachment to a workorder by clicking the Attachments tab on
            the Workorder Edit screen and pressing the Attach File button.</p>
        <p>The Client Visibility option may be adjusted for each file attachment to determine whether or not the
            client should be able to access and download the attachment when viewing the workorder public link. The
            following Client Visibility options are available for workorder attachments:</p>
        <ul>
            <li>Visible - Clients will be able to access this attachment from the workorder public link.</li>
            <li>Not Visible - Clients will not be able to access this attachment from the workorder public link.</li>
        </ul>

        <p style="font-style: italic;">* Note that attachments uploaded to a workorder do not "attach" themselves to the
            workorder
            PDF output. Workorder attachments are intended to provide an easy way to deliver digital assets related to a
            workorder
            to your clients (or just to store related files for your own purposes).</p>

        {{--<a href="/img/documentation/workorder_attachments.png" target="_blank">--}}
            {{--<img src="/img/documentation/workorder_attachments_small.png" class="img-responsive">--}}
        {{--</a>--}}

    </div>

@stop