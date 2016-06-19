<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Schema;
use App\Http\Controllers\ApiResponseController;




class ApiSubscribeSchemaController extends Controller
{
	public function __construct(){
    	$this->middleware("user_auth"); 
	}

	public function index($sort = null , $limit = null , $offset = null){
		
		$user = UserAuth::getAuthenticatedUser();

		if ( $sort != null && strtoupper($sort) == "ASC" || strtoupper($sort) == "DESC"){
		
			$schemas = $user->subscribed_schemas()->orderBy('id' ,$sort);
				
			if( $limit != null ){

				$schemas->take((int) $limit);
				
			}
			if( $offset != null ){

				$schemas->skip((int) $offset);
				
			}
			$schemas = $schemas->get();

		
			}else{
				$schemas = $user->subscribed_schemas()->get();
			}

		if ( $schemas->count() == 0 ){
			return ApiResponseController::response(["message" => "you have no subscription to any schemas"],404);
		}
		foreach ($schemas as $schema) {
        	$is_subscribed = ($schema->subscribed_users()->find($user->id))?true:false;
        	$schema->is_subscriber = $is_subscribed;
        	$schema->creator = $schema->user()->select("name")->get();
        }
		return ApiResponseController::response($schemas,200);
	}

	public function store($id){
		$user = UserAuth::getAuthenticatedUser();

		$schema = Schema::find($id);
		
		if($schema == null ){
			return ApiResponseController::response(["Errors" => "cant subscribe , no schema found"],404);
		}
			
		if (!$user->subscribed_schemas()->get()->contains($schema)) {
    		$user->subscribed_schemas()->attach($schema);
    		$user->save();
    		
		}
		return ApiResponseController::response($user->subscribed_schemas()->find($id),200);

		
	}
	public function destroy($id){

		$user = UserAuth::getAuthenticatedUser();
		$schema = Schema::find($id);
		
		if($schema == null ){
			return ApiResponseController::response(["Errors" => "schema not found , no unsubscribe for you"],404);
		}

		$user->subscribed_schemas()->detach($schema);
		return ApiResponseController::response($schema,200);
	}
	public function add_user_to_schema($schema_id,$user_id){

		$auth_user = UserAuth::getAuthenticatedUser();
		$schema = Schema::find($schema_id);
		$user = User::find($user_id);
		$response_errors = ["Errors" => []];
		
		if(! $user){
			array_push($response_errors["Errors"] , "no user was found with that id");

		}

		if (! $schema ){
			array_push($response_errors["Errors"] , "no schema found with that id");
		}

		if ( count( $response_errors["Errors"]   ) != 0 ){
		
			return ApiResponseController::response($response_errors , 404);
		}
		if (!$user->subscribed_schemas()->get()->contains($schema)) {
    		$user->subscribed_schemas()->attach($schema);
    		$user->save();
    		
		}

		return ApiResponseController::response(["message" => "subscription ok"],200);

	}
	public function remove_user_to_schema($schema_id,$user_id){
		
		$auth_user = UserAuth::getAuthenticatedUser();
		$schema = Schema::find($schema_id);
		$user = User::find($user_id);
		$response_errors = ["Errors" => []];
		
		if(! $user){
			array_push($response_errors["errors"] , "no user was found with that id");

		}

		if (! $schema ){
			array_push($response_errors["errors"] , "no schema found with that id");
		}

		if ($user->subscribed_schemas()->get()->contains($schema)) {

    		$user->subscribed_schemas()->detach($schema);
    		$user->save();
    		
		}else{
			array_push($response_errors["Errors"] , "user has no such schema subscription , nothing changed");
		}

		if ( count( $response_errors["Errors"]   ) != 0 ){
		
			return ApiResponseController::response($response_errors["Errors"] , 404);
		}



		return ApiResponseController::response(["message" => "user unsubscribed"],200);
	}
}
