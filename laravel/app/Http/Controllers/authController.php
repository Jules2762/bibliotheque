<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;


class authController extends Controller
{
    public function register(Request $request){
        return User::create([
            'name'=> $request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password'))
        ]);
    }
    public function user(){
        return 'Authenticated';
    }
    public function login(Request $request){
    if(!Auth::attempt($request->only('email','password'))){
        return response([
            'message'=>false
        ],Response::HTTP_UNAUTHORIZED);
    }
    $user= Auth::user();
    $token=$user->createToken('token')->plainTextToken;
    $cookie=cookie('jwt',$token,60*24);
    return response(['message'=>true,'cookie'=>$token])->withCookie($cookie);
    }
    public function logout(){
        $cookie= cookie('jwt');
        return response(['message'=>'logout successful'])->withCookie($cookie);
    }
}
