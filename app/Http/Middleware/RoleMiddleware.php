<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        // Admin has full access
        if ($user->role === \App\Enums\UserRole::ADMIN) {
            return $next($request);
        }

        if ($user->role->value !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
