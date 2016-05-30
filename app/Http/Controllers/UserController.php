<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\StoreUserPostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Route; 
use App\User;
use Auth;
use Illuminate\Http\Response;


class UserController extends Controller
{

	// public function index(Request $request){
	
	// $users = User::all();
	

	// return $users;

	// }
	// public function show($id, Request $request,$format = null){

	// 	$user = User::findOrFail($id);
		
	// 	if($request->header("Content-Type") == "text/html" && $format == null || $request->header("Content-Type") == null && $format == null){
	// 		return "placeholder for user show view";
	// }

	// 	$response = new Response();
		
	// 	return response($user,200)->header("Content-type","text/xml");

	// }
	// public function create(){
	// 		$user = User::new();
	// 		if($request->header("Content-Type") == "text/html"|| $request->header("Content-Type") == null ){
	// 		return "placeholder for user create view";
	// 		}

	// 		return $user;

	// }
	// public function store(StoreUserPostRequest $request){
		
	// 	$user = new User($request->all());
	
	// 	$user->save();

	// }
	// public function edit(){

	// }
	// public function update(INT $id,StoreUserPostRequest $request){

	// 	$user = User::findOrFail($id);
		
	// 	$user->name = $request->name;

	// 	if($request->email){
	// 		$user->email = $request->email;
	// 	}

	// 	if($request->password){
	// 		$user->password = $request->password;
	// 	}

	// 	$user->save();
	// }
	// public function destroy($id){

	// 	$user = User::find($id);
	
	// 	$user->delete($id);

	// }
	// public function delete(){

	// }

}
