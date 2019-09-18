Importing Data
---

---

[Requirements](#requirements)

[File Layouts](#file-layouts)

[Importing Files](#importing-files)

---

<a id="requirements"></a>
### Requirements

-   All files must be saved in text .csv format.
-   The columns must be separated by commas.
-   All files must have the column names as the first row of the file.
-   Any column value which contains a comma must be enclosed in quotes.
-   Any column which imports a date should contain the dates formatted
    as yyyy-mm-dd.

---

<a id="file-layouts"></a>
### File Layouts

#### Clients

Required columns: name

Optional columns: unique\_name, address, city, state, zip, country,
phone, fax, mobile, email, web, any custom client fields

#### Quotes

Required columns: date, company\_profile, client\_name, quote\_number

Optional columns: group, date\_expires, summary, terms

Notes

-   If the client\_name finds a matching client already in the system,
    it will attach the quote to that client record. If it does not find
    a matching client, it will create a new client record to attach the
    quote to.
-   The company\_profile column should contain the name of the company
    profile to attach the record to.
-   If used, group column value should match an existing Group name. If
    this column is excluded or if it contains a non-matching value, the
    default group will be assigned to the quote.

#### Quote Items

Required columns: quote\_number, name, quantity, price

Optional columns: description, tax\_1, tax\_2

Notes

-   The value in the quote\_number column must match an existing quote
    already in the system. If it does not, the record will not be
    imported.
-   The value in the price column should be formatted using a . as the
    decimal.
-   The company\_profile column should contain the name of the company
    profile to attach the record to.
-   If used, the value in the tax\_1 and tax\_2 columns should match the
    name (not percent) of an existing tax rate already in the system. If
    it does not, no tax rate will be assigned to the item.

#### Invoices

Required columns: date, company\_profile, client\_name, invoice\_number

Optional columns: group, due\_date, summary, terms

Notes

-   If the client\_name finds a matching client already in the system,
    it will attach the invoice to that client record. If it does not
    find a matching client, it will create a new client record to attach
    the invoice to.
-   If used, group column value should match an existing Group name. If
    this column is excluded or if it contains a non-matching value, the
    default group will be assigned to the invoice.

#### Invoice Items

Required columns: invoice\_number, name, quantity, price

Optional columns: description, tax\_1, tax\_2

Notes

-   The value in the invoice\_number column must match an existing
    invoice already in the system. If it does not, the record will not
    be imported.
-   The value in the price column should be formatted using a . as the
    decimal.
-   If used, the value in the tax\_1 and tax\_2 columns should match the
    name (not percent) of an existing tax rate already in the system. If
    it does not, no tax rate will be assigned to the item.

#### Payments

Required columns: client\_id, date, invoice\_number, amount,
payment\_method

Optional columns: note

Notes

-   The value in the client\_id column must match an existing client
    already in the system. If it does not, the record will not be
    imported.
-   The value in the invoice\_number column must match an existing
    invoice already in the system. If it does not, the record will not
    be imported.
-   The value in the amount column should be formatted using a . as the
    decimal.
-   If the payment method value matches the name of an existing payment
    method already in the system, it will link itself to the existing
    payment method. Otherwise, it will create a new payment method
    record to link to.

#### Item Lookups

Required columns: name, description, price, tax\_1, tax\_2

Optional columns: There are no optional columns for item lookups

Notes

-   The value in the price column should be formatted using a . as the
    decimal.
-   If used, the value in the tax\_1 and tax\_2 columns should match the
    name (not percent) of an existing tax rate already in the system. If
    it does not, no tax rate will be assigned to the item.

---

<a id="importing-files"></a>
### Importing Files

Once you have the files ready to be imported:

1.  Go to System -&gt; Import Data.
2.  Choose the type of records to import, select the file to be imported
    and press the Submit button.
3.  Map each of the required fields (indicated with a \*).
4.  If applicable, map each of the optional fields to be imported as
    well.
5.  Press the Submit button to import the records.
6.  Repeat the steps until all the files have been imported.
