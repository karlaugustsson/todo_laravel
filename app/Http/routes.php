<?php
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

//use Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(array('prefix' => 'api/v1/'), function()
    {

		Route::post("login" ,"ApiUserLogin@login");


		Route::get('users/{sort?}', "UserApiController@index");
		Route::get('user/{id}/',"UserApiController@show");
   		
   		Route::post('user',"UserApiController@store");
   		Route::patch('user',"UserApiController@update");
   		Route::delete('user/{id}',"UserApiController@destroy");

	});

