<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     * Checks if the admin session is active; redirects to login otherwise.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('admin_logged_in')) {
            return redirect()->route('login')
                ->with('error', 'Please login to access the admin dashboard.');
        }

        return $next($request);
    }
}
