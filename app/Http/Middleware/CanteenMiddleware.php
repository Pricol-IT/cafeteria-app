<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanteenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (authUser()->role == 'canteen') {
            return $next($request);
        }

        if (authUser()->role == 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('login');
    }
}
