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

	public function index(Request $request){
	
	$users = User::all();
	
	if($request->header("Content-Type") == "text/html"|| $request->header("Content-Type") == null ){
			return "placeholder for user index view";
	}

	return $users;

	}
	public function show($id){

		$user = User::findOrFail($id);
		
		if($request->header("Content-Type") == "text/html"|| $request->header("Content-Type") == null ){
			return "placeholder for user show view";
	}


		return $user;

	}
	public function create(){
			$user = User::new();
			if($request->header("Content-Type") == "text/html"|| $request->header("Content-Type") == null ){
			return "placeholder for user index view";
			}
			return $user;

	}
	public function store(StoreUserPostRequest $request){
		
		$user = new User($request->all());
	
		$user->save();

	}
	public function edit(){

	}
	public function update(){

	}
	public function destroy(){

	}
	public function delete(){

	}

}
