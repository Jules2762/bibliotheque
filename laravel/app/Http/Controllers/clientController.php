<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(client $client): \Illuminate\Database\Eloquent\Collection
    {
        return client::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(client $client,Request $request)
    {
        $validated=$this->validateStoreRequest($request);
        if($validated->fails()){
            return $validated->errors();
        } else {
            $client->name=$request->name;
            $client->email=$request->email;
            $client->password=$request->password;
            $client->save();
            return $client;
        }
    }
    public function validateStoreRequest(Request $request){
        return Validator::make(
            $request->all(),
            [
                'name'=>'required|min:2',
                'email'=>'required',
                'password'=>'required|min:6'
            ]
        );
    }
    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {

    }
    public function signin(client $client,Request $request){
        $validated=$this->validateSigninRequest($request);
        if($validated->fails()===false){
            $res=$client::where('email',$request->email)->where('password',$request->password)->get();
            if($res->count()>0){
                session()->regenerate();
                return [true,$res];
            } else {
                return [false,null];
            }

        } else {
            return  [false,null];
        }
    }
    public function validateSigninRequest(Request $request){
        return Validator::make($request->all(),
        [
            'email'=>'required',
            'password'=>'required'
        ]
        );
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }
}
