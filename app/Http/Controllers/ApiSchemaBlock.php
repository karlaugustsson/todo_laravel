<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Schema ;

use App\SchemaBlock;

use App\User;
class ApiSchemaBlock extends Controller
{
   public function __construct(){
      $this->middleware("schema_block_auth" ,["only" => ["store"]]);
   }
   public function store(Request $request,$id){
   		$schema  = Schema::find($id);

   		if (!$schema){
   			return response([ "Error"=>"no schema found" ],404);
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

   		return response()->json($schema_block,200);
   }

   public function destroy($id){
         $schema_block  = SchemaBlock::find($id);
         
         if (! $schema_block){
            return response([ "Error"=>"schemablock not found" ],404);
         }
       
         $schema_block->delete();

         return response()->json($schema_block , 200);

   }
   public function update(Request $request , $id){
        
         $schema_block  = SchemaBlock::find($id);
         
         if (! $schema_block){
            return response([ "Error"=>"schemablock not found" ],404);
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

         return response()->json($schema_block , 200);

   }
   public function add_user_to_schema_block($schema_block_id , $user_id){
      
      $schema_block = Schemablock::find($schema_block_id);
      $user = User::find($user_id);
      $error_array = ["errors"=>[]];
      
      if(!$schema_block){
         array_push($error_array["errors"] , "schema block not found");
      }

      if(!$schema_block){
         array_push($error_array["errors"] , "user not found");
      }

      if(count($error_array["errors"]) != 0){
         return response()->json($error_array,404);
      }
      if (!$schema_block->user()->get()->contains($user)) {
         $schema_block->user()->attach($user);
         $schema_block->save();
    
      }
      return response()->json($schema_block,200);



   }
   public function remove_user_from_schema_block( $schema_block_id , $user_id){
      $schema_block = Schemablock::find($schema_block_id);
      $user = User::find($user_id);
      $error_array = ["errors"=>[]];
      
      if ( !$schema_block){
         array_push($error_array["errors"] , "schema block not found , nothing deleted");
      }

      if( !$schema_block){
         array_push($error_array["errors"] , "user not found , nothinf deleted ");
      }

      if ( count($error_array["errors"]) != 0){
         return response()->json($error_array,404);
      }
      if ( $schema_block->user()->get()->contains($user) ) {
         $schema_block->user()->detach($user);
         $schema_block->save();
    
      }
      return response()->json($schema_block,200);
   }
}
