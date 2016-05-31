<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class UserAuth
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
        if( !User::find(1) ){
        
        return response()->json("Couldnt find the auth user",404);
            
        }
        return $next($request);


    }
}
