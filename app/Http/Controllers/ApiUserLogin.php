<?php

namespace App\Http\Controllers;


use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiUserLogin extends Controller
{
   public function login(Request $request){

   	$crendetials = $request->only("email" , 'password');
   	

   	try {
   		if(! $token = JWTAuth::attempt($crendetials)){
   			return response()->json(['errors' => ['invalid_credentials']], 401);
   		}
   		
   	} catch (JWTException $e) {
   		return response()->json(['error' => 'could_not_create_token'], 500);
   	}

   	return response()->json(compact('token'));
   }
}