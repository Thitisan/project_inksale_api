<?php

namespace App\Http\Controllers\Api;

use App\Comproflie;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComproflieResource;
use Illuminate\Http\Request;

class ComproflieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprofile = Comproflie::all();

        return new ComproflieResource($comprofile);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comprofile = new Comproflie();
        $comprofile->name=$request->name;
        $comprofile->address=$request->address;
        $comprofile->phone=$request->phone;

        if($comprofile->save()){
            return['status'=>'data has been inserted'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comproflie $comprofile)
    {
        return response()->json($comprofile);
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
        $comprofile = Comproflie::where('id',$id);
        $comprofile->update($request->all());
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
        return Comproflie::destroy($id);
    }
}
