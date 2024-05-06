<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(404);
        }

        if ($user->role == 'user' && $request->routeIs('user.*')) {
            abort(403);
        }

        if ($user->role == 'admin' && $request->routeIs('trip.*')) {
            abort(403);
        }

        return $next($request);
    }
}