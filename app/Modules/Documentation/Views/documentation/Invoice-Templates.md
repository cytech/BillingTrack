Invoice Templates
---

---

[How do I customize my invoice or quote templates?](#how-do-i-customize-my-invoice-or-quote-templates)

[How do I make custom fields appear on my invoices or quotes?](#how-do-i-make-custom-fields-appear-on-my-invoices-or-quotes)

[How can I change the size of my logo on invoice and quote templates?](#how-can-i-change-the-size-of-my-logo-on-invoice-and-quote-templates)

---

<a id="how-do-i-customize-my-invoice-or-quote-templates"></a>
### How do I customize my invoice or quote templates?

BillingTrack comes with a copy of the default template placed in the
custom templates folder out of the box. This provides you with a
convenient way to start customizing your invoice layout should you wish
to. All custom templates should be placed in either
custom/templates/invoice\_templates or
custom/templates/quote\_templates.

Copies of the default templates are available at the following locations
to use as starting points:

custom/templates/invoice\_templates/custom.blade.php
custom/templates/quote\_templates/custom.blade.php

A few notes about templates:

-   All custom templates should be named with a .blade.php file
    extension.
-   The default custom.blade.php files can be edited directly or copied
    into a new file with a different name.
-   The default custom.blade.php files are provided as a starting point
    for structure and variable reference.
-   The custom folder is safe from being overwritten during updates as
    per the [update documentation](Upgrade.md).
-   BillingTrack uses Laravel's [Blade templating
    engine](https://laravel.com/docs/6.0/blade).
-   There is no limit to how many custom templates you may have.

---

<a id="how-do-i-make-custom-fields-appear-on-my-invoices-or-quotes"></a>
### How do I make custom fields appear on my invoices or quotes?

Custom fields won't display by default on the PDF output. However, they
can easily be added to the invoice or quote template PDF output by
customizing the template.

Once a custom field has been created for an invoice, take note of the
value in the "Column Name" column. The system will name these
"column\_1", "column\_2", etc.

In the examples below, you'll replace column\_1 with the column number
for your custom field.

Adding a custom invoice field to an invoice:

`{{ $invoice->custom->column_1 }}`

Adding a custom client field to an invoice:

`{{ $invoice->client->custom->column_1 }}`

Adding a custom quote field to a quote:

`{{ $quote->custom->column_1 }}`

Adding a custom client field to a quote:

`{{ $quote->client->custom->column_1 }}`

---

<a id="how-can-i-change-the-size-of-my-logo-on-invoice-and-quote-templates"></a>
### How can I change the size of my logo on invoice and quote templates?

By default, logos are displayed on the invoice and quote PDF's at the
actual image size. If you'd like to upload your logo at the full, high
resolution size, you can make a quick modification to the custom invoice
and/or quote templates to control the display size. This will oftentimes
help logo images from appearing blurry or pixelated on the PDF's.

The default custom templates are located at:

`custom/templates/invoice_templates/custom.blade.php`

`custom/templates/quote_templates/custom.blade.php`

Open the custom template to modify and change this line:

For invoices:  
`{!! $invoice->companyProfile->logo() !!}`  
For quotes:  
`{!! $quote->companyProfile->logo() !!}`

To this:

For invoices:  
`{!! $invoice->companyProfile->logo(width,
height) !!}`  
For quotes:  
`{!! $quote->companyProfile->logo(width, height) !!}`

For example, to display your logo at a width of 250px by a height of
50px:

For invoices:  
`{!! $invoice->companyProfile->logo(250, 50) !!}`
For quotes:  
`{!! $quote->companyProfile->logo(250, 50) !!}`
