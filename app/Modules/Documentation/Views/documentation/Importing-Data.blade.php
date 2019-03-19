@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Importing Data</h2>

        <hr>

        <p><a href="#requirements">Requirements</a></p>
        <p><a href="#file-layouts">File Layouts</a></p>
        <p><a href="#importing-files">Importing Files</a></p>

        <hr>

        <span class="anchor" id="requirements"></span>
        <h3>Requirements</h3>

        <ul>
            <li>All files must be saved in text .csv format.</li>
            <li>The columns must be separated by commas.</li>
            <li>All files must have the column names as the first row of the file.</li>
            <li>Any column value which contains a comma must be enclosed in quotes.</li>
            <li>Any column which imports a date should contain the dates formatted as yyyy-mm-dd.</li>
        </ul>

        <hr>

        <span class="anchor" id="file-layouts"></span>
        <h3>File Layouts</h3>

        <h4>Clients</h4>

        <p>Required columns: name</p>

        <p>Optional columns: unique_name, address, city, state, zip, country, phone, fax, mobile, email, web, any custom
            client fields</p>

        <h4>Quotes</h4>

        <p>Required columns: date, company_profile, client_name, quote_number</p>

        <p>Optional columns: group, date_expires, summary, terms</p>

        <p>Notes</p>

        <ul>
            <li>
                If the client_name finds a matching client already in the system, it will attach the quote to that
                client
                record. If it does not find a matching client, it will create a new client record to attach the quote
                to.
            </li>
            <li>The company_profile column should contain the name of the company profile to attach the record to.</li>
            <li>
                If used, group column value should match an existing Group name. If this column is excluded or if it
                contains
                a non-matching value, the default group will be assigned to the quote.
            </li>
        </ul>

        <h4>Quote Items</h4>

        <p>Required columns: quote_number, name, quantity, price</p>

        <p>Optional columns: description, tax_1, tax_2</p>

        <p>Notes</p>

        <ul>
            <li>
                The value in the quote_number column must match an existing quote already in the system. If it does not,
                the
                record will not be imported.
            </li>
            <li>The value in the price column should be formatted using a . as the decimal.</li>
            <li>The company_profile column should contain the name of the company profile to attach the record to.</li>
            <li>
                If used, the value in the tax_1 and tax_2 columns should match the name (not percent) of an existing tax
                rate
                already in the system. If it does not, no tax rate will be assigned to the item.
            </li>
        </ul>

        <h4>Invoices</h4>

        <p>Required columns: date, company_profile, client_name, invoice_number</p>

        <p>Optional columns: group, due_date, summary, terms</p>

        <p>Notes</p>

        <ul>
            <li>
                If the client_name finds a matching client already in the system, it will attach the invoice to that
                client
                record. If it does not find a matching client, it will create a new client record to attach the invoice
                to.
            </li>
            <li>
                If used, group column value should match an existing Group name. If this column is excluded or if it
                contains
                a non-matching value, the default group will be assigned to the invoice.
            </li>
        </ul>

        <h4>Invoice Items</h4>

        <p>Required columns: invoice_number, name, quantity, price</p>

        <p>Optional columns: description, tax_1, tax_2</p>

        <p>Notes</p>

        <ul>
            <li>
                The value in the invoice_number column must match an existing invoice already in the system. If it does
                not,
                the record will not be imported.
            </li>
            <li>The value in the price column should be formatted using a . as the decimal.</li>
            <li>
                If used, the value in the tax_1 and tax_2 columns should match the name (not percent) of an existing tax
                rate
                already in the system. If it does not, no tax rate will be assigned to the item.
            </li>
        </ul>

        <h4>Payments</h4>

        <p>Required columns: client_id, date, invoice_number, amount, payment_method</p>

        <p>Optional columns: note</p>

        <p>Notes</p>

        <ul>
            <li>
                The value in the client_id column must match an existing client already in the system. If it does
                not,
                the record will not be imported.
            </li>
            <li>
                The value in the invoice_number column must match an existing invoice already in the system. If it does
                not,
                the record will not be imported.
            </li>
            <li>
                The value in the amount column should be formatted using a . as the decimal.
            </li>
            <li>
                If the payment method value matches the name of an existing payment method already in the system, it
                will link
                itself to the existing payment method. Otherwise, it will create a new payment method record to link to.
            </li>
        </ul>

        <h4>Item Lookups</h4>

        <p>Required columns: name, description, price, tax_1, tax_2</p>

        <p>Optional columns: There are no optional columns for item lookups</p>

        <p>Notes</p>

        <ul>
            <li>The value in the price column should be formatted using a . as the decimal.</li>
            <li>
                If used, the value in the tax_1 and tax_2 columns should match the name (not percent) of an existing tax
                rate
                already in the system. If it does not, no tax rate will be assigned to the item.
            </li>
        </ul>

        <hr>

        <span class="anchor" id="importing-files"></span>
        <h3>Importing Files</h3>

        <p>Once you have the files ready to be imported:</p>

        <ol>
            <li>Go to System -> Import Data.</li>
            <li>Choose the type of records to import, select the file to be imported and press the Submit button.</li>
            <li>Map each of the required fields (indicated with a *).</li>
            <li>If applicable, map each of the optional fields to be imported as well.</li>
            <li>Press the Submit button to import the records.</li>
            <li>Repeat the steps until all the files have been imported.</li>
        </ol>

    </div>

@stop