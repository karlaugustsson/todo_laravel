<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreUserPostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Route; 
use App\User;
use Illuminate\Http\Response;
use JWTAuth;

class UserApiController extends Controller
{
	public function __construct(){
		//$this->middleware(["jwt.auth","jwt.refresh"] ,["except" => "store"]);

		$this->middleware("user_validation" , ["only" => ["update","store"]]);
		
	}

	public function index(Request $request , $sort = null, $limit = null , $offset = null){
			
			if($sort != null && strtoupper($sort) == "ASC" || strtoupper($sort) == "DESC"){
		
				$users = User::orderBy('id' ,$sort);
				
				if( $limit != null ){

				$users->take((int) $limit);
				
				}
				if( $offset != null ){

				$users->skip((int) $offset);
				
				}

				$users = $users->get();

		
			}else{
				$users = User::all();
			}


 			return response($users,200)->header("Content-Type","application/json");

	}
	public function show(Request $request , $id){

		$user = User::find($id);

		if($user != null ){
			return response($user,200)->header("Content-type","text/json");	
		}
		
		return response(array("errors" => ["No user with provided id was found"]),404)->header("Content-type","text/json");

	}

	public function store(Request $request){
		
		$user = new User($request->all());
		$user->password = bcrypt($request->password);

	
		$user->save();
		return response($user,200)->header("Content-type","text/json");	

	}

	public function update(Request $request){
			
				$user = $this->getAuthenticatedUser();
				$user->name = $request->name;

				if($request->email){
					$user->email = $request->email;
				}

				if($request->password){
					$user->password = bcrypt($request->password);
				}		

			$user->save();
			return response()->json($user,200);
	}
	public function destroy(Request $request){

		$user = $this->getAuthenticatedUser();
		if($user != null){
			$user->delete($id);
			return response()->json($user,200);
		}else{
			return response()->json(array("errors" => ["no user found with that id, nothing got deleted"]),404);
		}

	}
public function getAuthenticatedUser()
{

 $user = User::find(1)->first();

 return $user;
}
}
