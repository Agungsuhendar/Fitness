<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
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

        // Check if role is in explicit allowed list
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Check dynamic saved menu permissions matrix for 17 modules
        $savedPermissionsRaw = Setting::get('rbac_menu_permissions');
        if ($savedPermissionsRaw) {
            $matrix = json_decode($savedPermissionsRaw, true);
            $rolePerms = $matrix[$userRole] ?? [];

            $routeName = $request->route() ? $request->route()->getName() : '';
            
            // Map route names to all 17 module keys
            $moduleKeyMap = [
                'admin.pos.' => 'pos',
                'admin.products.' => 'pos',
                'admin.checkin.' => 'checkin',
                'admin.members.' => 'members',
                'admin.payments.' => 'payments',
                'admin.reports.' => 'reports',
                'admin.promos.' => 'promos',
                'admin.registrations' => 'registrations',
                'admin.trials' => 'trials',
                'admin.programs.' => 'programs',
                'admin.coaches.' => 'coaches',
                'admin.posts.' => 'posts',
                'admin.testimonials.' => 'testimonials',
                'admin.faqs.' => 'faqs',
                'admin.videos.' => 'videos',
                'admin.features.' => 'features',
                'admin.integrations.' => 'integrations',
                'admin.settings.' => 'settings',
            ];

            foreach ($moduleKeyMap as $prefix => $modKey) {
                if (str_starts_with($routeName, $prefix) || $routeName === $prefix) {
                    if (in_array($modKey, $rolePerms)) {
                        return $next($request);
                    }
                }
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Access denied for role: ' . $userRole], 403);
        }

        if ($userRole === 'member') {
            return redirect()->route('member.dashboard')->with('error', 'Akses ditolak: Area ini khusus Staf / Admin.');
        }

        return redirect()->route('admin.members.index')->with('error', 'Akses ditolak: Anda tidak memiliki wewenang untuk halaman ini.');
    }
}
