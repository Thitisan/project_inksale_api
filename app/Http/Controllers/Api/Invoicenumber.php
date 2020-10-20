<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoicenumberResource;
use Illuminate\Http\Request;
use App\invoicenumbers;

class Invoicenumber extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoicenumbers::all();

        return new InvoicenumberResource($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new invoicenumbers();
        $lastInvoiceID = $invoice->orderBy('invoicenumber_id')->pluck('invoicenumber_id')->last()+1;
        $invoice->invoiceNo="IVN".date("Ymd"). str_pad($lastInvoiceID,4,'0', STR_PAD_LEFT);


        if($invoice->save()){
            return['invoice'=>$invoice];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoicenumbers::find($id);

        return new InvoicenumberResource($invoices);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_id)
    {
        return invoicenumbers::destroy($invoice_id);
    }
}
