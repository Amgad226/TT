<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(true)
        {
                $response = [
                    'status' => 2,
                    'message' => 'Unauthorized',
                ];
        
        return response()->json($response, 413);
        }       
        return $next($request);
    }
}
