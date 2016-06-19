<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiResponseController extends Controller
{
    public static function response($body,$statuscode){
   
    	return response()->json($body,$statuscode);
    }

}
