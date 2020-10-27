<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerResource;
use App\Ink;
use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user_id){
            $sellers=DB::table('sellers')
            ->where('user_id','=',$request->user_id)
            ->get();
        }else{
            $sellers = Seller::all();
        }


        return new SellerResource($sellers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = new Seller();
        $seller->seller_name=$request->name;
        $seller->seller_nick_name=$request->nick_name;
        $seller->seller_phone=$request->phone;
        $seller->seller_email=$request->email;
        $seller->user_id=$request->user_id;

        if($seller->save()){
            return['status'=>'data has been inserted'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return response()->json($seller);
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
        $seller = Seller::where('seller_id',$id);
        $seller->update($request->all());
        return['status'=>'data has been update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($seller_id)
    {
        return Seller::destroy($seller_id);
    }
}
