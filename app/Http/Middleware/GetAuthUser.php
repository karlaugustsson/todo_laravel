<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
class GetAuthUser
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
        if (! $user = JWTAuth::parseToken()->authenticate()) {
                return ApiResponseController::response(['Errors' => 'user not found'], 404);
        }
        return $next($request);
    }
}
