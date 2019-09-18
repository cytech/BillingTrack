Email Templates
---

---

[What are email templates?](#what-are-email-templates)

[Quote Email Template](#quote-email-template)

[Workorder Email Template](#workorder-email-template)

[Invoice Email Template](#invoice-email-template)

[Purchaseorder Email Template](#purchaseorder-email-template)

[Payment Receipt Email Template](#payment-receipt-email-template)

---

<a id="what-are-email-templates"></a>
### What are email templates?

Email templates allow customization of email sent from BillingTrack. The
templates are located in System Settings on the Email tab and can
contain HTML and a number of dynamic variables which will be replaced
with the appropriate values when the email is sent.

---

<a id="quote-email-template"></a>
### Quote Email Template

The variables listed below can be used in the following fields in System
Settings on the Email tab:

-   **Quote Email Subject**
-   **Default Quote Email Body**
-   **Quote Approved Email Body**
-   **Quote Rejected Email Body**

-   **Quote Information**
    -   Issue Date: @{{ $quote-&gt;formatted\_created\_at }}
    -   Expiration Date: @{{ $quote-&gt;formatted\_expires\_at }}
    -   Number: @{{ $quote-&gt;number }}
    -   Status: @{{ $quote-&gt;status\_text }}
    -   Summary: @{{ $quote-&gt;summary }}
    -   Public URL: @{{ $quote-&gt;public\_url }}
    -   Terms: @{{ $quote-&gt;formatted\_terms }}
    -   Footer: @{{ $quote-&gt;formatted\_footer }}
    -   Total Amount: @{{ $quote-&gt;amount-&gt;formatted\_total }}
-   **Client Information**
    -   Name: @{{ $quote-&gt;client-&gt;name }}
    -   Address: @{{ $quote-&gt;client-&gt;formatted\_address }}
    -   Phone: @{{ $quote-&gt;client-&gt;phone }}
    -   Fax: @{{ $quote-&gt;client-&gt;fax }}
    -   Mobile: @{{ $quote-&gt;client-&gt;mobile }}
    -   Email: @{{ $quote-&gt;client-&gt;email }}
    -   Website: @{{ $quote-&gt;client-&gt;web }}
-   **User Account Information**
    -   Name: @{{ $quote-&gt;user-&gt;name }}
    -   Company: @{{ $quote-&gt;companyProfile-&gt;company }}
    -   Address: @{{ $quote-&gt;user-&gt;formatted\_address }}
    -   Phone: @{{ $quote-&gt;user-&gt;phone }}
    -   Fax: @{{ $quote-&gt;user-&gt;fax }}
    -   Mobile: @{{ $quote-&gt;user-&gt;mobile }}
    -   Website: @{{ $quote-&gt;user-&gt;web }}

Example Subject:

Quote \#@{{ $quote-&gt;number }}



Example Body:

&lt;p&gt;To view your quote from @{{ $quote-&gt;user-&gt;name }} for @{{
$quote-&gt;amount-&gt;formatted\_total }}, click the link
below:&lt;/p&gt;

&lt;p&gt;&lt;a href="@{{ $quote-&gt;public\_url }}"&gt;@{{
$quote-&gt;public\_url }}&lt;/a&gt;&lt;/p&gt;

---

<a id="workorder-email-template"></a>
### Workorder Email Template

The variables listed below can be used in the following fields in System
Settings on the Email tab:

-   **Workorder Email Subject**
-   **Default Workorder Email Body**
-   **Workorder Approved Email Body**
-   **Workorder Rejected Email Body**

-   **Workorder Information**
    -   Issue Date: @{{ $workorder-&gt;formatted\_created\_at }}
    -   Expiration Date: @{{ $workorder-&gt;formatted\_expires\_at }}
    -   Number: @{{ $workorder-&gt;number }}
    -   Status: @{{ $workorder-&gt;status\_text }}
    -   Summary: @{{ $workorder-&gt;summary }}
    -   Public URL: @{{ $workorder-&gt;public\_url }}
    -   Terms: @{{ $workorder-&gt;formatted\_terms }}
    -   Footer: @{{ $workorder-&gt;formatted\_footer }}
    -   Total Amount: @{{ $workorder-&gt;amount-&gt;formatted\_total }}
-   **Client Information**
    -   Name: @{{ $workorder-&gt;client-&gt;name }}
    -   Address: @{{ $workorder-&gt;client-&gt;formatted\_address }}
    -   Phone: @{{ $workorder-&gt;client-&gt;phone }}
    -   Fax: @{{ $workorder-&gt;client-&gt;fax }}
    -   Mobile: @{{ $workorder-&gt;client-&gt;mobile }}
    -   Email: @{{ $workorder-&gt;client-&gt;email }}
    -   Website: @{{ $workorder-&gt;client-&gt;web }}
-   **User Account Information**
    -   Name: @{{ $workorder-&gt;user-&gt;name }}
    -   Company: @{{ $workorder-&gt;companyProfile-&gt;company }}
    -   Address: @{{ $workorder-&gt;user-&gt;formatted\_address }}
    -   Phone: @{{ $workorder-&gt;user-&gt;phone }}
    -   Fax: @{{ $workorder-&gt;user-&gt;fax }}
    -   Mobile: @{{ $workorder-&gt;user-&gt;mobile }}
    -   Website: @{{ $workorder-&gt;user-&gt;web }}

Example Subject:

Workorder \#@{{ $workorder-&gt;number }}



Example Body:

&lt;p&gt;To view your workorder from @{{ $workorder-&gt;user-&gt;name }}
for @{{ $workorder-&gt;amount-&gt;formatted\_total }}, click the link
below:&lt;/p&gt;

&lt;p&gt;&lt;a href="@{{ $workorder-&gt;public\_url }}"&gt;@{{
$workorder-&gt;public\_url }}&lt;/a&gt;&lt;/p&gt;

---

<a id="invoice-email-template"></a>
### Invoice Email Template

The variables listed below can be used in the following fields in System
Settings on the Email tab:

-   **Invoice Email Subject**
-   **Default Invoice Email Body**
-   **Overdue Email Subject**
-   **Default Overdue Invoice Email Body**
-   **Upcoming Payment Notice Email Subject**
-   **Upcoming Payment Notice Email Body**

-   **Invoice Information**
    -   Issue Date: @{{ $invoice-&gt;formatted\_created\_at }}
    -   Due Date: @{{ $invoice-&gt;formatted\_due\_at }}
    -   Number: @{{ $invoice-&gt;number }}
    -   Status: @{{ $invoice-&gt;status\_text }}
    -   Summary: @{{ $invoice-&gt;summary }}
    -   Public URL: @{{ $invoice-&gt;public\_url }}
    -   Terms: @{{ $invoice-&gt;formatted\_terms }}
    -   Footer: @{{ $invoice-&gt;formatted\_footer }}
    -   Total Amount: @{{ $invoice-&gt;amount-&gt;formatted\_total }}
    -   Amount Paid: @{{ $invoice-&gt;amount-&gt;formatted\_paid }}
    -   Balance: @{{ $invoice-&gt;amount-&gt;formatted\_balance }}
-   **Client Information**
    -   Name: @{{ $invoice-&gt;client-&gt;name }}
    -   Address: @{{ $invoice-&gt;client-&gt;formatted\_address }}
    -   Phone: @{{ $invoice-&gt;client-&gt;phone }}
    -   Fax: @{{ $invoice-&gt;client-&gt;fax }}
    -   Mobile: @{{ $invoice-&gt;client-&gt;mobile }}
    -   Email: @{{ $invoice-&gt;client-&gt;email }}
    -   Website: @{{ $invoice-&gt;client-&gt;web }}
-   **User Account Information**
    -   Name: @{{ $invoice-&gt;user-&gt;name }}
    -   Company: @{{ $invoice-&gt;companyProfile-&gt;company }}
    -   Address: @{{ $invoice-&gt;user-&gt;formatted\_address }}
    -   Phone: @{{ $invoice-&gt;user-&gt;phone }}
    -   Fax: @{{ $invoice-&gt;user-&gt;fax }}
    -   Mobile: @{{ $invoice-&gt;user-&gt;mobile }}
    -   Website: @{{ $invoice-&gt;user-&gt;web }}

Example Subject:

Invoice \#@{{ $invoice-&gt;number }}



Example Body:

&lt;p&gt;To view your invoice from @{{ $invoice-&gt;user-&gt;name }} for
@{{ $invoice-&gt;amount-&gt;formatted\_total }}, click the link
below:&lt;/p&gt;

&lt;p&gt;&lt;a href="@{{ $invoice-&gt;public\_url }}"&gt;@{{
$invoice-&gt;public\_url }}&lt;/a&gt;&lt;/p&gt;

&lt;p&gt;@{{ $invoice-&gt;user-&gt;formatted\_address }}&lt;/p&gt;

---

<a id="purchaseorder-email-template"></a>
### Purchaseorder Email Template

The variables listed below can be used in the following fields in
Purchase Order email settings:

-   **Purchaseorder Email Subject**
-   **Default Purchaseorder Email Body**

-   **Purchaseorder Information**
    -   Issue Date: @{{ $purchaseorder-&gt;formatted\_created\_at }}
    -   Expiration Date: @{{ $purchaseorder-&gt;formatted\_due\_at }}
    -   Number: @{{ $purchaseorder-&gt;number }}
    -   Status: @{{ $purchaseorder-&gt;status\_text }}
    -   Summary: @{{ $purchaseorder-&gt;summary }}
    -   Terms: @{{ $purchaseorder-&gt;formatted\_terms }}
    -   Footer: @{{ $purchaseorder-&gt;formatted\_footer }}
    -   Total Amount: @{{ $purchaseorder-&gt;amount-&gt;formatted\_total
        }}
-   **Company Information**
    -   Company: @{{ $purchaseorder-&gt;companyProfile-&gt;company }}
    -   Address: @{{
        $purchaseorder-&gt;companyProfile-&gt;formatted\_address }}
    -   Phone: @{{ $purchaseorder-&gt;companyProfile-&gt;phone }}
    -   Fax: @{{ $purchaseorder-&gt;companyProfile-&gt;fax }}
    -   Mobile: @{{ $purchaseorder-&gt;companyProfile-&gt;mobile }}
    -   Email: @{{ $purchaseorder-&gt;user-&gt;email }}
    -   Website: @{{ $purchaseorder-&gt;companyProfile-&gt;web }}
-   **User Account Information**
    -   Name: @{{ $purchaseorder-&gt;user-&gt;name }}
    -   Company: @{{ $purchaseorder-&gt;companyProfile-&gt;company }}
    -   Address: @{{ $purchaseorder-&gt;user-&gt;formatted\_address }}
    -   Phone: @{{ $purchaseorder-&gt;user-&gt;phone }}
    -   Fax: @{{ $purchaseorder-&gt;user-&gt;fax }}
    -   Mobile: @{{ $purchaseorder-&gt;user-&gt;mobile }}
    -   Website: @{{ $purchaseorder-&gt;user-&gt;web }}

Example Subject:

Purchaseorder \#@{{ $purchaseorder-&gt;number }}



Example Body:

&lt;p&gt;Please find the atached Purchase Order from @{{
$purchaseorder-&gt;companyProfile-&gt;company }} for @{{
$purchaseorder-&gt;amount-&gt;formatted\_total }}

---

<a id="payment-receipt-email-template"></a>
### Payment Receipt Email Template

The variables listed below can be used in the following fields in System
Settings on the Email tab:

-   **Payment Receipt Email Subject**
-   **Default Payment Receipt Body**

-   **Payment Information**
    -   Payment Date: @{{ $payment-&gt;formatted\_paid\_at }}
    -   Payment Amount: @{{ $payment-&gt;formatted\_amount }}
    -   Payment Note: @{{ $payment-&gt;formatted\_note }}
    -   Payment Method: @{{ $payment-&gt;paymentMethod-&gt;name }}
-   **Invoice Information**
    -   Issue Date: @{{ $payment-&gt;invoice-&gt;formatted\_created\_at
        }}
    -   Due Date: @{{ $payment-&gt;invoice-&gt;formatted\_due\_at }}
    -   Number: @{{ $payment-&gt;invoice-&gt;number }}
    -   Status: @{{ $payment-&gt;invoice-&gt;status\_text }}
    -   Summary: @{{ $payment-&gt;invoice-&gt;summary }}
    -   Public URL: @{{ $payment-&gt;invoice-&gt;public\_url }}
    -   Terms: @{{ $payment-&gt;invoice-&gt;formatted\_terms }}
    -   Footer: @{{ $payment-&gt;invoice-&gt;formatted\_footer }}
    -   Total Amount: @{{
        $payment-&gt;invoice-&gt;amount-&gt;formatted\_total }}
    -   Amount Paid: @{{
        $payment-&gt;invoice-&gt;amount-&gt;formatted\_paid }}
    -   Balance: @{{
        $payment-&gt;invoice-&gt;amount-&gt;formatted\_balance }}
-   **Client Information**
    -   Name: @{{ $payment-&gt;invoice-&gt;client-&gt;name }}
    -   Address: @{{
        $payment-&gt;invoice-&gt;client-&gt;formatted\_address }}
    -   Phone: @{{ $payment-&gt;invoice-&gt;client-&gt;phone }}
    -   Fax: @{{ $payment-&gt;invoice-&gt;client-&gt;fax }}
    -   Mobile: @{{ $payment-&gt;invoice-&gt;client-&gt;mobile }}
    -   Email: @{{ $payment-&gt;invoice-&gt;client-&gt;email }}
    -   Website: @{{ $payment-&gt;invoice-&gt;client-&gt;web }}
-   **User Account Information**
    -   Name: @{{ $payment-&gt;invoice-&gt;user-&gt;name }}
    -   Company: @{{ $payment-&gt;invoice-&gt;companyProfile-&gt;company
        }}
    -   Address: @{{
        $payment-&gt;invoice-&gt;user-&gt;formatted\_address }}
    -   Phone: @{{ $payment-&gt;invoice-&gt;user-&gt;phone }}
    -   Fax: @{{ $payment-&gt;invoice-&gt;user-&gt;fax }}
    -   Mobile: @{{ $payment-&gt;invoice-&gt;user-&gt;mobile }}
    -   Website: @{{ $payment-&gt;invoice-&gt;user-&gt;web }}

Example Subject:

Payment Receipt for Invoice \#@{{ $payment-&gt;invoice-&gt;number }}



Example Body:

&lt;p&gt;Thank you! Your payment of @{{ $payment-&gt;formatted\_amount
}} has been applied to Invoice \#@{{ $payment-&gt;invoice-&gt;number
}}.&lt;/p&gt;
