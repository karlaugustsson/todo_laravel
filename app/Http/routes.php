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

		Route::post("authorize" ,"ApiUserLogin@login");

		Route::get("user/schemas/{sort?}/{limit?}/{offset?}" , "SchemaApiController@index");
		Route::get("user/schema/{id}" , "SchemaApiController@show");
		
		Route::patch("user/schema/{id}" , "SchemaApiController@update");
		Route::post("user/schema" , "SchemaApiController@store");
		Route::delete("user/schema/{id}" , "SchemaApiController@destroy");

		Route::get('users/{sort?}/{limit?}/{offset?}', "UserApiController@index");
		Route::get('user/{id}/',"UserApiController@show");
   		
   		Route::post('user',"UserApiController@store");
   		Route::patch('user',"UserApiController@update");
   		Route::delete('user',"UserApiController@destroy");



	});

