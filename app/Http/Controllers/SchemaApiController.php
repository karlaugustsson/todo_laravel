<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Schema;

class SchemaApiController extends Controller
{


	public function __construct(){
	$this->middleware("schema_validation" , ["only" => ["update","store"]]);
    $this->middleware("admin_auth" , ["except" => "show"]); 
    

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
    			return response()->json([],404);
    		}
            foreach ($schemas as $schema) {
                $schema->creator = $schema->user()->select("name")->get();
            }
    		return response()->json($schemas,200);
    }
    public function show($id){

    	$schema = Schema::find($id);


    	
    	if ( !$schema ){
    			return response()->json(["message"=>"found no schema"],404);
    	}
        $schema->creator = $schema->user()->select("name")->get();
    	return response()->json($schema,200);
    }
    public function update(Request $request,$id){

    	$user = UserAuth::getAuthenticatedUser();
    	
    	$schema = $user->schemas()->find($id);
    	
    	if ($schema){
	    	
	   		$schema->name = $request->name;
	     	$schema->save();

	     	return response()->json($schema,200);

    	}
    	return response(["error" => "no schema of yours was found nothing edited"] , 404);

    }

    public function destroy($id){
    	$user = UserAuth::getAuthenticatedUser();
    	$schema = $user->schemas()->find($id);
    	
        if(!$schema){
    		return response(["message" => "schema of your not found ,nothing deleted"] , 404);
    	}
        $schema->delete();
    	return response($schema,200);

    }

    public function store(Request $request){
    	
        $user = UserAuth::getAuthenticatedUser();
    	
    	$schema = new Schema();

    	$schema->name = $request->name;
    	$schema->user()->associate($user);
    	$schema->save();

    	return response()->json($schema , 200);

    	
    }

}
