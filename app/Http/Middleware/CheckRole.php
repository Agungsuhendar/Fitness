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
        $routeName = $request->route() ? $request->route()->getName() : '';

        // 1. Check Subscription Tier Feature Gate
        $activeTier = Setting::get('subscription_tier', 'enterprise');
        $tierAllowed = [
            'starter' => ['members', 'checkin', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'settings'],
            'pro' => ['members', 'checkin', 'pos', 'payments', 'reports', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'settings'],
            'enterprise' => ['members', 'checkin', 'pos', 'payments', 'reports', 'promos', 'classes', 'inventory-log', 'wa-broadcast', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'integrations', 'users', 'settings'],
        ];
        $allowedModules = $tierAllowed[$activeTier] ?? $tierAllowed['enterprise'];

        // Map route names to module keys
        $moduleKeyMap = [
            'admin.pos.' => 'pos',
            'admin.products.' => 'pos',
            'admin.checkin.' => 'checkin',
            'admin.members.' => 'members',
            'admin.payments.' => 'payments',
            'admin.reports.' => 'reports',
            'admin.promos.' => 'promos',
            'admin.classes.' => 'classes',
            'admin.inventory-log.' => 'inventory-log',
            'admin.wa-broadcast.' => 'wa-broadcast',
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
            'admin.users.' => 'users',
            'admin.settings.' => 'settings',
        ];

        // Determine current module key
        $currentModKey = null;
        foreach ($moduleKeyMap as $prefix => $modKey) {
            if (str_starts_with($routeName, $prefix) || $routeName === $prefix) {
                $currentModKey = $modKey;
                break;
            }
        }

        // Block if module is not allowed by active Subscription Tier (except settings so admin can upgrade)
        if ($currentModKey && $currentModKey !== 'settings' && !in_array($currentModKey, $allowedModules)) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Module locked under current subscription tier.'], 403);
            }
            return redirect()->route('admin.members.index')
                ->with('error', '🔒 Akses Modul Dikunci: Halaman ini memerlukan Upgrade ke Paket Pro / Enterprise.');
        }

        // 2. Superadmin or Admin Role Bypass
        if ($userRole === 'admin' || $userRole === 'superadmin') {
            return $next($request);
        }

        // 3. Role Check
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // 4. Check dynamic saved RBAC permission matrix
        $savedPermissionsRaw = Setting::get('rbac_menu_permissions');
        if ($savedPermissionsRaw) {
            $matrix = json_decode($savedPermissionsRaw, true);
            $rolePerms = $matrix[$userRole] ?? [];

            if ($currentModKey && in_array($currentModKey, $rolePerms)) {
                return $next($request);
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
