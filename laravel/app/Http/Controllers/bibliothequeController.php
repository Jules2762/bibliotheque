<?php

namespace App\Http\Controllers;

use App\Models\bibliotheque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class bibliothequeController extends Controller
{
    public function show(bibliotheque $bibliotheque,Request $request){
        $validated=$this->validateShowRequest($request);
        if($validated->fails()==false){
            return $bibliotheque::where('name',$request->search)->paginate(12);
        } else {
            return $bibliotheque::paginate(12);
        }
    }
    public function store(bibliotheque $bibliotheque,Request $request){

        $bibliotheque->name=$request->input('name');
        $bibliotheque->type=$request->input('type');
        $bibliotheque->taille=$request->input('taille');
        $file= $request->pdf;
        $file_path=$file->store('pdf','public');
        $bibliotheque->pdf=$file_path;
        $bibliotheque->save();
        return $file_path;
    }
    public function validateShowRequest(Request $request){
        return Validator::make(
            [
                $request->search
            ],
            [
                'search'=>'required'
            ]
        );
    }
}

