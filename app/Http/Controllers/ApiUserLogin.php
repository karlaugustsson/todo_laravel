<?php

namespace App\Http\Controllers;


use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController;
use Log;




class ApiUserLogin extends Controller
{
   public function login(Request $request){
   	$crendetials = $request->only("email" , 'password');
   	Log::info($request->all());

   		if(! $token = JWTAuth::attempt($crendetials)){
   			return ApiResponseController::response(['errors' => ['Invalid credentials try again']], 401);
   		}

   	return ApiResponseController::response(compact('token'),200);
   }
}
