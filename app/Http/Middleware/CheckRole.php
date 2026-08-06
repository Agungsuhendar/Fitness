<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $userRole = $user->role ?? 'member';

        // Superadmin or admin bypasses all role checks
        if ($userRole === 'admin' || $userRole === 'superadmin') {
            return $next($request);
        }

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Access denied for role: ' . $userRole], 403);
        }

        if ($userRole === 'member') {
            return redirect()->route('member.dashboard')->with('error', 'Akses ditolak: Area ini khusus Staf / Admin.');
        }

        return redirect()->route('home')->with('error', 'Akses ditolak: Anda tidak memiliki wewenang untuk halaman ini.');
    }
}
