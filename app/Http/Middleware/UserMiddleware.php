<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (authUser()->role == 'user') {
            return $next($request);
        }

        if (authUser()->role == 'canteen') {
            return redirect()->route('canteen.dashboard');
        }

        return redirect()->route('login');
    }
}
