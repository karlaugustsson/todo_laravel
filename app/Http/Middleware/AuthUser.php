<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\UserAuth;
class AuthUser
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
        if (! UserAuth::getAuthenticatedUser()) {
                return ApiResponseController::response(['Errors' => 'user not found'], 404);
        }
        return $next($request);
    }
}
