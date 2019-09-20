Invoices
---

---

[How do I create an invoice?](#how-do-i-create-an-invoice)

[How do I email an invoice?](#how-do-i-email-an-invoice)

[How do I enter a payment?](#how-do-i-enter-a-payment)

[How do I copy an invoice?](#how-do-i-copy-an-invoice)

[How do I attach files to an invoice?](#how-do-i-attach-files-to-an-invoice)

---

<a id="how-do-i-create-an-invoice"></a>
### How do I create an invoice?

Click the Invoices menu item and press the New button.

[<img src="/img/documentation/invoice_create_sm.png" class="img-responsive" />](/img/documentation/invoice_create.png)

The Create Invoice screen will prompt you for the client name, invoice
date, company profile and group.

If the invoice is for a new client, type the client's name in full. You
will be able to edit the other details for this client record from the
next screen. If the invoice is for an existing client, start typing the
client's name and you will be able to select your existing client from
the list that appears.

The date defaults to today's date but can be changed if necessary.

The company profile is where the invoice will pull your company name,
address, phone number, and other company specific details from.

The group controls the format of the number assigned to each invoice.

Press Submit when done and you'll be taken to the Invoice Edit screen.

[<img src="/img/documentation/invoice_create2_sm.png" class="img-responsive" />](/img/documentation/invoice_create2.png)

The Invoice Edit screen is where you'll add line items as well as define
further properties and options for your invoice.

**1. Summary**

Entering a brief summary or description of the invoice will make the
invoice easier to find and search for.

**2. From/To**

The from and to areas display who the invoice is issued from and who the
invoice is being sent to. If you created the invoice with the wrong
company profile selected by mistake, you can easily change that by
pressing the Change button on the From area and choose the correct
company profile. Similarly, if you created the invoice with the wrong
client selected, you can easily correct that by pressing the Change
button on the To area and choose the correct client.

**3. Items**

This is where you'll enter each of your line items. Press the Add Item
button to add additional lines for your items or the Add Item From
Lookup button to select multiple items from the ItemLookup table.

**4. Additional, Notes, Attachments and Payments Tabs**

Terms and conditions as well as text to appear in the footer of your
invoice may be entered on the Additional tab. Defaults for these fields
may be set in System Settings on the Invoices tab (default values for
these fields will not appear on invoices already created).

Public or private notes may be entered on the Notes tab. Notes entered
on this tab will be visible to clients viewing the invoice using the
public link unless they are marked as private. Clients may leave notes
on an invoice when viewing the invoice using the public link as well.

File attachments may be uploaded to an invoice on the Attachments tab.
See [How do I attach files to an invoice?](#how-do-i-attach-files-to-an-invoice) for
details.

**5. Options**

A number of other options and values are defined in the options area.

-   Invoice \# - This is generated according to the group selected when
    the invoice was created.
-   Date - The date the invoice was issued.
-   Due Date - The date payment on the invoice is due.
-   Discount - A percentage based discount can be applied to the
    invoice.
-   Currency - The currency the invoice will be issued and paid in. The
    default currency can be changed on both the client record and in
    System Settings. If the client record has a different currency than
    System Settings, the currency on the client record will override
    System Settings.
-   Exchange Rate - If a currency other than your base currency is
    selected, the exchange rate will automatically update itself based
    on the current rate. For this to function you must have an API Key configured in System Settings.
-   Status - The current status of the invoice. Once an invoice has been
    emailed, the status will automatically update itself to Sent. Once
    an invoice has been paid in full, the status will automatically
    update itself to Paid. If you have printed an invoice for delivery,
    you can manually change the status to Sent.
-   Template - This is the template the invoice will use when viewed
    using the public link or when generating the invoice PDF. The
    default template can be changed on both the client record and in
    System Settings. If the client record has a different default
    template than System Settings, the client record will override
    System Settings. This behavior allows you use a specific template as
    default for most of your invoices while specifying a different
    template for a particular client or clients.

[<img src="/img/documentation/invoice_edit_sm.png" class="img-responsive" />](/img/documentation/invoice_edit.png)

---

<a id="how-do-i-email-an-invoice"></a>
### How do I email an invoice?

Press the Email button from the Invoice Edit screen.

\* Note that the Email button will not appear unless you have configured
your email settings in System Settings on the Email tab.

[<img src="/img/documentation/invoice_email_sm.png" class="img-responsive" />](/img/documentation/invoice_email.png)

The Email Invoice screen allows you to add additional recipients, change
the subject and / or body, if necessary.

Press the Send button to send the email.

[<img src="/img/documentation/invoice_email2_sm.png" class="img-responsive" />](/img/documentation/invoice_email2.png)

---

<a id="how-do-i-enter-a-payment"></a>
### How do I enter a payment?

Payments collected manually can be entered against an invoice from the
Invoices table Options -> Enter Payment or the Invoice Edit screen
by pressing the Other button and choosing Enter Payment.

[<img src="/img/documentation/invoice_enter_payment_sm.png" class="img-responsive" />](/img/documentation/invoice_enter_payment.png)

If the invoice is being paid in full, the amount field will already
contain the full balance amount so you won't have to enter or change
anything. If the payment being made is only a partial payment, adjust
the amount as needed.

The date will default to today's date and can be adjusted if necessary.

Choose the payment method to assign to the payment. Additional payment
methods can be entered in System -&gt; Payment Methods.

A note can be optionally added to the payment.

If you'd like to email the client with an email receipt of payment,
check the Email Payment Receipt box.

Press the Submit button and the payment will be submitted to the
invoice.

[<img src="/img/documentation/invoice_enter_payment2_sm.png" class="img-responsive" />](/img/documentation/invoice_enter_payment2.png)

---

<a id="how-do-i-copy-an-invoice"></a>
### How do I copy an invoice?

Press the Other button and choose Copy from the Invoice Edit screen.

[<img src="/img/documentation/invoice_copy_sm.png" class="img-responsive" />](/img/documentation/invoice_copy.png)

Change the client's name if the copy will be for a different client.

Review the date, company profile, and group. Change if necessary.

Press the Submit button to complete the copy.

[<img src="/img/documentation/invoice_copy2_sm.png" class="img-responsive" />](/img/documentation/invoice_copy2.png)

---

<a id="how-do-i-attach-files-to-an-invoice"></a>
### How do I attach files to an invoice?

Files of any type may be uploaded as an attachment to an invoice by
clicking the Attachments tab on the Invoice Edit screen and pressing the
Attach File button.

The Client Visibility option may be adjusted for each file attachment to
determine whether or not the client should be able to access and
download the attachment when viewing the invoice public link. The
following Client Visibility options are available for invoice
attachments:

-   Visible - Clients will be able to access this attachment from the
    invoice public link.
-   Not Visible - Clients will not be able to access this attachment
    from the invoice public link.
-   Visible After Payment - Clients will be able to access this
    attachment from the invoice public link only after the invoice has
    been paid in full.

\* Note that attachments uploaded to an invoice do not "attach"
themselves to the invoice PDF output. Invoice attachments are intended
to provide an easy way to deliver digital assets related to an invoice
to your clients (or just to store related files for your own purposes).

[<img src="/img/documentation/invoice_attachments_sm.png" class="img-responsive" />](/img/documentation/invoice_attachments.png)
