<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Requests\Request;
use Validator;
use Illuminate\Http\Response;
use App\Http\Controllers\ApiResponseController;
class UserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
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
            
            return ApiResponseController::response(["errors" => $validator->messages()->all()],404);
        }

        return $next($request);
    }
}
