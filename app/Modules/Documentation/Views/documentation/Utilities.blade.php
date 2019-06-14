@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Utilities</h2>

        <hr>
        <b>Employees</b></p>
        <p>
            Allows for creation of Employees that may be assigned to workorders.
            The list may be sorted by the available header fields. To edit an
            Employee, select the Employee # in the list.</p>

        <ul>
            <b>New</b>

        <p>
            Create a new employee.</p>

        </ul>
        <b>Vendors</b></p>
        <p>
            Allows for creation of Vendors that may be assigned to expenses.
            The list may be sorted by the available header fields. To edit an
            Vendor, select the Vendor # in the list.</p>

        <ul>
            <b>New</b>

            <p>
                Create a new vendor.</p>

        </ul>
        <p><b>Products</b></p>
        <p>
            Allows for creation of Products (inventory or standard job items)
            that may be assigned to documents. The list may be sorted by the
            available header fields. To edit a Product, select the Product # in
            the list.</p>

        <ul>
            <b>New</b>

        <p>
            Create a new Product.</p>
        </ul>
        <p><br/>
            Note: Both Employees and Products can be "pushed" to the Item Lookup Table.
            Settings (or force function) can be found in System Settings-General tab.
        </p>
        <p><b>Categories</b></p>
        <p>
            Allows for creation of Categories
            that may be assigned to products or expenses. The list may be sorted by the
            available header fields. To edit a Category, select the Category # in
            the list.</p>

        <ul>
            <b>New</b>

            <p>
                Create a new Category.</p>
        </ul>



        <p>
            <b>Batch Print</b></p>
        <p>
            Allows PDF creation of multiple quotes, workorders or invoices by selecting a start and
            end date.</p>
        <ul>
        <b>Criteria:</b><br>
        quotes sent or approved, not converted to workorder or invoice<br>
        workorders sent or approved, not converted to invoice<br>
        invoices sent (not paid)<br>
        </ul>
        <p>
            <b>Item Lookups</b></p>
        <p>
            Item Lookups.</p>

        <p>
            <b>Mail Log</b></p>
        <p>
            Mail Log.</p>

        <p>
            <b>Manage Trash</b></p>
        <p>
            Most entities in BillingTrack can be trashed. Trash (as opposed to delete) removes the entity but keeps
        a reference so that it may be recovered or permanently deleted .<br>
        Here you can manage any trashed entities by recovering or permanently deleteing.<br>
        Depending on the entity,  trashing will cascade any children to the selected entity.<br>
        Example - When a client is trashed, all contacts, custom fields, invoices, recurring invoices, quotes, payments and projects related to this client are also trashed.<br>
        When recovering or deleting, the same cascade logic applies.</p>

    </div>

@stop
