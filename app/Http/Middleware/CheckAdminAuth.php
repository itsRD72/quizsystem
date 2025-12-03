<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in using the admin guard
        if (!Auth::guard('admin')->check()) {
            return redirect('admin-login'); // redirect to login if not authenticated
        }

        return $next($request);
    }
}
