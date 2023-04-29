<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            app()->setLocale(Auth::user()->language);
            Carbon::setLocale(Auth::user()->language);
            // Guests use the language set in the session
        } else {
            app()->setLocale(session('locale', 'en'));
            Carbon::setLocale(session('locale', 'en'));
        }
        return $next($request);
    }
}
