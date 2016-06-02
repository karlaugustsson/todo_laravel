<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Http\Controllers\ApiResponseController;
class AdminAuth
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
        if( ! $user = User::find(1) ){
        
        return ApiResponseController::response(["error" =>"Couldnt find the auth user"],404);
            
        }
        if(!$user->isAdmin()){

            return ApiResponseController::response(["error" =>"User has to be admin"],404);
        }
    
        return $next($request);
    }
}
