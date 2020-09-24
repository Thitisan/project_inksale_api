<?php

namespace App\Http\Controllers\Api;

use App\bill;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillResource;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = bill::all();

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
        //
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
