<?php

namespace App\Http\Controllers;

use App\Models\panier;
use Illuminate\Http\Request;

class panierController extends Controller
{
    public function show(panier $panier,Request $request){
        return $panier::where('client_id',$request->client_id)->get();
    }
    public function store(panier $panier,Request $request){
        $panier->nombre=1;
        $panier->client_id=$request->client_id;
        $panier->produit_id=$request->produit_id;
        $panier->save();
        return $panier;
    }
}
