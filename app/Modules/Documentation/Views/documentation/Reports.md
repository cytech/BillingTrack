Reports
---

---

[Client Statement Report](#client-statement-report)

[Expense List Report](#expense-list-report)

[Item Sales Report](#item-sales-report)

[Payments Collected Report](#payments-collected-report)

[Profit and Loss Report](#profit-and-loss-report)

[Revenue by Client Report](#revenue-by-client-report)

[Tax Summary Report](#tax-summary-report)

[Time Tracking Report](#time-tracking-report)

[Timesheet Report](#timesheet-report)

---

<a id="client-statement-report"></a>
### Client Statement Report
---
<a id="expense-list-report"></a>
### Expense List Report
---
<a id="item-sales-report"></a>
### Item Sales Report
---
<a id="payments-collected-report"></a>
### Payments Collected Report
---
<a id="profit-and-loss-report"></a>
### Profit and Loss Report
---
<a id="revenue-by-client-report"></a>
### Revenue by Client Report
---
<a id="tax-summary-report"></a>
### Tax Summary Report
---
<a id="time-tracking-report"></a>
### Time Tracking Report
---
<a id="timesheet-report"></a>
### Timesheet Report
---
This generates a timesheet in the daterange specified including the
company profile specified.

The data is generated from:

-   Invoices created from Workorders (Workorder to Invoice).
-   Workorder Employees on the invoiced workorders and their time
    invoiced.

**Preview**:

Generates a preview table of results

**PDF**:

Generates a PDF table of results

**Export to Quickbooks Timer:**

Generates an IIF file that Quickbooks Desktop can import
(Quickbooks-File-Utilities-Import-Timer Activities)

-   **Caveats**:
-   Employee name in Workorder Employee MUST exactly match employee name
    in Quickbooks.
-   Employee in Quickbooks MUST be assigned to “Hourly Wage” payroll
    item.
-   Only exports to a single Quickbooks Company.
-   **TO Configure:**
-   In order to transfer time from Workorders TimeSheet to QuickBooks
    using IIF files, you need to know the Company name and create time.
    This information needs to be entered in the System Settings -
    Workorder tab. To find this information in QuickBooks follow the
    steps below,
-   Open Quickbooks
-   Goto File-Utilities-Export-Timer List.
-   Save the file to a location.
-   Open the file in Notepad.
-   COMPANYNAME can be found as the fourth entry on the headers on the
    first row. The corresponding value on the row beneath it is the
    COMPANYNAME.
-   COMPANYCREATETIME can be found as the last entry on the headers on
    the first row. The corresponding value on the row beneath it is the
    COMPANYCREATETIME.
-   **Example**:
-   !TIMERHDR VER REL COMPANYNAME IMPORTEDBEFORE FROMTIMER
    COMPANYCREATETIME
-   TIMERHDR 8 0 **YOURCOMPANYNAME** N Y **123456789**
-   Once you have this information, goto System Settings - Workorder tab
    and enter the information in the appropriate text boxes (at bottom
    of page) and Save.
