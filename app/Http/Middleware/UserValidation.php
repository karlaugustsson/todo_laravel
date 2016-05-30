<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Requests\Request;
use Validator;
use Illuminate\Http\Response;
class UserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rules = [
            'name' => "required|min:3|max:40",
            'email' => "required|unique:users|Email|max:160",
            'password' => "required"
            ];

        if($request->isMethod('patch')) {
        
        $rules = [
            'name' => "required|min:3|max:40",
            'email' => "unique:users|Email|max:160"
            ];
            
        }
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            
            return response(array("errors" => $validator->messages()->all()),404)->header("Content-Type" , "application/json");
        }

        return $next($request);
    }
}
