<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use App\Http\Controllers\ApiResponseController;
class SchemaValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $rules = [
            'name' => "required|min:3|max:60",
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            
            return ApiResponseController::response(["Errors" => $validator->messages()->all()],404);
        }

        return $next($request);
    }
}
