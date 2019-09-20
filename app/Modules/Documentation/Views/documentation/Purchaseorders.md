Purchaseorders
---

---

[How do I create a purchaseorder?](#how-do-i-create-a-purchaseorder)

[How do I email a purchaseorder?](#how-do-i-email-a-purchaseorder)

[How do I receive a purchaseorder?](#how-do-i-receive-a-purchaseorder)

[How do I copy a purchaseorder?](#how-do-i-copy-a-purchaseorder)

[How do I attach files to a purchaseorder?](#how-do-i-attach-files-to-a-purchaseorder)

---

<a id="how-do-i-create-a-purchaseorder"></a>
### How do I create a purchaseorder?

Click the Purchaseorders menu item and press the New button.

[<img src="/img/documentation/purchaseorder_create_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_create.png)

The Create Purchaseorder screen will prompt you for the vendor name,
purchaseorder date, company profile and group.

If the purchaseorder is for a new vendor, type the vendor's name in
full. You will be able to edit the other details for this vendor record
from the next screen. If the purchaseorder is for an existing vendor,
start typing the vendor's name and you will be able to select your
existing vendor from the list that appears.

The date defaults to today's date but can be changed if necessary.

The company profile is where the purchaseorder will pull your company name,
address, phone number, and other company specific details from.

The group controls the format of the number assigned to each purchaseorder.

Press Submit when done and you'll be taken to the Purchaseorder Edit screen.

[<img src="/img/documentation/purchaseorder_create2_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_create2.png)

The Purchaseorder Edit screen is where you'll add line items as well as define
further properties and options for your purchaseorder.

**1. Summary**

Entering a brief summary or description of the purchaseorder will make the
purchaseorder easier to find and search for.

**2. From/Ship To/To**

The from, shipto and to areas display who the purchaseorder is issued
from and who the purchaseorder is being sent to. If you created the
purchaseorder with the wrong company profile selected by mistake, you
can easily change that by pressing the Change button on the From area
and choose the correct company profile. Similarly, if you created the
purchaseorder with the wrong vendor selected, you can easily correct
that by pressing the Change button on the To area and choose the correct
vendor.

**3. Items**

This is where you'll enter each of your line items. Press the Add Item
button to add additional lines for your items or the Add Item From
Lookup button to select multiple items from the ItemLookup table. With
Add Item From Products, there is a checkbox which allows only the
display of products with the current purchaseorder vendor listed as
"preferred".

**4. Additional, Notes, Attachments and Payments Tabs**

Terms and conditions as well as text to appear in the footer of your
purchaseorder may be entered on the Additional tab. Defaults for these fields
may be set in System Settings on the Purchaseorders tab (default values for
these fields will not appear on purchaseorders already created).

Public or private notes may be entered on the Notes tab. Notes entered
on this tab will be visible to vendors viewing the purchaseorder using the
public link unless they are marked as private. vendors may leave notes
on a purchaseorder when viewing the purchaseorder using the public link as well.

File attachments may be uploaded to a purchaseorder on the Attachments tab.
See [How do I attach files to a purchaseorder?](#how-do-i-attach-files-to-a-purchaseorder) for
details.

**5. Options**

A number of other options and values are defined in the options area.

-   Purchaseorder \# - This is generated according to the group selected when
    the purchaseorder was created.
-   Date - The date the purchaseorder was issued.
-   Due Date - The date payment on the purchaseorder is due.
-   Discount - A percentage based discount can be applied to the
    purchaseorder.
-   Currency - The currency the purchaseorder will be issued and paid in. The
    default currency can be changed on both the vendor record and in
    System Settings. If the vendor record has a different currency than
    System Settings, the currency on the vendor record will override
    System Settings.
-   Exchange Rate - If a currency other than your base currency is
    selected, the exchange rate will automatically update itself based
    on the current rate. For this to function you must have an API Key configured in System Settings.
-   Status - The current status of the purchaseorder. Once a purchaseorder has been
    emailed, the status will automatically update itself to Sent. Once
    a purchaseorder has been paid in full, the status will automatically
    update itself to Paid. If you have printed a purchaseorder for delivery,
    you can manually change the status to Sent.
-   Template - This is the template the purchaseorder will use when viewed
    using the public link or when generating the purchaseorder PDF. The
    default template can be changed on both the vendor record and in
    System Settings. If the vendor record has a different default
    template than System Settings, the vendor record will override
    System Settings. This behavior allows you use a specific template as
    default for most of your purchaseorders while specifying a different
    template for a particular vendor or vendors.

[<img src="/img/documentation/purchaseorder_edit_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_edit.png)

---

<a id="how-do-i-email-a-purchaseorder"></a>
### How do I email a purchaseorder?

Select email from the options button on the Purchaseorder table view or
press the Email button from the Purchaseorder Edit screen.

\* Note that the Email button will not appear unless you have configured
your email settings in System Settings on the Email tab.

[<img src="/img/documentation/purchaseorder_email_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_email.png)

The Email Purchaseorder screen allows you to add additional recipients, change
the subject and / or body, if necessary.

Press the Send button to send the email.

[<img src="/img/documentation/purchaseorder_email2_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_email2.png)

---

<a id="how-do-i-receive-a-purchaseorder"></a>
### How do I receive a purchaseorder?

Purchaseorder items may be recceived either by selecting receive from
the options button in the Purchaseorder table view or the Purchaseorder
Edit screen by pressing the Other button and choosing Receive.

[<img src="/img/documentation/purchaseorder_receive_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_receive.png)

The receive dialog will show the items on the purchaseorder, their
received status, ordered quantity and ordered cost. Enter the received
quantity and cost.

If "Update Product Table Quantity and cost" is checked, the product
table quantity for the item will be incremented and the cost will be
changed.

If item quantity was over/under received compared to original order
quantity, this will be adjusted appropriately and the item status will
be adjusted to a correct status (Unprocessed, Received, Partial).

Press the Submit button and the received information will be submitted
for the purchaseorder.

[<img src="/img/documentation/purchaseorder_receive2_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_receive2.png)

---

<a id="how-do-i-copy-a-purchaseorder"></a>
### How do I copy a purchaseorder?

Press the Other button and choose Copy from the Purchaseorder Edit screen.

[<img src="/img/documentation/purchaseorder_copy_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_copy.png)

Change the vendor's name if the copy will be for a different vendor.

Review the date, company profile, and group. Change if necessary.

Press the Submit button to complete the copy.

[<img src="/img/documentation/purchaseorder_copy2_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_copy2.png)

---

<a id="how-do-i-attach-files-to-a-purchaseorder"></a>
### How do I attach files to a purchaseorder?

Files of any type may be uploaded as an attachment to a purchaseorder by
clicking the Attachments tab on the Purchaseorder Edit screen and pressing the
Attach File button.

The vendor Visibility option may be adjusted for each file attachment to
determine whether or not the vendor should be able to access and
download the attachment when viewing the purchaseorder public link. The
following vendor Visibility options are available for purchaseorder
attachments:

-   Visible - vendors will be able to access this attachment from the
    purchaseorder public link.
-   Not Visible - vendors will not be able to access this attachment
    from the purchaseorder public link.
-   Visible After Payment - vendors will be able to access this
    attachment from the purchaseorder public link only after the purchaseorder has
    been paid in full.

\* Note that attachments uploaded to a purchaseorder do not "attach"
themselves to the purchaseorder PDF output. Purchaseorder attachments are intended
to provide an easy way to deliver digital assets related to a purchaseorder
to your vendors (or just to store related files for your own purposes).

[<img src="/img/documentation/purchaseorder_attachments_sm.png" class="img-responsive" />](/img/documentation/purchaseorder_attachments.png)
