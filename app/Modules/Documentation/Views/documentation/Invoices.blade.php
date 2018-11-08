@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Invoices</h2>

        <hr>

        <p><a href="#create-invoice">How do I create an invoice?</a></p>
        <p><a href="#email-invoice">How do I email an invoice?</a></p>
        <p><a href="#enter-payment">How do I enter a payment?</a></p>
        <p><a href="#copy-invoice">How do I copy an invoice?</a></p>
        <p><a href="#attach-files-invoice">How do I attach files to an invoice?</a></p>

        <hr>

        <span class="anchor" id="create-invoice"></span>
        <h3>How do I create an invoice?</h3>

        <p>Click the Invoices menu item and press the New button.</p>
        <a href="/img/documentation/invoice_create.png" target="_blank">
            <img src="/img/documentation/invoice_create_small.png" class="img-responsive">
        </a>

        <p>The Create Invoice screen will prompt you for the client name, invoice date, company profile and group.</p>
        <p>If the invoice is for a new client, type the client's name in full. You will be able to edit the other
            details
            for this client record from the next screen. If the invoice is for an existing client, start typing the
            client's
            name and you will be able to select your existing client from the list that appears.</p>
        <p>The date defaults to today's date but can be changed if necessary.</p>
        <p>The company profile is where the invoice will pull your company name, address, phone number, and other
            company
            specific details from.</p>
        <p>The group controls the format of the number assigned to each invoice.</p>
        <p>Press Submit when done and you'll be taken to the Invoice Edit screen.</p>

        <a href="/img/documentation/invoice_create2.png" target="_blank">
            <img src="/img/documentation/invoice_create2_small.png" class="img-responsive">
        </a>

        <p>The Invoice Edit screen is where you'll add line items as well as define further properties and options
            for your invoice.</p>
        <p><strong>1. Summary</strong></p>
        <p>Entering a brief summary or description of the invoice will make the invoice easier to find and search
            for.</p>

        <p><strong>2. From/To</strong></p>
        <p>The from and to areas display who the invoice is issued from and who the invoice is being sent to. If you
            created the invoice with the wrong company profile selected by mistake, you can easily change that by
            pressing
            the Change button on the From area and choose the correct company profile. Similarly, if you created the
            invoice
            with the wrong client selected, you can easily correct that by pressing the Change button on the To area and
            choose
            the correct client.</p>

        <p><strong>3. Items</strong></p>
        <p>This is where you'll enter each of your line items. Press the Add Item button to add additional lines for
            your items.</p>

        <p><strong>4. Additional, Notes, Attachments and Payments Tabs</strong></p>
        <p>Terms and conditions as well as text to appear in the footer of your invoice may be entered on the Additional
            tab. Defaults
            for these fields may be set in System Settings on the Invoices tab (default values for these fields will not
            appear on invoices
            already created).</p>
        <p>Public or private notes may be entered on the Notes tab. Notes entered on this tab will be visible to clients
            viewing
            the invoice using the public link unless they are marked as private. Clients may leave notes on an invoice
            when viewing
            the invoice using the public link as well.</p>
        <p>File attachments may be uploaded to an invoice on the Attachments tab. See <a href="#attach-files-invoice">How
                do I attach files
                to an invoice?</a> for details.
        <p><strong>5. Options</strong></p>
        <p>A number of other options and values are defined in the options area.</p>
        <ul>
            <li>Invoice # - This is generated according to the group selected when the invoice was created.</li>
            <li>Date - The date the invoice was issued.</li>
            <li>Due Date - The date payment on the invoice is due.</li>
            <li>Discount - A percentage based discount can be applied to the invoice.</li>
            <li>Currency - The currency the invoice will be issued and paid in. The default currency can be changed on
                both the client
                record and in System Settings. If the client record has a different currency than System Settings, the
                currency on the client
                record will override System Settings.
            </li>
            <li>Exchange Rate - If a currency other than your base currency is selected, the exchange rate will
                automatically update
                itself based on the current rate.
            </li>
            <li>Status - The current status of the invoice. Once an invoice has been emailed, the status will
                automatically update
                itself to Sent. Once an invoice has been paid in full, the status will automatically update itself to
                Paid. If you have printed
                an invoice for delivery, you can manually change the status to Sent.
            </li>
            <li>Template - This is the template the invoice will use when viewed using the public link or when
                generating the invoice PDF. The
                default template can be changed on both the client record and in System Settings. If the client record
                has a different default template
                than System Settings, the client record will override System Settings. This behavior allows you use a
                specific template as default
                for most of your invoices while specifying a different template for a particular client or clients.
            </li>
        </ul>

        <a href="/img/documentation/invoice_edit.png" target="_blank">
            <img src="/img/documentation/invoice_edit_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="email-invoice"></span>
        <h3>How do I email an invoice?</h3>

        <p>Press the Email button from the Invoice Edit screen.</p>
        <p style="font-style: italic;">* Note that the Email button will not appear unless you have configured your
            email settings in System
            Settings on the Email tab.</p>

        <a href="/img/documentation/invoice_email.png" target="_blank">
            <img src="/img/documentation/invoice_email_small.png" class="img-responsive">
        </a>

        <p>The Email Invoice screen allows you to add additional recipients, change the subject and / or body, if
            necessary.</p>
        <p>Press the Send button to send the email.</p>

        <a href="/img/documentation/invoice_email2.png" target="_blank">
            <img src="/img/documentation/invoice_email2_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="enter-payment"></span>
        <h3>How do I enter a payment?</h3>

        <p>Payments collected manually can be entered against an invoice from the Invoice Edit screen by pressing the
            Other
            button and choosing Enter Payment.</p>

        <a href="/img/documentation/invoice_enter_payment.png" target="_blank">
            <img src="/img/documentation/invoice_enter_payment_small.png" class="img-responsive">
        </a>

        <p>If the invoice is being paid in full, the amount field will already contain the full balance amount so you
            won't have to
            enter or change anything. If the payment being made is only a partial payment, adjust the amount as
            needed.</p>
        <p>The date will default to today's date and can be adjusted if necessary.</p>
        <p>Choose the payment method to assign to the payment. Additional payment methods can be entered in System ->
            Payment Methods.</p>
        <p>A note can be optionally added to the payment.</p>
        <p>If you'd like to email the client with an email receipt of payment, check the Email Payment Receipt box.</p>
        <p>Press the Submit button and the payment will be submitted to the invoice.</p>

        <a href="/img/documentation/invoice_enter_payment2.png" target="_blank">
            <img src="/img/documentation/invoice_enter_payment2_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="copy-invoice"></span>
        <h3>How do I copy an invoice?</h3>

        <p>Press the Other button and choose Copy from the Invoice Edit screen.</p>

        <a href="/img/documentation/invoice_copy.png" target="_blank">
            <img src="/img/documentation/invoice_copy_small.png" class="img-responsive">
        </a>

        <p>Change the client's name if the copy will be for a different client.</p>
        <p>Review the date, company profile, and group. Change if necessary.</p>
        <p>Press the Submit button to complete the copy.</p>

        <a href="/img/documentation/invoice_copy2.png" target="_blank">
            <img src="/img/documentation/invoice_copy2_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="attach-files-invoice"></span>
        <h3>How do I attach files to an invoice?</h3>

        <p>Files of any type may be uploaded as an attachment to an invoice by clicking the Attachments tab on
            the Invoice Edit screen and pressing the Attach File button.</p>
        <p>The Client Visibility option may be adjusted for each file attachment to determine whether or not the
            client should be able to access and download the attachment when viewing the invoice public link. The
            following Client Visibility options are available for invoice attachments:</p>
        <ul>
            <li>Visible - Clients will be able to access this attachment from the invoice public link.</li>
            <li>Not Visible - Clients will not be able to access this attachment from the invoice public link.</li>
            <li>Visible After Payment - Clients will be able to access this attachment from the invoice public link only
                after the invoice
                has been paid in full.
            </li>
        </ul>

        <p style="font-style: italic;">* Note that attachments uploaded to an invoice do not "attach" themselves to the
            invoice
            PDF output. Invoice attachments are intended to provide an easy way to deliver digital assets related to an
            invoice
            to your clients (or just to store related files for your own purposes).</p>

        <a href="/img/documentation/invoice_attachments.png" target="_blank">
            <img src="/img/documentation/invoice_attachments_small.png" class="img-responsive">
        </a>

    </div>
@stop