Quotes
---

---

[How do I create a quote?](#how-do-i-create-a-quote)

[How do I email a quote?](#how-do-i-email-a-quote)

[How do I convert a quote to a workorder or an invoice?](#how-do-i-convert-a-quote-to-a-workorder-or-an-invoice)

[How do I copy a quote?](#how-do-i-copy-a-quote)

[How do I attach files to a quote?](#how-do-i-attach-files-to-a-quote)

---

<a id="how-do-i-create-a-quote"></a>
### How do I create a quote?

Click the Quotes menu item and press the New button.

[<img src="/img/documentation/quote_create_sm.png" class="img-responsive" />](/img/documentation/quote_create.png)

The Create Quote screen will prompt you for the client name, quote date,
company profile and group.

If the quote is for a new client, type the client's name in full. You
will be able to edit the other details for this client record from the
next screen. If the quote is for an existing client, start typing the
client's name and you will be able to select your existing client from
the list that appears.

The date defaults to today's date but can be changed if necessary.

The company profile is where the quote will pull your company name,
address, phone number, and other company specific details from.

The group controls the format of the number assigned to each quote.

Press Submit when done and you'll be taken to the Quote Edit screen.

[<img src="/img/documentation/quote_create2_sm.png" class="img-responsive" />](/img/documentation/quote_create2.png)

The Quote Edit screen is where you'll add line items as well as define
further properties and options for your quote.

**1. Summary**

Entering a brief summary or description of the quote will make the quote
easier to find and search for.

**2. From/To**

The from and to areas display who the quote is issued from and who the
quote is being sent to. If you created the quote with the wrong company
profile selected by mistake, you can easily change that by pressing the
Change button on the From area and choose the correct company profile.
Similarly, if you created the quote with the wrong client selected, you
can easily correct that by pressing the Change button on the To area and
choose the correct client.

**3. Items**

This is where you'll enter each of your line items. Press the Add Item
button to add additional lines for your items or the Add Item From
Lookup button to select multiple items from the ItemLookup table.

**4. Additional, Notes and Attachments**

Terms and conditions as well as text to appear in the footer of your
quote may be entered on the Additional tab. Defaults for these fields
may be set in System Settings on the Quotes tab (default values for
these fields will not appear on quotes already created).

Public or private notes may be entered on the Notes tab. Notes entered
on this tab will be visible to clients viewing the quote using the
public link unless they are marked as private. Clients may leave notes
on a quote when viewing the quote using the public link as well.

File attachments may be uploaded to a quote on the Attachments tab. See
[How do I attach files to a quote?](#how-do-i-attach-files-to-a-quote) for details.

**5. Options**

A number of other options and values are defined in the options area.

-   Quote \# - This is generated according to the group selected when
    the quote was created.
-   Date - The date the quote was issued.
-   Expires - The date the price reflected on the quote expires.
-   Discount - A percentage based discount can be applied to the quote.
-   Currency - The currency the quote will be issued in. The default
    currency can be changed on both the client record and in System
    Settings. If the client record has a different currency than System
    Settings, the currency on the client record will override System
    Settings.
-   Exchange Rate - If a currency other than your base currency is
    selected, the exchange rate will automatically update itself based
    on the current rate. For this to function you must have an API Key configured in System Settings.
-   Status - The current status of the quote. Once a quote has been
    emailed, the status will automatically update itself to Sent. If a
    client has accepted or rejected a quote from the public quote link,
    it will update itself to the appropriate status.
-   Template - This is the template the quote will use when viewed using
    the public link or when generating the quote PDF. The default
    template can be changed on both the client record and in System
    Settings. If the client record has a different default template than
    System Settings, the client record will override System Settings.
    This behavior allows you use a specific template as default for most
    of your quotes while specifying a different template for a
    particular client or clients.

[<img src="/img/documentation/quote_edit_sm.png" class="img-responsive" />](/img/documentation/quote_edit.png)

---

<a id="how-do-i-email-a-quote"></a>
### How do I email a quote?

Press the Email button from the Quotes table Options -> Email or the
Quote Edit screen.

\* Note that the Email button will not appear unless you have configured
your email settings in System Settings on the Email tab.

[<img src="/img/documentation/quote_email_sm.png" class="img-responsive" />](/img/documentation/quote_email.png)

The Email Quote screen allows you to add additional recipients, change
the subject and / or body, if necessary.

Press the Send button to send the email.

[<img src="/img/documentation/quote_email2_sm.png" class="img-responsive" />](/img/documentation/quote_email2.png)

---

<a id="how-do-i-convert-a-quote-to-a-workorder-or-an-invoice"></a>
### How do I convert a quote to a workorder or an invoice?

Once a client has accepted your quote, you can convert it to a workorder
or an invoice on the Quote Edit screen by clicking the Options button
and choosing Quote to Workorder or Quote to Invoice.

[<img src="/img/documentation/quote_to_invoice_sm.png" class="img-responsive" />](/img/documentation/quote_to_invoice.png)

Review the date and group, adjust if necessary and press the Submit
button. Once submitted, you will be taken to the Invoice Edit screen for
the new invoice.

[<img src="/img/documentation/quote_to_invoice2_sm.png" class="img-responsive" />](/img/documentation/quote_to_invoice2.png)

---

<a id="how-do-i-copy-a-quote"></a>
### How do I copy a quote?

Press the Other button and choose Copy from the Quote Edit screen.

[<img src="/img/documentation/quote_copy_sm.png" class="img-responsive" />](/img/documentation/quote_copy.png)

Change the client's name if the copy will be for a different client.

Review the date, company profile, and group. Change if necessary.

Press the Submit button to complete the copy.

[<img src="/img/documentation/quote_copy2_sm.png" class="img-responsive" />](/img/documentation/quote_copy2.png)

---

<a id="how-do-i-attach-files-to-a-quote"></a>
### How do I attach files to a quote?

Files of any type may be uploaded as an attachment to a quote by
clicking the Attachments tab on the Quote Edit screen and pressing the
Attach File button.

The Client Visibility option may be adjusted for each file attachment to
determine whether or not the client should be able to access and
download the attachment when viewing the quote public link. The
following Client Visibility options are available for quote attachments:

-   Visible - Clients will be able to access this attachment from the
    quote public link.
-   Not Visible - Clients will not be able to access this attachment
    from the quote public link.

\* Note that attachments uploaded to a quote do not "attach" themselves
to the quote PDF output. Quote attachments are intended to provide an
easy way to deliver digital assets related to a quote to your clients
(or just to store related files for your own purposes).

[<img src="/img/documentation/quote_attachments_sm.png" class="img-responsive" />](/img/documentation/quote_attachments.png)
