<?php

namespace App\Http\Controllers;

use App\Models\produit;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class produitController extends Controller
{
    public function show(produit $produit,Request $request){
        $validated=$this->validateShowRequest($request);
        if($validated->fails()==true){
            return $produit::paginate(12);
        } else {
            return $produit::where('name',$request->search)->paginate(12);
        }
    }
    public function validateShowRequest(Request $request){
        return Validator::make(
            $request->all(),
            [
                'search'=>'required | min:1'
            ]
        );
    }
    public function store(produit $produit,Request $request){



            $produit->name=$request->input('name');
            $produit->price=$request->input('price');
            $produit->unite='Ar';
            $file= $request->file;
            $file_path=$file->store('bloc','public');
            $produit->image=$file_path;
            $produit->save();
            return $file_path;

    }
    public function delete(produit $produit,Request $request){

    }
    public function update(produit $produit,Request $request){
        $update= $produit::find($request->id);
        $update->name=$request->input('name');
        $update->price=$request->input('price');
        $update->unite='Ar';
        $file= $request->file;
        $file_path=$file->store('bloc','public');
        $update->image=$file_path;
        $update->save();
        return $update;

    }

    public function validateStoreRequest(Request $request){
        return Validator::make([
            $request->name,
            $request->price
        ],[
            'name'=>'required',
            'price'=>'required',

        ]);
    }
}
