<?php

namespace App\Http\Controllers\Api;

use App\his_bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BillResource;
use Illuminate\Support\Facades\DB;

class HisBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=DB::table('his_bills')->join('inks','his_bills.ink_id','=','inks.ink_id')
            ->join('invoicenumbers','his_bills.invoicenumber_id','=','invoicenumbers.invoicenumber_id')
            ->get();

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
        $bill = new his_bill();
        $bill->invoicenumber_id=$request->invoicenumber_id;
        $bill->ink_id=$request->ink_id;
        $bill->ink_cost=$request->ink_cost;
        $bill->ink_profit=$request->ink_profit;
        $bill->ink_amount=$request->ink_amount;
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
        $bill = his_bill::where('id',$id);
        $bill->update($request->all());
        return['status'=>'data has been update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoicenumber_id)
    {
        return DB::table('his_bills')->where('invoicenumber_id','=',$invoicenumber_id)->delete();
    }
}
