<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsKasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access kasir area.');
        }

        $user = auth()->user();
        
        // Refresh user from database to ensure we have latest role
        $user->refresh();
        
        if (!$user->isKasir()) {
            abort(403, 'Unauthorized access. Kasir role required. Your current role: ' . ($user->role ?? 'not set'));
        }

        return $next($request);
    }
}

