<?php

namespace App\Http\Middleware;

use Closure;
use anlutro\LaravelSettings\Facade as Setting;
use Auth;
use Log;

class Shutdown
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
        $isShutdown = (bool)Setting::get('shutdown') ?? false;
        $isOwner = (bool)Auth::user()->hasRole('Owner') ?? false;
        
        if ($isShutdown)
        {
            if (Auth::user()->id == 1 || $isOwner) return $next($request);
            abort(403, 'Your system is currently shut down.');
        }

        return $next($request);
    }
}
