@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Email Templates</h2>

        <hr>

        <p><a href="#what-are-email-templates">What are email templates?</a></p>
        <p><a href="#quote-email-template">Quote Email Templates</a></p>
        <p><a href="#workorder-email-template">Workorder Email Templates</a></p>
        <p><a href="#invoice-email-template">Invoice Email Templates</a></p>
        <p><a href="#payment-receipt-email-template">Payment Receipt Email Templates</a></p>

        <hr>

        <span class="anchor" id="what-are-email-templates"></span>
        <h3>What are email templates?</h3>

        <p>
            Email templates allow customization of email sent from BillingTrack. The templates are located in System
            Settings
            on the Email tab and can contain HTML and a number of dynamic variables which will be replaced with the
            appropriate
            values when the email is sent.
        </p>

        <hr>

        <span class="anchor" id="quote-email-template"></span>
        <h3>Quote Email Template</h3>

        <p>The variables listed below can be used in the following fields in System Settings on the Email tab:</p>

        <ul>
            <li><strong>Quote Email Subject</strong></li>
            <li><strong>Default Quote Email Body</strong></li>
            <li><strong>Quote Approved Email Body</strong></li>
            <li><strong>Quote Rejected Email Body</strong></li>
        </ul>

        <ul>
            <li><strong>Quote Information</strong>
                <ul>
                    <li>Issue Date: @{{ $quote->formatted_created_at }}</li>
                    <li>Expiration Date: @{{ $quote->formatted_expires_at }}</li>
                    <li>Number: @{{ $quote->number }}</li>
                    <li>Status: @{{ $quote->status_text }}</li>
                    <li>Summary: @{{ $quote->summary }}</li>
                    <li>Public URL: @{{ $quote->public_url }}</li>
                    <li>Terms: @{{ $quote->formatted_terms }}</li>
                    <li>Footer: @{{ $quote->formatted_footer }}</li>
                    <li>Total Amount: @{{ $quote->amount->formatted_total }}</li>
                </ul>
            </li>
            <li><strong>Client Information</strong>
                <ul>
                    <li>Name: @{{ $quote->client->name }}</li>
                    <li>Address: @{{ $quote->client->formatted_address }}</li>
                    <li>Phone: @{{ $quote->client->phone }}</li>
                    <li>Fax: @{{ $quote->client->fax }}</li>
                    <li>Mobile: @{{ $quote->client->mobile }}</li>
                    <li>Email: @{{ $quote->client->email }}</li>
                    <li>Website: @{{ $quote->client->web }}</li>
                </ul>
            </li>
            <li><strong>User Account Information</strong>
                <ul>

                    <li>Name: @{{ $quote->user->name }}</li>
                    <li>Company: @{{ $quote->companyProfile->company }}</li>
                    <li>Address: @{{ $quote->user->formatted_address }}</li>
                    <li>Phone: @{{ $quote->user->phone }}</li>
                    <li>Fax: @{{ $quote->user->fax }}</li>
                    <li>Mobile: @{{ $quote->user->mobile }}</li>
                    <li>Website: @{{ $quote->user->web }}</li>
                </ul>
            </li>
        </ul>

        <p>Example Subject:</p>

        <div class="card card-body bg-light">
            Quote #@{{ $quote-&gt;number }}</div>

        <br>

        <p>Example Body:</p>

        <div class="card card-body bg-light">
            &lt;p&gt;To view your quote from @{{ $quote-&gt;user-&gt;name }}
            for @{{ $quote-&gt;amount-&gt;formatted_total }}, click the link below:&lt;/p&gt;<br/>
            <br/>
            &lt;p&gt;&lt;a href=&quot;@{{ $quote-&gt;public_url }}&quot;&gt;@{{ $quote-&gt;public_url }}&lt;/a&gt;&lt;/p&gt;
        </div>

        <hr>

        <span class="anchor" id="workorder-email-template"></span>
        <h3>Workorder Email Template</h3>

        <p>The variables listed below can be used in the following fields in System Settings on the Email tab:</p>

        <ul>
            <li><strong>Workorder Email Subject</strong></li>
            <li><strong>Default Workorder Email Body</strong></li>
            <li><strong>Workorder Approved Email Body</strong></li>
            <li><strong>Workorder Rejected Email Body</strong></li>
        </ul>

        <ul>
            <li><strong>Workorder Information</strong>
                <ul>
                    <li>Issue Date: @{{ $workorder->formatted_created_at }}</li>
                    <li>Expiration Date: @{{ $workorder->formatted_expires_at }}</li>
                    <li>Number: @{{ $workorder->number }}</li>
                    <li>Status: @{{ $workorder->status_text }}</li>
                    <li>Summary: @{{ $workorder->summary }}</li>
                    <li>Public URL: @{{ $workorder->public_url }}</li>
                    <li>Terms: @{{ $workorder->formatted_terms }}</li>
                    <li>Footer: @{{ $workorder->formatted_footer }}</li>
                    <li>Total Amount: @{{ $workorder->amount->formatted_total }}</li>
                </ul>
            </li>
            <li><strong>Client Information</strong>
                <ul>
                    <li>Name: @{{ $workorder->client->name }}</li>
                    <li>Address: @{{ $workorder->client->formatted_address }}</li>
                    <li>Phone: @{{ $workorder->client->phone }}</li>
                    <li>Fax: @{{ $workorder->client->fax }}</li>
                    <li>Mobile: @{{ $workorder->client->mobile }}</li>
                    <li>Email: @{{ $workorder->client->email }}</li>
                    <li>Website: @{{ $workorder->client->web }}</li>
                </ul>
            </li>
            <li><strong>User Account Information</strong>
                <ul>

                    <li>Name: @{{ $workorder->user->name }}</li>
                    <li>Company: @{{ $workorder->companyProfile->company }}</li>
                    <li>Address: @{{ $workorder->user->formatted_address }}</li>
                    <li>Phone: @{{ $workorder->user->phone }}</li>
                    <li>Fax: @{{ $workorder->user->fax }}</li>
                    <li>Mobile: @{{ $workorder->user->mobile }}</li>
                    <li>Website: @{{ $workorder->user->web }}</li>
                </ul>
            </li>
        </ul>

        <p>Example Subject:</p>

        <div class="card card-body bg-light">
            Workorder #@{{ $workorder-&gt;number }}</div>

        <br>

        <p>Example Body:</p>

        <div class="card card-body bg-light">
            &lt;p&gt;To view your workorder from @{{ $workorder-&gt;user-&gt;name }}
            for @{{ $workorder-&gt;amount-&gt;formatted_total }}, click the link below:&lt;/p&gt;<br/>
            <br/>
            &lt;p&gt;&lt;a href=&quot;@{{ $workorder-&gt;public_url }}&quot;&gt;@{{ $workorder-&gt;public_url }}&lt;/a&gt;&lt;/p&gt;
        </div>

        <hr>

        <span class="anchor" id="invoice-email-template"></span>
        <h3>Invoice Email Template</h3>

        <p>The variables listed below can be used in the following fields in System Settings on the Email tab:</p>

        <ul>
            <li><strong>Invoice Email Subject</strong></li>
            <li><strong>Default Invoice Email Body</strong></li>
            <li><strong>Overdue Email Subject</strong></li>
            <li><strong>Default Overdue Invoice Email Body</strong></li>
            <li><strong>Upcoming Payment Notice Email Subject</strong></li>
            <li><strong>Upcoming Payment Notice Email Body</strong></li>
        </ul>

        <ul>
            <li><strong>Invoice Information</strong>
                <ul>
                    <li>Issue Date: @{{ $invoice->formatted_created_at }}</li>
                    <li>Due Date: @{{ $invoice->formatted_due_at }}</li>
                    <li>Number: @{{ $invoice->number }}</li>
                    <li>Status: @{{ $invoice->status_text }}</li>
                    <li>Summary: @{{ $invoice->summary }}</li>
                    <li>Public URL: @{{ $invoice->public_url }}</li>
                    <li>Terms: @{{ $invoice->formatted_terms }}</li>
                    <li>Footer: @{{ $invoice->formatted_footer }}</li>
                    <li>Total Amount: @{{ $invoice->amount->formatted_total }}</li>
                    <li>Amount Paid: @{{ $invoice->amount->formatted_paid }}</li>
                    <li>Balance: @{{ $invoice->amount->formatted_balance }}</li>
                </ul>
            </li>
            <li><strong>Client Information</strong>
                <ul>
                    <li>Name: @{{ $invoice->client->name }}</li>
                    <li>Address: @{{ $invoice->client->formatted_address }}</li>
                    <li>Phone: @{{ $invoice->client->phone }}</li>
                    <li>Fax: @{{ $invoice->client->fax }}</li>
                    <li>Mobile: @{{ $invoice->client->mobile }}</li>
                    <li>Email: @{{ $invoice->client->email }}</li>
                    <li>Website: @{{ $invoice->client->web }}</li>
                </ul>
            </li>
            <li><strong>User Account Information</strong>
                <ul>
                    <li>Name: @{{ $invoice->user->name }}</li>
                    <li>Company: @{{ $invoice->companyProfile->company }}</li>
                    <li>Address: @{{ $invoice->user->formatted_address }}</li>
                    <li>Phone: @{{ $invoice->user->phone }}</li>
                    <li>Fax: @{{ $invoice->user->fax }}</li>
                    <li>Mobile: @{{ $invoice->user->mobile }}</li>
                    <li>Website: @{{ $invoice->user->web }}</li>
                </ul>
            </li>
        </ul>

        <p>Example Subject:</p>

        <div class="card card-body bg-light">
            Invoice #@{{ $invoice-&gt;number }}</div>

        <br>

        <p>Example Body:</p>

        <div class="card card-body bg-light">
            &lt;p&gt;To view your invoice from @{{ $invoice-&gt;user-&gt;name }}
            for @{{ $invoice-&gt;amount-&gt;formatted_total }}, click the link below:&lt;/p&gt;<br/>
            <br/>
            &lt;p&gt;&lt;a href=&quot;@{{ $invoice-&gt;public_url }}&quot;&gt;@{{ $invoice-&gt;public_url }}&lt;/a&gt;&lt;/p&gt;<br/>
            <br/>
            &lt;p&gt;@{{ $invoice-&gt;user-&gt;formatted_address }}&lt;/p&gt;
        </div>

        <hr>

        <span class="anchor" id="purchaseorder-email-template"></span>
        <h3>Purchaseorder Email Template</h3>

        <p>The variables listed below can be used in the following fields in Purchase Order email settings:</p>

        <ul>
            <li><strong>Purchaseorder Email Subject</strong></li>
            <li><strong>Default Purchaseorder Email Body</strong></li>
        </ul>

        <ul>
            <li><strong>Purchaseorder Information</strong>
                <ul>
                    <li>Issue Date: @{{ $purchaseorder->formatted_created_at }}</li>
                    <li>Expiration Date: @{{ $purchaseorder->formatted_due_at }}</li>
                    <li>Number: @{{ $purchaseorder->number }}</li>
                    <li>Status: @{{ $purchaseorder->status_text }}</li>
                    <li>Summary: @{{ $purchaseorder->summary }}</li>
                    <li>Terms: @{{ $purchaseorder->formatted_terms }}</li>
                    <li>Footer: @{{ $purchaseorder->formatted_footer }}</li>
                    <li>Total Amount: @{{ $purchaseorder->amount->formatted_total }}</li>
                </ul>
            </li>
            <li><strong>Company Information</strong>
                <ul>
                    <li>Company: @{{ $purchaseorder->companyProfile->company }}</li>
                    <li>Address: @{{ $purchaseorder->companyProfile->formatted_address }}</li>
                    <li>Phone: @{{ $purchaseorder->companyProfile->phone }}</li>
                    <li>Fax: @{{ $purchaseorder->companyProfile->fax }}</li>
                    <li>Mobile: @{{ $purchaseorder->companyProfile->mobile }}</li>
                    <li>Email: @{{ $purchaseorder->user->email }}</li>
                    <li>Website: @{{ $purchaseorder->companyProfile->web }}</li>
                </ul>
            </li>
            <li><strong>User Account Information</strong>
                <ul>

                    <li>Name: @{{ $purchaseorder->user->name }}</li>
                    <li>Company: @{{ $purchaseorder->companyProfile->company }}</li>
                    <li>Address: @{{ $purchaseorder->user->formatted_address }}</li>
                    <li>Phone: @{{ $purchaseorder->user->phone }}</li>
                    <li>Fax: @{{ $purchaseorder->user->fax }}</li>
                    <li>Mobile: @{{ $purchaseorder->user->mobile }}</li>
                    <li>Website: @{{ $purchaseorder->user->web }}</li>
                </ul>
            </li>
        </ul>

        <p>Example Subject:</p>

        <div class="card card-body bg-light">
            Purchaseorder #@{{ $purchaseorder-&gt;number }}</div>

        <br>

        <p>Example Body:</p>

        <div class="card card-body bg-light">
            &lt;p&gt;Please find the atached Purchase Order from @{{ $purchaseorder-&gt;companyProfile-&gt;company }}
            for @{{ $purchaseorder-&gt;amount-&gt;formatted_total }}
        </div>

        <hr>

        <span class="anchor" id="payment-receipt-email-template"></span>
        <h3>Payment Receipt Email Template</h3>

        <p>The variables listed below can be used in the following fields in System Settings on the Email tab:</p>

        <ul>
            <li><strong>Payment Receipt Email Subject</strong></li>
            <li><strong>Default Payment Receipt Body</strong></li>
        </ul>

        <ul>
            <li><strong>Payment Information</strong>
                <ul>
                    <li>Payment Date: @{{ $payment->formatted_paid_at }}</li>
                    <li>Payment Amount: @{{ $payment->formatted_amount }}</li>
                    <li>Payment Note: @{{ $payment->formatted_note }}</li>
                    <li>Payment Method: @{{ $payment->paymentMethod->name }}</li>
                </ul>
            </li>
            <li><strong>Invoice Information</strong>
                <ul>
                    <li>Issue Date: @{{ $payment->invoice->formatted_created_at }}</li>
                    <li>Due Date: @{{ $payment->invoice->formatted_due_at }}</li>
                    <li>Number: @{{ $payment->invoice->number }}</li>
                    <li>Status: @{{ $payment->invoice->status_text }}</li>
                    <li>Summary: @{{ $payment->invoice->summary }}</li>
                    <li>Public URL: @{{ $payment->invoice->public_url }}</li>
                    <li>Terms: @{{ $payment->invoice->formatted_terms }}</li>
                    <li>Footer: @{{ $payment->invoice->formatted_footer }}</li>
                    <li>Total Amount: @{{ $payment->invoice->amount->formatted_total }}</li>
                    <li>Amount Paid: @{{ $payment->invoice->amount->formatted_paid }}</li>
                    <li>Balance: @{{ $payment->invoice->amount->formatted_balance }}</li>
                </ul>
            </li>
            <li><strong>Client Information</strong>
                <ul>
                    <li>Name: @{{ $payment->invoice->client->name }}</li>
                    <li>Address: @{{ $payment->invoice->client->formatted_address }}</li>
                    <li>Phone: @{{ $payment->invoice->client->phone }}</li>
                    <li>Fax: @{{ $payment->invoice->client->fax }}</li>
                    <li>Mobile: @{{ $payment->invoice->client->mobile }}</li>
                    <li>Email: @{{ $payment->invoice->client->email }}</li>
                    <li>Website: @{{ $payment->invoice->client->web }}</li>
                </ul>
            </li>
            <li><strong>User Account Information</strong>
                <ul>
                    <li>Name: @{{ $payment->invoice->user->name }}</li>
                    <li>Company: @{{ $payment->invoice->companyProfile->company }}</li>
                    <li>Address: @{{ $payment->invoice->user->formatted_address }}</li>
                    <li>Phone: @{{ $payment->invoice->user->phone }}</li>
                    <li>Fax: @{{ $payment->invoice->user->fax }}</li>
                    <li>Mobile: @{{ $payment->invoice->user->mobile }}</li>
                    <li>Website: @{{ $payment->invoice->user->web }}</li>
                </ul>
            </li>
        </ul>

        <p>Example Subject:</p>

        <div class="card card-body bg-light">
            Payment Receipt for Invoice #@{{ $payment-&gt;invoice-&gt;number }}</div>

        <br>

        <p>Example Body:</p>

        <div class="card card-body bg-light">
            &lt;p&gt;Thank you! Your payment of @{{ $payment-&gt;formatted_amount }} has been applied to Invoice
            #@{{ $payment-&gt;invoice-&gt;number }}.&lt;/p&gt;
        </div>

    </div>

@stop
