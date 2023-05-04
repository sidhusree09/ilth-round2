<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Admin
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
        if (!auth()->check() || (!auth()->user()->isAdmin() && !auth()->user()->isInstructor() )) {
            abort(403, 'Unauthorized action.');
        }
        
        if(auth()->user()->isInstructor() && strpos($request->route()->uri(), 'user') !== false){
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
}
