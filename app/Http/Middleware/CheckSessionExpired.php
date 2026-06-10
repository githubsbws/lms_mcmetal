<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Events\SessionEnded;
use Illuminate\Support\Facades\Session;

class CheckSessionExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = Session::get('lastActivityTime');
            $lifetime = config('session.lifetime') * 60; // Convert minutes to seconds

            if ($lastActivity && (time() - $lastActivity) > $lifetime) {
                // Trigger the event for session end
                event(new SessionEnded(Auth::id()));
                Auth::logout();
                Session::flush();
            } else {
                Session::put('lastActivityTime', time());
            }
        }

        return $next($request);
    }
}
