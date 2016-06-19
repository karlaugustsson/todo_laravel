<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreUserPostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Route; 
use App\User;
use Illuminate\Http\Response;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ApiResponseController;
use JWTAuth;

class UserApiController extends Controller
{
	public function __construct(){
		$this->middleware(["jwt.auth","jwt.refresh"] ,["except" => "store"]);

		$this->middleware("user_validation" , ["only" => ["update","store"]]);
        
        //$this->middleware("user_auth");	
	}

	public function index( $sort = null, $limit = null , $offset = null){
			
			if($sort != null && strtoupper($sort) == "ASC" || strtoupper($sort) == "DESC"){
		
				$users = User::orderBy('id' ,$sort);
				
				if( $limit != null ){

				$users->take((int) $limit);
				
				}
				if( $offset != null ){

				$users->skip((int) $offset);
				
				}

				$users = $users->take(20)->get();

		
			}else{
				$users = User::all();
			}
			if ( !$users ){

				return ApiResponseController::response(["message" => "no users was found duh"],404);
			}

			return ApiResponseController::response($users,200);

	}
	public function show($id){

		$user = User::find($id);

		if ( !$user ){
			return ApiResponseController::response(["Errors" => "No user with provided id was found"],404);
		}
		return ApiResponseController::response($user,200);	
		
	}

	public function store(Request $request){
		
		$user = new User($request->all());
		$user->password = bcrypt($request->password);
		$user->save();

		return ApiResponseController::response($user,200);	

	}

	public function update(Request $request){
			
				$user = UserAuth::getAuthenticatedUser();
				

				$user->name = $request->name;

				if($request->email){
					$user->email = $request->email;
				}

				if($request->password){
					$user->password = bcrypt($request->password);
				}		

			$user->save();
			return ApiResponseController::response($user,200);
	}
	public function destroy(Request $request){

		$user = UserAuth::getAuthenticatedUser();


		$user->delete();

		return ApiResponseController::response($user,200);
		}

}
