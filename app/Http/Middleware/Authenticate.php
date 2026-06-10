<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Authenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd($request->session());
        if($request->session()!= null)
        {
            //return back();
            return $next($request);
        }
        echo 'true';exit();
        //return $next($request);
        
    }
}
