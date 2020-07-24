Scheduler
---

---

Creation of a FullCalendar Schedule. Events and recurring events can be
created and edited with categories and reminders. Core Events (Quotes,
Workorders, Invoices, etc.) can be shown via the system settings -
Scheduler tab

**Dashboard**

Shows a quick look at the status of events.

**Calendar**

An event is a calendar entry. An event may be created by clicking in a
day cell. A reminder (or multiple reminders) can be created with the
event.

An event can be edited by clicking on the existing event.

If the event was created by a core event (quote, workorder, invoice,
etc.), clicking on the event will take you to the assigned document.

If the event is a recurring event , you will be taken to the edit page
of the selected recurring event.

**Schedule**

This page shows all scheduled/unscheduled employees and resources from Workorders.
You can page forward and backward four days at a time.
If "Create Workorder" functionality is enabled, you can select the icon to create
a new workorder for the specific date.

**Create Workorder Icon**

When enabled in Scheduler settings, This will launch a dialog to
populate for an automatic Workorder creation. Customer will do a
typeahead lookup of the BillingTrack client database (same rules apply
as workorder creation in BillingTrack). Only Available Employees and
Products/Resources (un-scheduled) for the day are shown in the item selection.
THIS ONLY TAKES INTO EFFECT SCHEDULED EMPLOYEES AND ITEMS FOR THE ENTIRE
DAY. It does not look at time slots during the day. Products/Resources are
calculated against the number in inventory and the products/resources scheduled
for the day. When all selections are made, select CREATE WORKORDER and
the information will be send to BillingTrack and create an approved
workorder containing all the information. Note: If a NEW client name is
entered, you will be taken to the workorder after create to edit the
client information.

**Create Event**

Event creation outside the calendar view

**Event Table**

Shows and allows editing and creating of events in a table format. You
can also “trash” an event here

**Recurring Event**

Edit or Create a recurring event. This can be very complex. Hover over
the Set Recurrence labels for explanations of how they work. “Show
proposed recurrence” button will attempt to give you a Human readable
text of your selected recurrence rule. This text does not currently
include additions to the Position, MonthDay, Yearday or Weeknumber
fields.

A reminder (or reminders) may be assign to recurrent events.

**Utilities**
- Categories

> Allows setup and editing of categories for assignment in calendar.
> Categories 1 thru 10 are system categories and cannot be deleted
> (although they can be edited). You may add new categories which can be
> deleted IF they are not assigned to an event.

- Orphan Check

>This checks for employees who are inactive or not scheduleable and are
>assigned to future workorders. You can then edit/re-assign employees
>where necessary.

