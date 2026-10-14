<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnsureRole
 *
 * Middleware to enforce role-based access control (RBAC).
 */
class EnsureRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to access this portal.');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // If admin is logged in, redirect them to admin dashboard
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('error', 'Access restricted to District Officers.');
            }

            // If district officer is logged in, redirect them to district officer dashboard
            if ($user->isDistrictOfficer()) {
                return redirect()->route('officer.dashboard')->with('error', 'Access restricted to Central Administrators.');
            }

            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
