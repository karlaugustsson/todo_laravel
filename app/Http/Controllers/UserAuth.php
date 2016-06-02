<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use App\User;
use App\Http\Controllers\ApiResponseController;

class UserAuth extends Controller
{
  public static function getAuthenticatedUser()
{

		if( !$user = User::find(1) ){
		
		return ApiResponseController::response("Couldnt find the auth user , by the way not final method bitch here goes the jwt",404);
			
		}


 		return $user->first();
}

}
