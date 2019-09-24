Frequently Asked Questions
---

---

[Why can't I change the status to paid?](#why-cant-i-change-the-status-to-paid)

[Why aren't my recurring invoices working?](#why-arent-my-recurring-invoices-working)

[I forgot my password - how can I reset it?](#i-forgot-my-password---how-can-i-reset-it)

[Why do the totals on my dashboard all show zero?](#why-do-the-totals-on-my-dashboard-all-show-zero)

[Can BillingTrack work with XYZ payment gateway?](#can-billingtrack-work-with-xyz-payment-gateway)

[How can I remove index.php from my URL?](#how-can-i-remove-indexphp-from-my-url)

[How can I force my BillingTrack installation to be served over https?](#how-can-i-force-my-billingtrack-installation-to-be-served-over-https)

---

<a id="why-cant-i-change-the-status-to-paid"></a>
### Why can't I change the status to paid?

The paid status is the only status you cannot manually change an invoice
to. To change an invoice to Paid status, the invoice must have a payment
made in full. Once the invoice has no remaining balance, the status will
automatically update to Paid.

---

<a id="why-arent-my-recurring-invoices-working"></a>
### Why aren't my recurring invoices working?

First, check the Next Date of the recurring invoice you expect should
have generated.

[<img src="/img/documentation/troubleshoot_recurring_invoices_sm.png" class="img-responsive" />](/img/documentation/troubleshoot_recurring_invoices.png)

1.  Click Recurring Invoices.
2.  The date in the Next Date field indicates the date which this
    invoice should recur next. If this date is in the future, then the
    invoice isn't ready to recur yet.

If the Next Date is today's date or prior to today's date but the
recurring invoice hasn't been generated, then the next step would be to
visit http://YourBillingTrackURL/tasks/run (or
http://YourBillingTrackURL/index.php/tasks/run if you have to specify
index.php in your URL).

One of two things will happen when you visit this URL in your browser:

1.  You'll be greeted by an empty, white page. This is good - if you go
    back to check your list of recurring invoices, you should find that
    the Next Date has incremented to the next date in the set frequency.
    You should also find that the new invoice has appeared in your list
    of invoices. If this is the case. then the [Task
    Scheduler](Task-Scheduler.md) cron job hasn't been set up or has been
    set up improperly.
2.  You'll be greeted with a lovely, "Whoops..." error message. If this
    is the case, there will be details logged at the bottom of your
    storage/logs/laravel.log file.

<a id="i-forgot-my-password---how-can-i-reset-it"></a>
### I forgot my password - how can I reset it?

1.  Get the ResetPassword-2018.zip utility from the resources/misc
    directory of this repository.
2.  Unzip the contents.
3.  Upload the unzipped ResetPassword folder to the app/Modules folder
    on your server so that it becomes app/Modules/ResetPassword.
4.  Visit your BillingTrackURL/resetpassword to reset your password.
5.  Once your password has been reset, **delete the
    app/Modules/ResetPassword folder from your server**.

---

<a id="why-do-the-totals-on-my-dashboard-all-show-zero"></a>
### Why do the totals on my dashboard all show zero?

There are settings on the Dashboard tab of System Settings which control
this behavior for both quotes and invoices. The default option is Year
to Date. This can be changed to This Quarter, All Time, or Custom Date
Range.

---

<a id="can-billingtrack-work-with-xyz-payment-gateway"></a>
### Can BillingTrack work with XYZ payment gateway?

BillingTrack
only implements support for Mollie, PayPal and Stripe.

---

<a id="how-can-i-remove-indexphp-from-my-url"></a>
### How can I remove index.php from my URL?

#### If you're using Apache, try these things in the order they're listed below:

1.  Verify that the .htaccess file distributed in the BillingTrack
    download file was actually uploaded to your server. This file should
    exist in the root folder of your BillingTrack installation (in the
    same folder as the index.php file). This file should work out of the
    box 99% of the time for Apache environments.
2.  Make sure the Apache mod\_rewrite module is installed and enabled.
    If you are unsure of how to check for this, contact your web host
    support or system administrator to ask them.
3.  Open the .htaccess file and change this:

        RewriteEngine On

    to this:

        RewriteEngine On
        RewriteBase /

    If RewriteBase / makes no difference, you can also try:

        RewriteEngine On
        RewriteBase /TheNameOfYourBillingTrackFolder/

#### If you're using nginx:

Add the following location directive (or change your existing location
directive) in your site configuration file:

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

#### If you're using IIS:

Use [this
guide](http://www.iis.net/learn/extensions/url-rewrite-module/importing-apache-modrewrite-rules)
to import the include mod\_rewrite rules from the .htaccess file into a
web.config file for IIS.

---

<a id="how-can-i-force-my-billingtrack-installation-to-be-served-over-https"></a>
### How can I force my BillingTrack installation to be served over https?

There is an option in the General tab of System Settings which will
force BillingTrack to be served over https. Prior to enabling this
option, be sure your BillingTrack installation is functional via https.
Failure to do so may result in a non-functional (but fixable)
installation.

It is recommended that your server environment be configured to redirect
incoming requests from http to https, but if this is not an option, you
may enable the Force HTTPS option in System Settings.

If you're unable to access your installation after enabling the Force
HTTPS option, run the following query in your BillingTrack database to
undo the change:

    update settings set setting_value = '0' where setting_key = 'forceHttps'
