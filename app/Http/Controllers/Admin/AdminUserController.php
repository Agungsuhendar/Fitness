<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $roleFilter = $request->input('role_filter', 'all');
        $q = trim($request->input('q'));

        $query = User::query();

        if ($roleFilter !== 'all') {
            $query->where('role', $roleFilter);
        }

        if ($q) {
            $query->where(function($b) use ($q) {
                $b->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('phone', 'like', "%{$q}%")
                  ->orWhere('member_card_id', 'like', "%{$q}%");
            });
        }

        $users = $query->orderByDesc('created_at')->paginate(15);
        $roleCounts = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'receptionist' => User::whereIn('role', ['receptionist', 'kasir'])->count(),
            'coach' => User::whereIn('role', ['coach', 'pt'])->count(),
            'member' => User::where(function($b){ $b->where('role', 'member')->orWhereNull('role'); })->count(),
        ];

        // Dynamic Menu Permissions matrix
        $defaultPermissions = [
            'receptionist' => ['pos', 'checkin', 'members', 'payments'],
            'coach' => ['checkin', 'members'],
            'member' => [],
        ];

        $savedPermissionsRaw = Setting::get('rbac_menu_permissions');
        $menuPermissions = $savedPermissionsRaw ? json_decode($savedPermissionsRaw, true) : $defaultPermissions;

        return view('admin.users.index', compact('users', 'roleFilter', 'q', 'roleCounts', 'menuPermissions'));
    }

    public function updateMenuPermissions(Request $request)
    {
        $permissions = $request->input('permissions', []);
        
        // Ensure structure for all roles
        $matrix = [
            'receptionist' => isset($permissions['receptionist']) ? array_keys($permissions['receptionist']) : [],
            'coach' => isset($permissions['coach']) ? array_keys($permissions['coach']) : [],
            'member' => isset($permissions['member']) ? array_keys($permissions['member']) : [],
        ];

        Setting::set('rbac_menu_permissions', json_encode($matrix));

        return redirect()->route('admin.users.index')
            ->with('success', 'Matriks Centang Menu RBAC Berhasil Diperbarui & Disimpan!');
    }

    public function storeStaff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:30|unique:users,phone',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,receptionist,coach,member',
        ]);

        $randomCardId = 'FL-STAF-' . rand(1000, 9999);

        User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'phone' => preg_replace('/[^0-9]/', '', $validated['phone']),
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'member_card_id' => $randomCardId,
            'status' => 'Aktif (Staf Operasional)',
            'branch' => 'FitLife HQ Sleman',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun Staf Baru "' . $validated['name'] . '" dengan Role [' . strtoupper($validated['role']) . '] BERHASIL DITAMBAHKAN!');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role' => 'required|in:admin,receptionist,coach,member',
        ]);

        $oldRole = $user->role ?: 'member';
        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Hak Akses RBAC pengguna "' . $user->name . '" telah diubah dari [' . strtoupper($oldRole) . '] menjadi [' . strtoupper($user->role) . ']!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif!');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna "' . $name . '" telah dihapus dari sistem.');
    }
}
