<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND has the 'admin' role
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // Redirect or abort if not authorized
        return abort(403, 'Unauthorized action. Admin access required.');
    }
}