<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Schema ;

use App\SchemaBlock;
use App\Http\Controllers\ApiResponseController;
use App\User;
class ApiSchemaBlock extends Controller
{
   public function __construct(){
      $this->middleware("schema_block_validation" ,["only" => ["store" , "update"]]);
      $this->middleware("admin_auth" , [ "only" => ["destroy","update","add_user_to_schema_block" , "remove_user_from_schema_block"]]);
      $this->middleware("user_auth" ,[ "only" => ["index"] ]);
   }
   public function index($id,$start_date,$end_date , $user = null ){
         $start_date = date($start_date);
         $end_date = date($end_date);
         $error = array(array("Error"));
         if($start_date && $end_date){

         }else{
            array_push($error["Error"], "invalid date or dates given"); 
         }
         //todo filter active or by week asc desc
         $schema  = Schema::find($id);
         if(!$schema){
             array_push($error["Error"], "Schema was not found"); 
         }
         if (! empty($error["Error"])){
            return ApiResponseController::response($error["Error"],400);
      
         }
         if($user){
         $user = User::find($user);
         if(!$user){
         return ApiResponseController::response(array("Errors" => ["User nor found"]),400);
         }
         $schema_blocks = $schema->schema_blocks()->whereBetween("start_time",array($start_date,$end_date))->has("user" ,$user->id )->get();
        
         }else{
          $schema_blocks = $schema->schema_blocks()->whereBetween("start_time",array($start_date,$end_date))->get();         
         }

         return ApiResponseController::response($schema_blocks,200);
   }
   public function store(Request $request,$id){
   		$schema  = Schema::find($id);

   		if (!$schema){
   			return ApiResponseController::response([ "Errors"=> "no schema found" ],404);
   		}
   		$schema_block = new SchemaBlock;
   		
   		$schema_block->start_time = $request->start_time;
   		$schema_block->end_time = $request->end_time;

   		if($request->name){
   			$schema_block->name = $request->name;
   		}
   		if($request->desc){
   			$schema_block->desc = $request->desc;
   		}


   		$schema_block->schema()->associate($schema);

         $schema_block->save();

   		return ApiResponseController::response($schema_block,200);
   }

   public function destroy($id){
         $schema_block  = SchemaBlock::find($id);
         
         if (! $schema_block){
            return ApiResponseController::response([ "Errors"=>"schemablock not found" ],404);
         }
       
         $schema_block->delete();

         return ApiResponseController::response($schema_block , 200);

   }
   public function update(Request $request , $id){
        
         $schema_block  = SchemaBlock::find($id);
         
         if (! $schema_block){
            return ApiResponseController::response([ "Errors"=>"schemablock not found" ],404);
         }

         if($request->start_time){
            $schema_block->start_time = $request->start_time;
         }

         if($request->end_time){
            $schema_block->end_time = $request->end_time;
         }
         
         if($request->name){
            $schema_block->name = $request->name;
         }
         if($request->desc){
            $schema_block->desc = $request->desc;
         }

         $schema_block->save();

         return ApiResponseController::response($schema_block , 200);

   }

   public function add_user_to_schema_block($schema_block_id , $user_id){
      
      $schema_block = Schemablock::find($schema_block_id);
      $user = User::find($user_id);
      $error_array = ["Errors"=>[]];
      
      if(!$schema_block){
         array_push($error_array["Errors"] , "schema block not found");
      }

      if(!$schema_block){
         array_push($error_array["Errors"] , "user not found");
      }

      if(count($error_array["Errors"]) != 0){
         return ApiResponseController::response($error_array["Errors"],404);
      }
      if (!$schema_block->user()->get()->contains($user)) {
         $schema_block->user()->attach($user);
         $schema_block->save();
    
      }
      return ApiResponseController::response($schema_block,200);



   }
   public function remove_user_from_schema_block( $schema_block_id , $user_id){
      $schema_block = Schemablock::find($schema_block_id);
      $user = User::find($user_id);
      $error_array = ["Errors"=>[]];
      
      if ( !$schema_block){
         array_push($error_array["Errors"] , "schema block not found , nothing deleted");
      }

      if( !$schema_block){
         array_push($error_array["Errors"] , "user not found , nothinf deleted ");
      }

      if ( count($error_array["Errors"]) != 0){
         return ApiResponseController::response($error_array,404);
      }
      if ( $schema_block->user()->get()->contains($user) ) {
         $schema_block->user()->detach($user);
         $schema_block->save();
    
      }
      return ApiResponseController::response($schema_block,200);
   }
}
