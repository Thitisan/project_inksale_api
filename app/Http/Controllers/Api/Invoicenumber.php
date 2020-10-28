<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoicenumberResource;
use Illuminate\Http\Request;
use App\invoicenumbers;
use Illuminate\Support\Facades\DB;
class Invoicenumber extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->seller_id && $request->customer_id){
            $invoices=DB::table('invoicenumbers')->join('customers','invoicenumbers.customer_id','=','customers.customer_id')
            ->join('sellers','invoicenumbers.seller_id','=','sellers.seller_id')
            ->where('invoicenumbers.seller_id','=',$request->seller_id)
            ->where('invoicenumbers.customer_id','=',$request->customer_id)
            ->get();
        }
        else if($request->seller_id){
            $invoices=DB::table('invoicenumbers')->join('customers','invoicenumbers.customer_id','=','customers.customer_id')
            ->join('sellers','invoicenumbers.seller_id','=','sellers.seller_id')
            ->where('invoicenumbers.seller_id','=',$request->seller_id)
            ->get();
        }else if($request->customer_id){
            $invoices=DB::table('invoicenumbers')->join('customers','invoicenumbers.customer_id','=','customers.customer_id')
            ->join('sellers','invoicenumbers.seller_id','=','sellers.seller_id')
            ->where('invoicenumbers.customer_id','=',$request->customer_id)
            ->get();
        }else if($request->invoiceNo){
            $invoices=DB::table('invoicenumbers')->join('customers','invoicenumbers.customer_id','=','customers.customer_id')
            ->join('sellers','invoicenumbers.seller_id','=','sellers.seller_id')
            ->where('invoicenumbers.invoiceNo','=',$request->invoiceNo)
            ->get();
        }else{
            $invoices=DB::table('invoicenumbers')->join('customers','invoicenumbers.customer_id','=','customers.customer_id')
            ->join('sellers','invoicenumbers.seller_id','=','sellers.seller_id')
            ->get();
        }

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
        $invoice->seller_id=$request->seller_id;
        $invoice->customer_id=$request->customer_id;
        $invoice->sum_price = 0;


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
        $ink = invoicenumbers::where('invoicenumber_id','=',$request->invoicenumber_id);
        $ink->update($request->all());
        return['status'=>'data has been update'];
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
