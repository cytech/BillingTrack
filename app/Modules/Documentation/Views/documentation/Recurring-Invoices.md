Recurring Invoices
---

---

[How do recurring invoices work?](#how-do-recurring-invoices-work)

[How do I create a recurring invoice?](#how-do-i-create-a-recurring-invoice)

[How do I copy a recurring invoice?](#how-do-i-copy-a-recurring-invoice)

---

<a id="how-do-recurring-invoices-work"></a>
### How do recurring invoices work?

Recurring invoices act as a template for invoices which need to be
generated on a specific frequency (once a month, twice a year, etc).
Other than the fact that recurring invoices aren't sent directly to a
client (the generated invoice is) and payments aren't made against a
recurring invoice (payments are made against the generated invoice),
recurring invoices are almost identical to invoices.

Once a recurring invoice has been created, the [Task
Scheduler](Task-Scheduler.md) will cycle through each day and check for any
recurring invoices which are due to generate invoices from. Any
recurring invoices which are due to be generated will be. Depending on
the "Automatically email recurring invoices" setting in System Settings
on the Invoices tab, the generated invoice will email itself to the
client.

\* Note the [Task Scheduler](Task-Scheduler.md) needs to be set up before
any recurring invoices will actually generate.

---

<a id="how-do-i-create-a-recurring-invoice"></a>
### How do I create a recurring invoice?

Click the Recurring Invoices menu item and press the New button.

[<img src="/img/documentation/recurring_invoice_create_sm.png" class="img-responsive" />](/img/documentation/recurring_invoice_create.png)

The Create Recurring Invoice screen will prompt you for the client name,
company profile, group, start date and frequency.

If the recurring invoice is for a new client, type the client's name in
full. You will be able to edit the other details for this client record
from the next screen. If the recurring invoice is for an existing
client, start typing the client's name and you will be able to select
your existing client from the list that appears.

The company profile is where the recurring invoice will pull your
company name, address, phone number, and other company specific details
from.

The group controls the format of the number assigned to each generated
invoice.

Set the start date to the date the invoice should first be generated.

Set the frequency for the invoice.

Press Submit when done and you'll be taken to the Recurring Invoice Edit
screen.

[<img src="/img/documentation/recurring_invoice_create2_sm.png" class="img-responsive" />](/img/documentation/recurring_invoice_create2.png)

The Recurring Invoice Edit screen is where you'll add line items as well
as define further properties and options for your recurring invoice.

**1. Summary**

Entering a brief summary or description of the recurring invoice will
make it to find and search for.

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
button to add additional lines for your items.

**4. Additional Tab**

Terms and conditions as well as text to appear in the footer of your
invoice may be entered on the Additional tab. Defaults for these fields
may be set in System Settings on the Invoices tab (default values for
these fields will not appear on recurring invoices already created).

**5. Options**

A number of other options and values are defined in the options area.

-   Next Date - The date the next invoice will be generated.
-   Every - The frequency in which the invoice will generate.
-   Stop Date - If invoices should generate up to a specific date and
    stop afterward, the stop date can be entered.
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
-   Template - This is the template the invoice will use when viewed
    using the public link or when generating the invoice PDF. The
    default template can be changed on both the client record and in
    System Settings. If the client record has a different default
    template than System Settings, the client record will override
    System Settings. This behavior allows you use a specific template as
    default for most of your invoices while specifying a different
    template for a particular client or clients.

[<img src="/img/documentation/recurring_invoice_edit_sm.png" class="img-responsive" />](/img/documentation/recurring_invoice_edit.png)

---

<a id="how-do-i-copy-a-recurring-invoice"></a>
### How do I copy a recurring invoice?

Press the Other button and choose Copy from the Invoice Edit screen.

[<img src="/img/documentation/recurring_invoice_copy_sm.png" class="img-responsive" />](/img/documentation/recurring_invoice_copy.png)

Change the client's name if the copy will be for a different client.

Review the date, company profile, group, start date and frequency.
Change if necessary.

Press the Submit button to complete the copy.

[<img src="/img/documentation/recurring_invoice_copy2_sm.png" class="img-responsive" />](/img/documentation/recurring_invoice_copy2.png)
