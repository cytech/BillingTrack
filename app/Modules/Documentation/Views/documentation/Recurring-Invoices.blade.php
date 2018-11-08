@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Recurring Invoices</h2>

        <hr>

        <p><a href="#recurring-invoices">How do recurring invoices work?</a></p>
        <p><a href="#create-recurring-invoice">How do I create a recurring invoice?</a></p>
        <p><a href="#copy-recurring-invoice">How do I copy a recurring invoice?</a></p>

        <hr>

        <span class="anchor" id="recurring-invoices"></span>
        <h3>How do recurring invoices work?</h3>

        <p>Recurring invoices act as a template for invoices which need to be generated on a specific
            frequency (once a month, twice a year, etc). Other than the fact that recurring invoices aren't sent
            directly to a client (the generated invoice is) and payments aren't made against a recurring invoice
            (payments are
            made against the generated invoice), recurring invoices are almost identical to invoices.</p>

        <p>Once a recurring invoice has been created, the <a href="Task-Scheduler">Task Scheduler</a>
            will cycle through each day and check for any recurring invoices which are due to generate invoices from.
            Any recurring invoices which are
            due to be generated will be. Depending on the "Automatically email recurring invoices" setting in System
            Settings on the Invoices tab, the generated
            invoice will email itself to the client.</p>

        <p style="font-style: italic;">* Note the <a href="Task-Scheduler">Task Scheduler</a> needs
            to be set up before any recurring invoices will actually generate.</p>

        <hr>

        <span class="anchor" id="create-recurring-invoice"></span>
        <h3>How do I create a recurring invoice?</h3>

        <p>Click the Recurring Invoices menu item and press the New button.</p>
        <a href="/img/documentation/recurring_invoice_create.png" target="_blank">
            <img src="/img/documentation/recurring_invoice_create_small.png" class="img-responsive">
        </a>

        <p>The Create Recurring Invoice screen will prompt you for the client name, company profile, group, start date
            and frequency.</p>
        <p>If the recurring invoice is for a new client, type the client's name in full. You will be able to edit the
            other details
            for this client record from the next screen. If the recurring invoice is for an existing client, start
            typing the client's
            name and you will be able to select your existing client from the list that appears.</p>
        <p>The company profile is where the recurring invoice will pull your company name, address, phone number, and
            other company
            specific details from.</p>
        <p>The group controls the format of the number assigned to each generated invoice.</p>
        <p>Set the start date to the date the invoice should first be generated.</p>
        <p>Set the frequency for the invoice.</p>
        <p>Press Submit when done and you'll be taken to the Recurring Invoice Edit screen.</p>

        <a href="/img/documentation/recurring_invoice_create2.png" target="_blank">
            <img src="/img/documentation/recurring_invoice_create2_small.png" class="img-responsive">
        </a>

        <p>The Recurring Invoice Edit screen is where you'll add line items as well as define further properties and
            options
            for your recurring invoice.</p>
        <p><strong>1. Summary</strong></p>
        <p>Entering a brief summary or description of the recurring invoice will make it to find and search for.</p>

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

        <p><strong>4. Additional Tab</strong></p>
        <p>Terms and conditions as well as text to appear in the footer of your invoice may be entered on the Additional
            tab. Defaults
            for these fields may be set in System Settings on the Invoices tab (default values for these fields will not
            appear on recurring invoices
            already created).</p>
        <p><strong>5. Options</strong></p>
        <p>A number of other options and values are defined in the options area.</p>
        <ul>
            <li>Next Date - The date the next invoice will be generated.</li>
            <li>Every - The frequency in which the invoice will generate.</li>
            <li>Stop Date - If invoices should generate up to a specific date and stop afterward, the stop date can be
                entered.
            </li>
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
            <li>Template - This is the template the invoice will use when viewed using the public link or when
                generating the invoice PDF. The
                default template can be changed on both the client record and in System Settings. If the client record
                has a different default template
                than System Settings, the client record will override System Settings. This behavior allows you use a
                specific template as default
                for most of your invoices while specifying a different template for a particular client or clients.
            </li>
        </ul>

        <a href="/img/documentation/recurring_invoice_edit.png" target="_blank">
            <img src="/img/documentation/recurring_invoice_edit_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="copy-recurring-invoice"></span>
        <h3>How do I copy a recurring invoice?</h3>

        <p>Press the Other button and choose Copy from the Invoice Edit screen.</p>

        <a href="/img/documentation/recurring_invoice_copy.png" target="_blank">
            <img src="/img/documentation/recurring_invoice_copy_small.png" class="img-responsive">
        </a>

        <p>Change the client's name if the copy will be for a different client.</p>
        <p>Review the date, company profile, group, start date and frequency. Change if necessary.</p>
        <p>Press the Submit button to complete the copy.</p>

        <a href="/img/documentation/recurring_invoice_copy2.png" target="_blank">
            <img src="/img/documentation/recurring_invoice_copy2_small.png" class="img-responsive">
        </a>

    </div>

@stop