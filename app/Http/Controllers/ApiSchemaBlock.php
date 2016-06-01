<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Schema ; 

class ApiSchemaBlock extends Controller
{
   public function store(Request $request,$id){
   		$schema  = Schema::find($id);

   		if (!$schema){
   			return response(["Error"=>"no schema found"],404)
   		}
   		$schema_block = new SchemaBlock;
   		
   		$schema_block->start_time = $request->start_time;
   		$schema_block->end_time = $request->end_time;

   		if($request->name){
   			$schema_block->name = $request->name;
   		}
   		if($request->desc){
   			$schema_block->name = $request->desc;
   		}


   		$schema->schema_block()->attach($schema);

   		return response()->json($schema_block,200);
   }
}
