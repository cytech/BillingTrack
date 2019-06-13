<div class="form-group">
    <label>@lang('bt.default_item_tax_rate'): </label>
    {!! Form::select('setting[itemTaxRate]', $taxRates, config('bt.itemTaxRate'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>@lang('bt.default_item_tax_2_rate'): </label>
    {!! Form::select('setting[itemTax2Rate]', $taxRates, config('bt.itemTax2Rate'), ['class' => 'form-control']) !!}
</div>
