Utilities
---
[Employees](#employees)

[Vendors](#vendors)

[Products](#products)

[Categories](#categories)

[Item Lookups](#item-lookups)

[Mail Log](#mail-log)

[Batch Print](#batch-print)

[Manage Trash](#manage-trash)

[Database](#database)

---

<a id="employees"></a>
### Employees

Allows for creation of Employees that may be assigned to workorders. The
list may be sorted by the available header fields. To edit an Employee,
select the Employee \# in the list.

<a id="vendors"></a>
### Vendors

Allows for creation of Vendors that may be assigned to Purchaseorders or
expenses. The list may be sorted by the available header fields. To edit
an Vendor, select the Vendor \# in the list.

<a id="products"></a>
### Products

Allows for creation of Products (inventory or standard job items) that
may be assigned to documents. The list may be sorted by the available
header fields. To edit a Product, select the Product \# in the list.

Products can be tracked as inventory from purchaseorders and invoices if
the corresponding settings in System->System Settings->Purchaseorders->
Update Product Table Quantity and Cost and/or System->System
Settings->Invoices-> Update Product Table Quantity are set to "Yes".

When tracking, Purchaseorder received items update the product table
with received quantity and cost. Sent Invoices update the product table
by decrementing the numstock (Quantity on hand)

Invoices will also indicate a stock discrepancy in the item->quantity
field by highlighting the field in yellow, if such a discrepancy exists.


Note: Both Employees and Products can be "pushed" to the Item Lookup
Table. Settings (or force function) can be found in System
Settings-General tab.

<a id="categories"></a>
### Categories

Allows for creation of Categories that may be assigned to products or
expenses. The list may be sorted by the available header fields. To edit
a Category, select the Category \# in the list.

<a id="item-lookups"></a>
### Item Lookups

A table of items that can be retrieved in Quotes, Workorders, Invoices and Purchaseorders. This may be populated manually or by selecting "Save Item as
lookup" when adding an item in the above mentioned modules.
```
Note: Both Employees and Products can be "pushed" to the Item Lookup
Table. Settings (or force function) can be found in System
Settings-General tab.
```

<a id="mail-log"></a>
### Mail Log

Mail Log.

<a id="batch-print"></a>
### Batch Print

Allows PDF creation of multiple quotes, workorders or invoices by
selecting a start and end date.

<a id="manage-trash"></a>
### Manage Trash

Most entities in BillingTrack can be trashed. Trash (as opposed to
delete) removes the entity but keeps a reference so that it may be
recovered or permanently deleted .
Here you can manage any trashed entities by recovering or permanently
deleting.
Depending on the entity, trashing will cascade any children to the
selected entity.  
Example - When a client is trashed, all contacts, custom fields,
invoices, recurring invoices, quotes, payments and projects related to
this client are also trashed.
When recovering or deleting, the same cascade logic applies.

<a id="database"></a>
### Database

Database allows you to:
- Download a SQL backup
- Bulk Trash Entities by a prior-to date
- Bulk Delete Entities by a prior-to date
