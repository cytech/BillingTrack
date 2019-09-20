Workorders
---

---

[How do I create a workorder?](#how-do-i-create-a-workorder)

[How do I email a workorder?](#how-do-i-email-a-workorder)

[How do I convert a workorder to an invoice?](#how-do-i-convert-a-workorder-to-an-invoice)

[How do I copy a workorder?](#how-do-i-copy-a-workorder)

[How do I attach files to a workorder?](#how-do-i-attach-files-to-a-workorder)

---

<a id="how-do-i-create-a-workorder"></a>
### How do I create a workorder?

Click the Workorders menu item and press the New button.

[<img src="/img/documentation/workorder_create_sm.png" class="img-responsive" />](/img/documentation/workorder_create.png)

The Create Workorder screen will prompt you for the client name,
workorder date, company profile and group.

If the workorder is for a new client, type the client's name in full.
You will be able to edit the other details for this client record from
the next screen. If the workorder is for an existing client, start
typing the client's name and you will be able to select your existing
client from the list that appears.

The date defaults to today's date but can be changed if necessary.

The company profile is where the workorder will pull your company name,
address, phone number, and other company specific details from.

The group controls the format of the number assigned to each workorder.

Press Submit when done and you'll be taken to the Workorder Edit screen.

[<img src="/img/documentation/workorder_create2_sm.png" class="img-responsive" />](/img/documentation/workorder_create2.png)

The Workorder Edit screen is where you'll add line items as well as
define further properties and options for your workorder.

**1. Summary**

Entering a brief summary or description of the workorder will make the
workorder easier to find and search for.

**2. From/To**

The from and to areas display who the workorder is issued from and who
the workorder is being sent to. If you created the workorder with the
wrong company profile selected by mistake, you can easily change that by
pressing the Change button on the From area and choose the correct
company profile. Similarly, if you created the workorder with the wrong
client selected, you can easily correct that by pressing the Change
button on the To area and choose the correct client.

**3. Items**

This is where you'll enter each of your line items. Press the Add Item
button to add additional lines for your items.

**4. Additional, Notes and Attachments**

Terms and conditions as well as text to appear in the footer of your
workorder may be entered on the Additional tab. Defaults for these
fields may be set in System Settings on the Workorders tab (default
values for these fields will not appear on workorders already created).

Public or private notes may be entered on the Notes tab. Notes entered
on this tab will be visible to clients viewing the workorder using the
public link unless they are marked as private. Clients may leave notes
on a workorder when viewing the workorder using the public link as well.

File attachments may be uploaded to a workorder on the Attachments tab.
See [How do I attach files to a workorder?](#how-do-i-attach-files-to-a-workorder) for
details.

**5. Options**

A number of other options and values are defined in the options area.

-   Job Date - The calendar date for the actual workorder job
-   Start Time - Job start time
-   End Time - Job end time
-   Will Call - Arbitrary tag that can be used for client pickup, etc.
-   Workorder \# - This is generated according to the group selected
    when the workorder was created.
-   Date - The date the workorder was issued.
-   Expires - The date the price reflected on the workorder expires.
-   Discount - A percentage based discount can be applied to the
    workorder.
-   Currency - The currency the workorder will be issued in. The default
    currency can be changed on both the client record and in System
    Settings. If the client record has a different currency than System
    Settings, the currency on the client record will override System
    Settings.
-   Exchange Rate - If a currency other than your base currency is
    selected, the exchange rate will automatically update itself based
    on the current rate. For this to function you must have an API Key configured in System Settings.
-   Status - The current status of the workorder. Once a workorder has
    been emailed, the status will automatically update itself to Sent.
    If a client has accepted or rejected a workorder from the public
    workorder link, it will update itself to the appropriate status.
-   Template - This is the template the workorder will use when viewed
    using the public link or when generating the workorder PDF. The
    default template can be changed on both the client record and in
    System Settings. If the client record has a different default
    template than System Settings, the client record will override
    System Settings. This behavior allows you use a specific template as
    default for most of your workorders while specifying a different
    template for a particular client or clients.

[<img src="/img/documentation/workorder_edit_sm.png" class="img-responsive" />](/img/documentation/workorder_edit.png)

---

<a id="how-do-i-email-a-workorder"></a>
### How do I email a workorder?

Workorders are not designed to be emailed to customers. They are
generally an in-house document.

---

<a id="how-do-i-convert-a-workorder-to-an-invoice"></a>
### How do I convert a workorder to an invoice?

Once a workorder has been completed, you can convert it to an invoice on
the Workorder Edit screen by clicking the Options button and choosing
Workorder to Invoice.

[<img src="/img/documentation/workorder_to_invoice_sm.png" class="img-responsive" />](/img/documentation/workorder_to_invoice.png)

Review the date and group, adjust if necessary and press the Submit
button. Once submitted, you will be taken to the Invoice Edit screen for
the new invoice.

[<img src="/img/documentation/workorder_to_invoice2_sm.png" class="img-responsive" />](/img/documentation/workorder_to_invoice2.png)

---

<a id="how-do-i-copy-a-workorder"></a>
### How do I copy a workorder?

Press the Other button and choose Copy from the Workorder Edit screen.

[<img src="/img/documentation/workorder_copy_sm.png" class="img-responsive" />](/img/documentation/workorder_copy.png)

Change the client's name if the copy will be for a different client.

Review the date, company profile, and group. Change if necessary.

Press the Submit button to complete the copy.

[<img src="/img/documentation/workorder_copy2_sm.png" class="img-responsive" />](/img/documentation/workorder_copy2.png)

---

<a id="how-do-i-attach-files-to-a-workorder"></a>
### How do I attach files to a workorder?

Files of any type may be uploaded as an attachment to a workorder by
clicking the Attachments tab on the Workorder Edit screen and pressing
the Attach File button.

The Client Visibility option may be adjusted for each file attachment to
determine whether or not the client should be able to access and
download the attachment when viewing the workorder public link. The
following Client Visibility options are available for workorder
attachments:

-   Visible - Clients will be able to access this attachment from the
    workorder public link.
-   Not Visible - Clients will not be able to access this attachment
    from the workorder public link.

\* Note that attachments uploaded to a workorder do not "attach"
themselves to the workorder PDF output. Workorder attachments are
intended to provide an easy way to deliver digital assets related to a
workorder to your clients (or just to store related files for your own
purposes).

[<img src="/img/documentation/workorder_attachments_sm.png" class="img-responsive" />](/img/documentation/workorder_attachments.png)
