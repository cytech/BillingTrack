@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Payments</h2>

        <hr>

        <p><a href="#enter-payment">How do I enter a payment?</a></p>

        <p><a href="#online-payments">How do I enable online payments?</a></p>

        <p><a href="#paypal-rest-api-keys">How do I get my PayPal REST API keys?</a></p>

        <p><a href="#client-online-payments">How does my client pay their invoice online?</a></p>

        <hr>

        <span class="anchor" id="enter-payment"></span>
        <h3>How do I enter a payment?</h3>

        <p>See <a href="Invoices#enter-payment">How do I enter a payment?</a> in the Invoices user guide.</p>

        <hr>

        <span class="anchor" id="online-payments"></span>
        <h3>How do I enable online payments?</h3>

        <p>Once online payments have been enabled, your clients can pay their invoices quickly, conveniently
            and securely using the invoice public link.</p>
        <p>To configure FusionInvoiceFOSS for online payments, click the System icon and select System Settings.</p>

        <a href="/img/documentation/system_settings.png" target="_blank">
            <img src="/img/documentation/system_settings_small.png" class="img-responsive">
        </a>

        <p>Each of the different payment gateways that are compatible with FusionInvoiceFOSS are listed on the
            Online Payments tab.</p>

        <p>Each of the payment gateways have their own set of options to be configured:</p>

        <ul>
            <li>PayPal
                <ul>
                    <li>Enabled - Set to Yes to enable the "Pay with PayPal" button on the invoice public link.</li>
                    <li>Test Mode - Set to Yes if using a set of test/development API keys (these are different
                        than your normal API keys). Set to No if using production API keys.
                    </li>
                    <li>API Username - Enter the API Username found in your PayPal account under My Profile ->
                        My selling tools -> API access -> NVP/SOAP API integration.
                    </li>
                    <li>API Password - Enter the API Password found in the same area as the API Username.</li>
                    <li>Signature - Enter the Signature found in the same area as the API Username & API Password.</li>
                    <li>Payment Button Text - By default, the button displayed on the invoice public link will read
                        "Pay with PayPal". This setting allows you to change the button text however you see fit.
                    </li>
                </ul>
            </li>
            <li>Stripe
                <ul>
                    <li>Enabled - Set to Yes to enable the "Pay with Stripe" button on the invoice public link.</li>
                    <li>Secret Key - Enter the Secret Key found in your Stripe account under Account Settings ->
                        API Keys.
                    </li>
                    <li>Publishable Key - Enter the Publishable Key found in the same area as the Secret Key.</li>
                    <li>Billing Name/Address/City/State/Zip - The default payment form includes the required Card
                        Number, CVC and Expiration fields. You may optionally
                        enable the Billing Name, Billing Address, Billing City, Billing State and/or Billing Zip
                        fields as well.
                    </li>
                    <li>Payment Button Text - By default, the button displayed on the invoice public link will read
                        "Pay with Stripe". This setting allows you to change the button text however you see fit.
                    </li>
                </ul>
            </li>
            <li>Mollie
                <ul>
                    <li>Enabled - Set to Yes to enable the "Pay with Mollie" button on the invoice public link.</li>
                    <li>API Key - Enter your Mollie API key.</li>
                    <li>Payment Button Text - By default, the button displayed on the invoice public link will read
                        "Pay with Mollie". This setting allows you to change the button text however you see fit.
                    </li>
                </ul>
            </li>
        </ul>

        <a href="/img/documentation/system_settings_online_payments.png" target="_blank">
            <img src="/img/documentation/system_settings_online_payments_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="paypal-rest-api-keys"></span>
        <h3>How do I get my PayPal REST API keys?</h3>

        <p>Prior to version 2018-7, FusionInvoiceFOSS used PayPal's classic NVP/SOAP api. Version 2018-7 and later use
            PayPal's REST api.</p>

        <p>Log into the <a href="https://developer.paypal.com/developer/applications/">PayPal
                Developer</a> portal using your standard PayPal credentials.</p>

        <p>Click the Create App button in the REST API apps section of the My Apps & Credentials page.</p>
        <a href="/img/documentation/online_payments_paypal_rest1.png" target="_blank">
            <img src="/img/documentation/online_payments_paypal_rest1_small.png" class="img-responsive">
        </a>

        <p>Give the app a name, such as FusionInvoiceFOSS (or whatever you'd like) and click the Create App button.</p>
        <a href="/img/documentation/online_payments_paypal_rest2.png" target="_blank">
            <img src="/img/documentation/online_payments_paypal_rest2_small.png" class="img-responsive">
        </a>

        <p>Once the app is created, the Client ID and Secret ID can be obtained. Note there is an option to switch
            between
            the keys for Sandbox and Live. Be sure and use Sandbox for testing purposes and Live for production. Also
            note the
            Secret ID spans two lines, so be sure the entire key gets copied. Configure the keys in FusionInvoiceFOSS on the
            Online Payments
            tab in System Settings.</p>
        <a href="/img/documentation/online_payments_paypal_rest3.png" target="_blank">
            <img src="/img/documentation/online_payments_paypal_rest3_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="client-online-payments"></span>
        <h3>How does my client pay their invoice online?</h3>

        <p>Once you have FusionInvoiceFOSS configured to accept online payments, clients may pay their invoices using the
            invoice public link.</p>
        <p>When an invoice is emailed to the client, the email will contain a link to view and pay the invoice online.
            This is the
            "invoice public link". Buttons for each of the enabled payment gateways will appear at the top of the
            invoice as shown below.</p>

        <a href="/img/documentation/payment_online.png" target="_blank">
            <img src="/img/documentation/payment_online_small.png"
                 class="img-responsive">
        </a>

    </div>

@stop