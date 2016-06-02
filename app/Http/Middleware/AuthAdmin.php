<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\UserAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class AuthAdmin
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
        if (! $user = UserAuth::getAuthenticatedUser()) {
                return ApiResponseController::response(['Errors' => 'user not found'], 404);
        }

        if(!$user->isAdmin()){

            return ApiResponseController::response(["error" =>"User has to be admin"],404);
        }
    
        return $next($request);
    }
}
