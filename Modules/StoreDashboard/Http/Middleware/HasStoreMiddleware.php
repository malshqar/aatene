<?php

namespace Modules\StoreDashboard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->store){
            return to_route('home');
        }
        return $next($request);
    }
}
