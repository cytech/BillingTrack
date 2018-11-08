@extends('documentation.master')

@section('content')

    <div class="col-lg-9 documentation">

        <h2>Expenses</h2>

        <hr>

        <p><a href="#enter-expense">How do I enter an expense?</a></p>
        <p><a href="#bill-expense">How do I bill an expense to a client?</a></p>
        <p><a href="#profit-loss">How can I see my profit and loss?</a></p>

        <hr>

        <span class="anchor" id="enter-expense"></span>
        <h3>How do I enter an expense?</h3>

        <p>Click the Expenses menu item and press the New button.</p>

        <a href="/img/documentation/expense_create.png" target="_blank">
            <img src="/img/documentation/expense_create_small.png" class="img-responsive">
        </a>

        <p>Adjust the company profile and the date of the expense if needed.</p>
        <p>Enter a category to assign the expense to. If you have previously entered the same category, it will appear
            once you start typing.</p>
        <p>Enter the amount of the expense.</p>
        <p>Optionally enter the name of the vendor for the expense. If you have previously entered the same vendor, it
            will appear once you start typing.</p>
        <p>If this is a billable expense, enter the name of the client who will reimburse you. This will allow you to
            add this
            expense to an invoice after the expense is saved.</p>
        <p>Optionally enter a description for the expense.</p>
        <p>Optionally select one or more files to attach to the expense.</p>
        <p>Press the Save button.</p>

        <a href="/img/documentation/expense_create2.png" target="_blank">
            <img src="/img/documentation/expense_create2_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="bill-expense"></span>
        <h3>How do I bill an expense to a client?</h3>

        <p>Click the Expenses menu item, press the Options button on the expense to bill and select Bill This
            Expense.</p>

        <a href="/img/documentation/expense_bill.png" target="_blank">
            <img src="/img/documentation/expense_bill_small.png" class="img-responsive">
        </a>

        <p>Choose the invoice to add the expense to.</p>
        <p>To add the expense to the invoice as a line item, choose Add line item to invoice and review the name and
            description of the line item and adjust if needed.</p>
        <p>To add the expense to the invoice without adding a line item, choose Do not add line item to invoice.</p>
        <p>Press the Submit button.
        </p>
        <a href="/img/documentation/expense_bill2.png" target="_blank">
            <img src="/img/documentation/expense_bill2_small.png" class="img-responsive">
        </a>

        <hr>

        <span class="anchor" id="profit-loss"></span>
        <h3>How can I see my profit and loss?</h3>

        <p>Click the Reports menu item and choose Profit and Loss.</p>
        <p>The Profit and Loss report can be run against all or one company profile for a specific date range.</p>

        <a href="/img/documentation/expense_profit_loss.png" target="_blank">
            <img src="/img/documentation/expense_profit_loss_small.png" class="img-responsive">
        </a>

    </div>

@stop