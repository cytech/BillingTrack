<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Clients\Controllers;

use BT\DataTables\ClientsDataTable;
use BT\Http\Controllers\Controller;
use BT\Modules\Clients\Models\Client;
use BT\Modules\Clients\Requests\ClientStoreRequest;
use BT\Modules\Clients\Requests\ClientUpdateRequest;
use BT\Modules\CustomFields\Models\CustomField;
use BT\Modules\Payments\Models\Payment;
use BT\Modules\PaymentTerms\Models\PaymentTerm;
use BT\Support\Frequency;
use BT\Traits\ReturnUrl;
use BT\Modules\Industries\Models\Industry;
use BT\Modules\Sizes\Models\Size;

class ClientController extends Controller
{
    use ReturnUrl;

    public function index(ClientsDataTable $dataTable)
    {
        $this->setReturnUrl();

        $status = (request('status')) ?: 'all';

        return $dataTable->render('clients.index',['status' => $status]);

    }

    public function create()
    {
        $industries = Industry::pluck('name', 'id');
        $sizes = Size::pluck('name', 'id');
        $payment_terms = PaymentTerm::pluck('name', 'id');

        return view('clients.form', compact('industries', 'sizes', 'payment_terms'))
            ->with('editMode', false)
            ->with('customFields', CustomField::forTable('clients')->get())
            ->with('returnUrl', $this->getReturnUrl());
    }

    public function store(ClientStoreRequest $request)
    {
        $client = Client::create($request->except('custom'));

        $client->custom->update($request->get('custom', []));

        return redirect()->route('clients.show', [$client->id])
            ->with('alertInfo', trans('bt.record_successfully_created'));
    }

    public function show($clientId)
    {
        //$this->setReturnUrl();

        $client = Client::getSelect()->find($clientId);

        $invoices = $client->invoices()
            ->with(['client', 'activities', 'amount.invoice.currency'])
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(config('bt.resultsPerPage'))->get();

        $quotes = $client->quotes()
            ->with(['client', 'activities', 'amount.quote.currency'])
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(config('bt.resultsPerPage'))->get();

        $workorders = $client->workorders()
            ->with(['client', 'activities', 'amount.workorder.currency'])
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take(config('bt.resultsPerPage'))->get();

        $recurringInvoices = $client->recurringInvoices()
            ->with(['client', 'amount.recurringInvoice.currency'])
            ->orderBy('next_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(config('bt.resultsPerPage'))->get();

        return view('clients.view')
            ->with('client', $client)
            ->with('invoices', $invoices)
            ->with('quotes', $quotes)
            ->with('workorders', $workorders)
            ->with('payments', Payment::clientId($clientId)->orderBy('paid_at', 'desc')->get())
            ->with('recurringInvoices', $recurringInvoices)
            ->with('customFields', CustomField::forTable('clients')->get())
            ->with('frequencies', Frequency::lists())
            ->with('returnUrl', $this->getReturnUrl());
    }

    public function edit($clientId)
    {
        $client = Client::getSelect()->with(['custom'])->find($clientId);
        $industries = Industry::pluck('name','id');
        $sizes = Size::pluck('name', 'id');
        $payment_terms = PaymentTerm::pluck('name', 'id');

        return view('clients.form', compact('industries', 'sizes', 'payment_terms'))
            ->with('editMode', true)
            ->with('client', $client)
            ->with('customFields', CustomField::forTable('clients')->get())
            ->with('returnUrl', $this->getReturnUrl());
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        $client = Client::find($id);
        $client->fill($request->except('custom'));
        $client->save();

        $client->custom->update($request->get('custom', []));

        return redirect()->route('clients.show', [$id])
            ->with('alertInfo', trans('bt.record_successfully_updated'));
    }

    public function delete($clientId)
    {
        Client::destroy($clientId);

        return redirect()->route('clients.index')
            ->with('alert', trans('bt.record_successfully_trashed'));
    }

    public function bulkDelete()
    {
        Client::destroy(request('ids'));
        return response()->json(['success' => trans('bt.record_successfully_trashed')], 200);
    }

    public function ajaxLookup()
    {
        $clients = Client::select('unique_name')
            ->where('active', 1)
            ->where('unique_name', 'like', '%' . request('term') . '%')
            ->orderBy('unique_name')
            ->get();

        $list = [];

        foreach ($clients as $client)
        {
            $list[]['value'] = $client->unique_name;
        }

        return json_encode($list);
    }

    public function ajaxModalEdit()
    {
        return view('clients._modal_edit')
            ->with('editMode', true)
            ->with('client', Client::getSelect()->with(['custom'])->find(request('client_id')))
            ->with('refreshToRoute', request('refresh_to_route'))
            ->with('id', request('id'))
            ->with('customFields', CustomField::forTable('clients')->get())
            ->with('payment_terms', PaymentTerm::pluck('name', 'id'))
            ->with('industries', Industry::pluck('name', 'id'))
            ->with('sizes', Size::pluck('name', 'id'));
    }

    public function ajaxModalUpdate(ClientUpdateRequest $request, $id)
    {
        $client = Client::find($id);
        $client->fill($request->except('custom'));
        $client->save();

        $client->custom->update($request->get('custom', []));

        return response()->json(['success' => true], 200);
    }

    public function ajaxModalLookup()
    {
        return view('clients._modal_lookup')
            ->with('updateClientIdRoute', request('update_client_id_route'))
            ->with('refreshToRoute', request('refresh_to_route'))
            ->with('id', request('id'));
    }

    public function ajaxCheckName()
    {
        $client = Client::select('id')->where('unique_name', request('client_name'))->first();

        if ($client)
        {
            return response()->json(['success' => true, 'client_id' => $client->id], 200);
        }

        return response()->json([
            'success' => false,
            'errors'  => ['messages' => [trans('bt.client_not_found')]],
        ], 400);
    }

    public function ajaxCheckDuplicateName()
    {
        if (Client::where(function ($query)
            {
                $query->where('name', request('client_name'));
                $query->orWhere('unique_name', request('unique_name'));
            })->where('id', '<>', request('client_id'))->count() > 0
        )
        {
            return response()->json(['is_duplicate' => 1]);
        }

        return response()->json(['is_duplicate' => 0]);
    }
}
