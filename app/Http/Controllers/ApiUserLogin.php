<?php

namespace App\Http\Controllers;


use App\User;
use JWTAuth;
use Illuminate\Http\Request;



class ApiUserLogin extends Controller
{
   public function login(Request $request){

   	$crendetials = $request->only("email" , 'password');
   	

   		if(! $token = JWTAuth::attempt($crendetials)){
   			return response()->json(['errors' => ['invalid_credentials']], 401);
   		}

   	return response()->json(compact('token'));
   }
}
