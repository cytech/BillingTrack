Payments
---

---

[How do I enter a payment?](#how-do-i-enter-a-payment)

[How do I enable online payments?](#how-do-i-enable-online-payments)

[How do I get my PayPal REST API keys?](#how-do-i-get-my-paypal-rest-api-keys)

[How does my client pay their invoice online?](#how-does-my-client-pay-their-invoice-online)

---

<a id="how-do-i-enter-a-payment"></a>
### How do I enter a payment?

See [How do I enter a payment?](Invoices.md#how-do-i-enter-a-payment) in the Invoices
user guide.

---

<a id="how-do-i-enable-online-payments"></a>
### How do I enable online payments?

Once online payments have been enabled, your clients can pay their
invoices quickly, conveniently and securely using the invoice public
link.

To configure BillingTrack for online payments, click the System icon and
select System Settings.

[<img src="/img/documentation/system_settings_sm.png" class="img-responsive" />](/img/documentation/system_settings.png)

Each of the different payment gateways that are compatible with
BillingTrack are listed on the Online Payments tab.

Each of the payment gateways have their own set of options to be
configured:

-   PayPal
    -   Enabled - Set to Yes to enable the "Pay with PayPal" button on
        the invoice public link.
    -   Test Mode - Set to Yes if using a set of test/development API
        keys (these are different than your normal API keys). Set to No
        if using production API keys.
    -   API Username - Enter the API Username found in your PayPal
        account under My Profile -&gt; My selling tools -&gt; API access
        -&gt; NVP/SOAP API integration.
    -   API Password - Enter the API Password found in the same area as
        the API Username.
    -   Signature - Enter the Signature found in the same area as the
        API Username & API Password.
    -   Payment Button Text - By default, the button displayed on the
        invoice public link will read "Pay with PayPal". This setting
        allows you to change the button text however you see fit.
-   Stripe
    -   Enabled - Set to Yes to enable the "Pay with Stripe" button on
        the invoice public link.
    -   Secret Key - Enter the Secret Key found in your Stripe account
        under Account Settings -&gt; API Keys.
    -   Publishable Key - Enter the Publishable Key found in the same
        area as the Secret Key.
    -   Billing Name/Address/City/State/Zip - The default payment form
        includes the required Card Number, CVC and Expiration fields.
        You may optionally enable the Billing Name, Billing Address,
        Billing City, Billing State and/or Billing Zip fields as well.
    -   Payment Button Text - By default, the button displayed on the
        invoice public link will read "Pay with Stripe". This setting
        allows you to change the button text however you see fit.
-   Mollie
    -   Enabled - Set to Yes to enable the "Pay with Mollie" button on
        the invoice public link.
    -   API Key - Enter your Mollie API key.
    -   Payment Button Text - By default, the button displayed on the
        invoice public link will read "Pay with Mollie". This setting
        allows you to change the button text however you see fit.

[<img src="/img/documentation/system_settings_online_payments_sm.png" class="img-responsive" />](/img/documentation/system_settings_online_payments.png)

---

<a id="how-do-i-get-my-paypal-rest-api-keys"></a>
### How do I get my PayPal REST API keys?

BillingTrack uses PayPal's REST api.

Log into the [PayPal
Developer](https://developer.paypal.com/developer/applications/) portal
using your standard PayPal credentials.

Click the Create App button in the REST API apps section of the My Apps
& Credentials page.

[<img src="/img/documentation/online_payments_paypal_rest1_sm.png" class="img-responsive" />](/img/documentation/online_payments_paypal_rest1.png)

Give the app a name, such as BillingTrack (or whatever you'd like) and
click the Create App button.

[<img src="/img/documentation/online_payments_paypal_rest2_sm.png" class="img-responsive" />](/img/documentation/online_payments_paypal_rest2.png)

Once the app is created, the Client ID and Secret ID can be obtained.
Note there is an option to switch between the keys for Sandbox and Live.
Be sure and use Sandbox for testing purposes and Live for production.
Also note the Secret ID spans two lines, so be sure the entire key gets
copied. Configure the keys in BillingTrack on the Online Payments tab in
System Settings.

[<img src="/img/documentation/online_payments_paypal_rest3_sm.png" class="img-responsive" />](/img/documentation/online_payments_paypal_rest3.png)

---

<a id="how-does-my-client-pay-their-invoice-online"></a>
### How does my client pay their invoice online?

Once you have BillingTrack configured to accept online payments, clients
may pay their invoices using the invoice public link.

When an invoice is emailed to the client, the email will contain a link
to view and pay the invoice online. This is the "invoice public link".
Buttons for each of the enabled payment gateways will appear at the top
of the invoice as shown below.

[<img src="/img/documentation/payment_online_sm.png" class="img-responsive" />](/img/documentation/payment_online.png)
