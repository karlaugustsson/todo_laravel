<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Schema;
use App\Http\Controllers\ApiResponseController;
class SchemaApiController extends Controller
{


	public function __construct(){
	$this->middleware("schema_validation" , ["only" => ["update","store"]]);
    $this->middleware("admin_auth" , ["except" => "show","list_schema_subscribers" , "get_schema_subscriber"]); 
    

	}

    public function index($sort = null ,$limit = null , $offset = null){

		$user = UserAuth::getAuthenticatedUser();
    		
		if ( $sort != null && strtoupper($sort) == "ASC" || strtoupper($sort) == "DESC"){
		
			$schemas = $user->schemas()->orderBy('id' ,$sort);
				
			if( $limit != null ){

				$schemas->take((int) $limit);
				
			}
			if( $offset != null ){

				$schemas->skip((int) $offset);
				
			}
			$schemas = $schemas->get();

		
			}else{
				$schemas = $user->schemas()->get();
			}



    		if ( $schemas->count() === 0 ){
    			return ApiResponseController::response(["message" => "No Schemas found"],404);
    		}
            foreach ($schemas as $schema) {
                $schema->creator = $schema->user()->select("name")->get();
            }
    		return ApiResponseController::response($schemas,200);
    }
    public function show($id){

    	$schema = Schema::find($id);


    	
    	if ( !$schema ){
    	   return ApiResponseController::response(["message"=>"found no schema"],404);
    	}

        $schema->creator = $schema->user()->select("name")->get();
    	return ApiResponseController::response($schema,200);
    }
    public function update(Request $request,$id){

    	$user = UserAuth::getAuthenticatedUser();
    	
    	$schema = $user->schemas()->find($id);
    	
    	if ($schema){
	    	
	   		$schema->name = $request->name;
	     	$schema->save();

	     	return ApiResponseController::response($schema,200);

    	}
    	return ApiResponseController::response(["Errors" => "no schema of yours was found nothing edited"] , 404);

    }

    public function destroy($id){
    	$user = UserAuth::getAuthenticatedUser();
    	$schema = $user->schemas()->find($id);
    	
        if(!$schema){
    		return ApiResponseController::response(["message" => "schema of your not found ,nothing deleted"] , 404);
    	}
        $schema->delete();
    	return ApiResponseController::response($schema,200);

    }

    public function store(Request $request){
    	
        $user = UserAuth::getAuthenticatedUser();
    	
    	$schema = new Schema();

    	$schema->name = $request->name;
    	$schema->user()->associate($user);
        
        if($request->desc){
            $schema->desc = $request->desc;
        }
    	$schema->save();

    	return ApiResponseController::response($schema , 200);

    	
    }

    public function list_schema_subscribers($id){
        $schema = Schema::find($id);
        
        if(!$schema){
            return ApiResponseController::response(["Errors"=>"schema not found"],404);
        }
        $subscriber_users = $schema->subscribed_users()->get();

        return ApiResponseController::response($subscriber_users,200);
    }
    public function get_schema_subscriber($id,$user_id){

        $schema = Schema::find($id);
        $error_array = [["Erorrs"]]
        
        if ( !$schema ){
            array_push($error_array["Errors"],"No schema was found");
        }

        $subscriber_user = $schema->subscribed_users($user_id)->find($user_id);

        if ( !$subscriber_user ){
            array_push($error_array["Errors"],"The subscriber user was not found");
        }

        if ( count($error_array["Errors"]) != 0 ){
            return ApiResponseController::response($error_array["Errors"]);
        }


        return ApiResponseController::response($subscriber_user,200);
    }

}
