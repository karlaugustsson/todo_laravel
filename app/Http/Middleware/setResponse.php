<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class setResponse
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

         
          $response = $next($request); 
          $content_type = ($request->header("Content-Type") == null ) ? "text/html" : $request->header("Content-Type") ;
         

        $response->header("Content-Type",$content_type);
        return $response;
        
    }
}
