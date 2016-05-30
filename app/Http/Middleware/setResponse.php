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
        $format = null;
        $content_type = $request->header("Content-Type");

        if($request->format != null){

         switch (strtolower($request->format)) {

            case 'json':

            $content_type = "application/json";
            
            break;
            
            case 'xml':
            
            $content_type = "application/xml";
            
            break;
            
            case 'text':
      
            $content_type = "text/plain";
       
            break;

            default:
            
            $content_type = "text/html";

            break;
        }

        }else{

            $content_type = ($request->header("Content-Type") == null ) ? "text/html" : $request->header("Content-Type") ;
        }
          
         return $next($request); 
        
    }
}
