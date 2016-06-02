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

        if (! $user = JWTAuth::parseToken()->authenticate()) {
                return ApiResponseController::response(['Errors' => 'user not found'], 404);
        }


 		return $user;
}

}
