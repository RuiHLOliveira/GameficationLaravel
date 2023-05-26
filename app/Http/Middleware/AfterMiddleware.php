<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        try {
            
            $response = $next($request);
            return $response;

        } catch (\Throwable $th) {
            //throw $th;

        } finally {

        }
 
    }
}