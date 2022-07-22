<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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

        // is auth in app
        if(!auth()->check()){
            return redirect('/');
        }

        // check is admin
        if(auth()->user()->role !== 'admin'){
            return redirect()->back()->with('error','You are not admin yet');
        }

        return $next($request);
    }
}
