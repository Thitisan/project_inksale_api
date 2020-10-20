<?php

namespace App\Http\Controllers\Api;

use App\bill;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->seller_id && $request->customer_id){
            $bills=DB::table('bills')->join('inks','bills.ink_id','=','inks.ink_id')
            ->join('customers','bills.customer_id','=','customers.customer_id')
            ->join('sellers','bills.seller_id','=','sellers.seller_id')
            ->join('invoicenumbers','bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->where('bills.seller_id','=',$request->seller_id)
            ->where('bills.customer_id','=',$request->customer_id)
            ->get();
        }
        else if($request->seller_id){
            $bills=DB::table('bills')->join('inks','bills.ink_id','=','inks.ink_id')
            ->join('customers','bills.customer_id','=','customers.customer_id')
            ->join('sellers','bills.seller_id','=','sellers.seller_id')
            ->join('invoicenumbers','bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->where('bills.seller_id','=',$request->seller_id)
            ->get();
        }else if($request->customer_id){
            $bills=DB::table('bills')->join('inks','bills.ink_id','=','inks.ink_id')
            ->join('customers','bills.customer_id','=','customers.customer_id')
            ->join('sellers','bills.seller_id','=','sellers.seller_id')
            ->join('invoicenumbers','bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->where('bills.customer_id','=',$request->customer_id)
            ->get();
        }else if($request->invoiceNo){
            $bills=DB::table('bills')->join('inks','bills.ink_id','=','inks.ink_id')
            ->join('customers','bills.customer_id','=','customers.customer_id')
            ->join('sellers','bills.seller_id','=','sellers.seller_id')
            ->join('invoicenumbers','bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->where('invoicenumbers.invoiceNo','=',$request->invoiceNo)
            ->get();
        }else{
            $bills=DB::table('bills')->join('inks','bills.ink_id','=','inks.ink_id')
            ->join('customers','bills.customer_id','=','customers.customer_id')
            ->join('sellers','bills.seller_id','=','sellers.seller_id')
            ->join('invoicenumbers','bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->get();
        }

        return new BillResource($bills);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bill = new bill();
        $bill->customer_id=$request->customer_id;
        $bill->seller_id=$request->seller_id;
        $bill->invoicenumber_id=$request->invoicenumber_id;
        $bill->ink_id=$request->ink_id;
        $bill->amount=$request->amount;

        if($bill->save()){
            return['status'=>'data has been inserted'];
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
        $bill = bill::where('id',$id);
        $bill->update($request->all());
        return['status'=>'data has been update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return bill::destroy($id);
    }
}
