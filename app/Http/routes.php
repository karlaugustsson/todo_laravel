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
		
		Route::get("admin/schemas/{sort?}/{limit?}/{offset?}" , "SchemaApiController@index");
		
		
		Route::post("admin/schema" , "SchemaApiController@store");
		Route::patch("admin/schema/{id}" , "SchemaApiController@update");
		Route::delete("admin/schema/{id}" , "SchemaApiController@destroy");
	

		Route::get("admin/schema/{schema_id}/add/user/{user_id}" ,"ApiSubscribeSchemaController@add_user_to_schema" );
		Route::get("admin/schema/{schema_id}/remove/user/{user_id}" ,"ApiSubscribeSchemaController@remove_user_to_schema" );

		Route::post("admin/schema/{schema_id}/schema_block","ApiSchemaBlock@store");

		
		Route::delete("admin/schema/schema_block/{block_id}","ApiSchemaBlock@destroy");
		Route::patch("admin/schema/schema_block/{block_id}","ApiSchemaBlock@update");
		
		Route::get("admin/schema/schema_block/{id}/user/{user_id}" , "ApiSchemaBlock@add_user_to_schema_block");
		Route::delete("admin/schema/schema_block/{id}/user/{user_id}" , "ApiSchemaBlock@remove_user_from_schema_block");


		Route::get("user/schemas/{sort?}/{limit?}/{offset?}" , "ApiSubscribeSchemaController@index");
		
		
		Route::get("user/schema/subscribe/{id}" ,"ApiSubscribeSchemaController@store" );
		Route::get("user/schema/unsubscribe/{id}" ,"ApiSubscribeSchemaController@destroy" );

		

		Route::get('users/{sort?}/{limit?}/{offset?}', "UserApiController@index");
		Route::get('user/{id}/',"UserApiController@show");
   		
   		Route::post('user',"UserApiController@store");
   		Route::patch('user',"UserApiController@update");
   		Route::delete('user',"UserApiController@destroy");
   		
   		Route::get("schema/{id}" , "SchemaApiController@show");	
   		Route::get("schema/{id}/users" ,"SchemaApiController@list_schema_subscribers" );
   		Route::get("schema/{id}/user/{user_id}" ,"SchemaApiController@get_schema_subscriber" );
   		Route::get("schema/{schema_id}/schema_blocks/","ApiSchemaBlock@index");


	});

