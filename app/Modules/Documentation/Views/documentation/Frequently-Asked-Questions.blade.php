@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Frequently Asked Questions</h2>

        <hr>

        <p><a href="#change-status-paid">Why can't I change my invoice status to Paid?</a></p>
        <p><a href="#troubleshooting-recurring-invoices">Why aren't my recurring invoices working?</a></p>
        <p><a href="#how-do-i-reset-my-password">I forgot my password - how can I reset it?</a></p>
        <p><a href="#dashboard-totals">Why do the totals on my dashboard all show zero?</a></p>
        <p><a href="#supported-payment-gateways">Can FusionInvoiceFOSS work with XYZ payment gateway?</a></p>
        <p><a href="#how-to-remove-index-php">How can I remove index.php from my URL?</a></p>
        <p><a href="#how-to-force-https">How can I force my FusionInvoiceFOSS installation to be served over https?</a></p>

        <hr>

        <span class="anchor" id="change-status-paid"></span>
        <h3>Why can't I change the status to paid?</h3>

        <p>
            The paid status is the only status you cannot manually change an invoice to. To
            change an invoice to Paid status, the
            invoice must have a payment made in full. Once the invoice has no remaining balance,
            the status will automatically
            update to Paid.
        </p>

        <hr>

        <span class="anchor" id="troubleshooting-recurring-invoices"></span>
        <h3>Why aren't my recurring invoices working?</h3>

        <p>First, check the Next Date of the recurring invoice you expect should have generated.</p>

        <a href="/img/documentation/troubleshoot_recurring_invoices.png" target="_blank">
            <img src="/img/documentation/troubleshoot_recurring_invoices_small.png"
                 class="img-responsive">
        </a>

        <ol>
            <li>Click Recurring Invoices.</li>
            <li>The date in the Next Date field indicates the date which this invoice should recur next. If this date is
                in the
                future, then the invoice isn't ready to recur yet.
            </li>
        </ol>

        <p>
            If the Next Date is today's date or prior to today's date but the recurring invoice hasn't been generated,
            then the
            next step would be to visit http://YourFusionInvoiceURL/tasks/run (or
            http://YourFusionInvoiceURL/index.php/tasks/run if
            you have to specify index.php in your URL).</p>
        <p>
            One of two things will happen when you visit this URL in your browser:
        <ol>
            <li>
                You'll be greeted by an empty, white page. This is good - if you go back to check your list of recurring
                invoices, you should find that the Next Date has incremented to the next date in the set frequency. You
                should
                also find that the new invoice has appeared in your list of invoices. If this is the case. then the
                <a href="Task-Scheduler">Task Scheduler</a> cron job hasn't
                been set up or has been set up improperly.
            </li>
            <li>
                You'll be greeted with a lovely, "Whoops..." error message. If this is the case, there will be details
                logged
                at the bottom of your storage/logs/laravel.log file.
            </li>

        </ol>
        </p>

        <span class="anchor" id="how-do-i-reset-my-password"></span>
        <h3>I forgot my password - how can I reset it?</h3>

        <ol>
            <li>Get the ResetPassword-2018.zip utility from the resources/misc directory of this repository.</li>
            <li>Unzip the contents.</li>
            <li>Upload the unzipped ResetPassword folder to the app/Modules folder on your server so that it becomes
                app/Modules/ResetPassword.
            </li>
            <li>Visit your FusionInvoiceURL/resetpassword to reset your password.</li>
            <li>Once your password has been reset, <strong>delete the app/Modules/ResetPassword folder from your
                    server</strong>.
            </li>
        </ol>

        <hr>

        <span class="anchor" id="dashboard-totals"></span>
        <h3>Why do the totals on my dashboard all show zero?</h3>

        <p>
            There are settings on the Dashboard tab of System Settings which control this behavior for both quotes and
            invoices.
            The default option is Year to Date. This can be changed to This Quarter, All Time, or Custom Date Range.</p>

        <hr>

        <span class="anchor" id="supported-payment-gateways"></span>
        <h3>Can FusionInvoiceFOSS work with XYZ payment gateway?</h3>

        <p>
            FusionInvoiceFOSS uses the <a href="https://github.com/thephpleague/omnipay"
                                      target="_blank">Omnipay</a> payment
            processing library which supports a large number of different
            <a href="https://github.com/thephpleague/omnipay#payment-gateways"
               target="_blank">payment gateways</a>. Even though
            Omnipay supports a large number of gateways, FusionInvoiceFOSS implements support for those gateways upon
            popular
            request. If a gateway is on the list of Omnipay supported gateways that isn't yet implemented in
            FusionInvoice,
            please don't hesitate to ask! However, if Omnipay does not support a particular gateway, then FusionInvoice
            will not
            support it either.
        </p>

        <hr>

        <span class="anchor" id="how-to-remove-index-php"></span>
        <h3>How can I remove index.php from my URL?</h3>

        <h4>If you're using Apache, try these things in the order they're listed below:</h4>

        <ol>
            <li>
                Verify that the .htaccess file distributed in the FusionInvoiceFOSS download file was actually uploaded to
                your
                server. This file should exist in the root folder of your FusionInvoiceFOSS installation (in the same folder
                as the
                index.php file). This file should work out of the box 99% of the time for Apache environments.
            </li>
            <li>
                Make sure the Apache mod_rewrite module is installed and enabled. If you are unsure of how to check for
                this,
                contact your web host support or system administrator to ask them.
            </li>
            <li>
                Open the .htaccess file and change this:
                <pre>RewriteEngine On</pre>
                to this:
                <pre>RewriteEngine On
RewriteBase /</pre>
                If RewriteBase / makes no difference, you can also try:
                <pre>RewriteEngine On
RewriteBase /TheNameOfYourFusionInvoiceFolder/</pre>
            </li>
        </ol>

        <h4>If you're using nginx:</h4>

        <p>Add the following location directive (or change your existing location directive) in your site configuration
            file:</p>

        <pre>
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
</pre>

        <h4>If you're using IIS:</h4>

        <p>Use
            <a href="http://www.iis.net/learn/extensions/url-rewrite-module/importing-apache-modrewrite-rules">this
                guide</a>
            to import the include mod_rewrite rules from the .htaccess file into a web.config file for IIS.</p>

        <hr>

        <span class="anchor" id="how-to-force-https"></span>
        <h3>How can I force my FusionInvoiceFOSS installation to be served over https?</h3>

        <p>
            Version 2018-4 added an option to the General tab of System Settings which will force FusionInvoiceFOSS to be
            served over https.
            Prior to enabling this option, be sure your FusionInvoiceFOSS installation is functional via https. Failure to
            do so may result in a
            non-functional (but fixable) installation.
        </p>

        <p>
            It is recommended that your server environment be configured to redirect incoming requests from http to
            https, but if this is
            not an option, you may enable the Force HTTPS option in System Settings.
        </p>

        <p>If you're unable to access your installation after enabling the Force HTTPS option, run the following query
            in your FusionInvoiceFOSS database to undo the change:</p>

        <pre>
update settings set setting_value = '0' where setting_key = 'forceHttps'
</pre>


    </div>

@stop