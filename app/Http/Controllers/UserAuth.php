<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Http\Requests;
use App\User;

class UserAuth extends Controller
{
  public static function getAuthenticatedUser()
{

		if( !$user = User::find(1) ){
		
		return response()->json("Couldnt find the auth user",404);
			
		}


 		return $user->first();
}

}
