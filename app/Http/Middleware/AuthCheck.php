<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        // dd($request->session());
        if (!$request->is('data/*') && $request->isMethod('get')) {
                if (!session()->has('url.intended')) {
                    session(['url.intended' => $request->path()]);
                    // dd($request->path());
                }
            }
        return $next($request);
    }
}
