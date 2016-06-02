<?php

namespace App\Http\Controllers;


use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController;


class ApiUserLogin extends Controller
{
   public function login(Request $request){

   	$crendetials = $request->only("email" , 'password');
   	

   		if(! $token = JWTAuth::attempt($crendetials)){
   			return ApiResponseController::response(['errors' => ['invalid_credentials']], 401);
   		}

   	return ApiResponseController::response(compact('token'));
   }
}
