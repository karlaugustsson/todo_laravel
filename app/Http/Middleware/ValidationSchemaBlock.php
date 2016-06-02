<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use App\Http\Controllers\ApiResponseController;
class ValidationSchemaBlock
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
            'name' => "min:3|max:60",
            'desc' => "min:2|max:60",
            'start_time' => "required|date",
            'end_time' => "required|date",
        ];
    
        if ( $request->isMethod('patch') ){
            $rules["start_time"] = "date";
            $rules["end_time"] = "date";
        }
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            
            return ApiResponseController::response(["Errors" => $validator->messages()->all()],404);
        }

        return $next($request);
        return $next($request);
    }
}
