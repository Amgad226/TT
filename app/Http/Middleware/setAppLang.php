<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class setAppLang
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
        $local=request('local',Cookie::get('local','en'));
        if(strlen($local)>2)
        {
            $local= Crypt::decrypt($local);
        }
        // dd($local);
        App::setlocale( $local);
        Cookie::queue('local', $local,60*24*365);
        return $next($request);
    }
}
