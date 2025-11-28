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
        if (!$request->session()->has('user')) {
            // dd(session('user')['nama_user']) ;  
            if (!session()->has('url.intended')) {
                session(['url.intended' => $request->path()]);
                // dd($request->path());
            }
            return redirect('/')->with(
                ['error' => 'Silakan Login Terlebih Dahulu']
            );
        }
        return $next($request);
    }
}
