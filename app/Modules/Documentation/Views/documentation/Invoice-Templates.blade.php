@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Invoice Templates</h2>

        <hr>

        <p><a href="#customizing-templates">How do I customize my invoice or quote templates?</a></p>
        <p><a href="#adding-custom-fields">How do I make custom fields appear on my invoices or quotes?</a></p>
        <p><a href="#selling-custom-templates">Can I sell my custom templates to other FusionInvoice users?</a></p>
        <p><a href="#changing-logo-display-size">How can I change the size of my logo on invoice and quote
                templates?</a></p>

        <hr>

        <span class="anchor" id="customizing-templates"></span>
        <h3>How do I customize my invoice or quote templates?</h3>

        <p>
            FusionInvoice comes with a copy of the default template placed in the custom templates folder out of the
            box. This
            provides you with a convenient way to start customizing your invoice layout should you wish to. All custom
            templates
            should be placed in either custom/templates/invoice_templates or custom/templates/quote_templates.
        </p>

        <p>Copies of the default templates are available at the following locations to use as starting points:</p>

        <div class="card card-body bg-light">
            custom/templates/invoice_templates/custom.blade.php<br>
            custom/templates/quote_templates/custom.blade.php
        </div>

        <p>A few notes about templates:</p>

        <ul>
            <li>All custom templates should be named with a .blade.php file extension.</li>
            <li>The default custom.blade.php files can be edited directly or copied into a new file with a different
                name.
            </li>
            <li>The default custom.blade.php files are provided as a starting point for structure and variable
                reference.
            </li>
            <li>
                The custom folder is safe from being overwritten during updates as per the
                <a href="Upgrade"> update documentation</a>.
            </li>
            <li>FusionInvoice uses Laravel's <a href="https://laravel.com/docs/5.1/blade"
                                                target="_blank">Blade templating
                    engine</a>.
            </li>
            <li>There is no limit to how many custom templates you may have.</li>
        </ul>

        <hr>

        <span class="anchor" id="adding-custom-fields"></span>
        <h3>How do I make custom fields appear on my invoices or quotes?</h3>

        <p>
            Custom fields won't display by default on the PDF output. However, they can easily be added to the invoice
            or
            quote template PDF output by customizing the template.
        </p>

        <p>
            Once a custom field has been created for an invoice, take note of the value in the "Column Name" column. The
            system
            will name these "column_1", "column_2", etc.
        </p>

        <p style="font-weight: bold;">In the examples below, you'll replace column_1 with the column number for your
            custom
            field.</p>

        <p>Adding a custom invoice field to an invoice:</p>

        <div class="card card-body bg-light">
            @{{ $invoice->custom->column_1 }}
        </div>

        <p>Adding a custom client field to an invoice:</p>

        <div class="card card-body bg-light">
            @{{ $invoice->client->custom->column_1 }}
        </div>

        <p>Adding a custom quote field to a quote:</p>

        <div class="card card-body bg-light">
            @{{ $quote->custom->column_1 }}
        </div>

        <p>Adding a custom client field to a quote:</p>

        <div class="card card-body bg-light">
            @{{ $quote->client->custom->column_1 }}
        </div>

        <hr>


        <hr>

        <span class="anchor" id="changing-logo-display-size"></span>
        <h3>How can I change the size of my logo on invoice and quote templates?</h3>

        <p>
            By default, logos are displayed on the invoice and quote PDF's at the actual image size. If you'd like to
            upload
            your logo at the full, high resolution size, you can make a quick modification to the custom invoice and/or
            quote templates to control the display size. This will oftentimes help logo images from appearing blurry or
            pixelated
            on the PDF's.
        </p>

        <p>The default custom templates are located at:</p>

        <div class="card card-body bg-light">
            custom/templates/invoice_templates/custom.blade.php
            custom/templates/quote_templates/custom.blade.php
        </div>

        <p>Open the custom template to modify and change this line:</p>

        <div class="card card-body bg-light">
            // For invoices:
            @@{!! $invoice->companyProfile->logo() !!}

            // For quotes:
            @{!! $quote->companyProfile->logo() !!}
        </div>

        <p>To this:</p>

        <div class="card card-body bg-light" style="white-space:pre-wrap;">
            // For invoices:
            @{!! $invoice->companyProfile->logo(width, height) !!}

            // For quotes:
            @{!! $quote->companyProfile->logo(width, height) !!}
        </div>

        <p>For example, to display your logo at a width of 250px by a height of 50px:</p>

        <div class="card card-body bg-light" style="white-space:pre-wrap;">
            // For invoices:
            @{!! $invoice->companyProfile->logo(250, 50) !!}

            // For quotes:
            @{!! $quote->companyProfile->logo(250, 50) !!}
        </div>

    </div>

@stop