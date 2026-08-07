@extends('admin.layout')

@section('title', 'Manajemen Pengguna & Matriks Role RBAC - Admin FitLife Center')
@section('header_title', 'Manajemen Pengguna & Pengaturan Matriks Role RBAC')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 1rem 1.25rem; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-xmark" style="font-size: 1.2rem;"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Header & Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.4rem; color: #0f172a; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🔐 Kelola Pengguna &amp; Matriks Akses Menu (RBAC)
            </h3>
            <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                Atur peran akun &amp; centang seluruh modul menu yang boleh dibuka oleh masing-masing jabatan staf.
            </p>
        </div>

        <div style="display: flex; gap: 0.75rem;">
            <button type="button" onclick="toggleRbacMatrixModal()" class="btn" style="background: rgba(132,204,22,0.15); border: 1.5px solid #84cc16; color: #166534; border-radius: 0.85rem; font-weight: 800; padding: 0.75rem 1.25rem; display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                <i class="fa-solid fa-sliders"></i> Matriks Centang Akses Menu (17 Modul)
            </button>
            <button type="button" onclick="toggleAddStaffModal()" class="btn btn-primary" style="border-radius: 0.85rem; font-weight: 800; padding: 0.75rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 8px 20px rgba(2, 132, 199, 0.25);">
                <i class="fa-solid fa-user-plus"></i> + Tambah Akun Staf Baru
            </button>
        </div>
    </div>

    <!-- Role Summary Metric Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card" style="padding: 1.15rem; border-radius: 1.15rem; background: #ffffff; border: 1px solid #e2e8f0;">
            <span style="font-size: 0.725rem; font-weight: 800; color: #64748b; text-transform: uppercase;">TOTAL PENGGUNA</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #0f172a; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $roleCounts['total'] }} Akun
            </div>
        </div>

        <div class="admin-card" style="padding: 1.15rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #ef4444;">
            <span style="font-size: 0.725rem; font-weight: 800; color: #ef4444; text-transform: uppercase;">👑 ADMIN OWNER</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #ef4444; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $roleCounts['admin'] }} User
            </div>
        </div>

        <div class="admin-card" style="padding: 1.15rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #0284c7;">
            <span style="font-size: 0.725rem; font-weight: 800; color: #0284c7; text-transform: uppercase;">🧾 KASIR / RESEPSIONIS</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #0284c7; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $roleCounts['receptionist'] }} User
            </div>
        </div>

        <div class="admin-card" style="padding: 1.15rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #8b5cf6;">
            <span style="font-size: 0.725rem; font-weight: 800; color: #8b5cf6; text-transform: uppercase;">🏋️ PERSONAL TRAINER</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #8b5cf6; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $roleCounts['coach'] }} User
            </div>
        </div>

        <div class="admin-card" style="padding: 1.15rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #16a34a;">
            <span style="font-size: 0.725rem; font-weight: 800; color: #16a34a; text-transform: uppercase;">👤 MEMBER STUDIO</span>
            <div style="font-size: 1.6rem; font-weight: 900; color: #16a34a; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $roleCounts['member'] }} User
            </div>
        </div>
    </div>

    <!-- RBAC Menu Permission Matrix Form Box (Complete 17 Modules) -->
    <div id="rbacMatrixBox" class="admin-card" style="display: none; padding: 1.75rem; border-radius: 1.25rem; background: #ffffff; border: 2px solid #84cc16; margin-bottom: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.75rem;">
            <div>
                <h4 style="font-size: 1.15rem; color: #15803d; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-sliders"></i> Matriks Pengaturan Akses Modul Menu RBAC (17 Modul Lengkap)
                </h4>
                <p style="font-size: 0.8rem; color: #64748b; margin: 0.2rem 0 0;">
                    Centang modul menu mana saja yang boleh dibuka oleh masing-masing jabatan staf operasional.
                </p>
            </div>
            <button type="button" onclick="toggleRbacMatrixModal()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #94a3b8;">&times;</button>
        </div>

        <form action="{{ route('admin.users.update-permissions') }}" method="POST">
            @csrf
            <div style="overflow-x: auto; margin-bottom: 1.25rem; max-height: 420px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #334155; position: sticky; top: 0;">
                            <th style="padding: 0.85rem 1rem;">NAMA MODUL MENU ADMIN</th>
                            <th style="padding: 0.85rem 1rem; text-align: center;">👑 ADMIN OWNER</th>
                            <th style="padding: 0.85rem 1rem; text-align: center;">🧾 RESEPSIONIS / KASIR</th>
                            <th style="padding: 0.85rem 1rem; text-align: center;">🏋️ PERSONAL TRAINER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $allModules = [
                                'pos' => '🛒 POS Kasir & Toko Studio',
                                'checkin' => '📱 Kiosk Presensi Studio',
                                'members' => '👥 Manajemen Member & Top-Up',
                                'payments' => '💳 Verifikasi Pembayaran (Midtrans)',
                                'reports' => '📊 Laporan Keuangan & Omset',
                                'promos' => '🎟️ Voucher Promo Diskon',
                                'registrations' => '📋 Data Pendaftaran Lead',
                                'trials' => '📅 Data Booking Trial',
                                'programs' => '🏋️ Kelola Program Studio',
                                'coaches' => '👨‍🏫 Kelola Pelatih (Coach)',
                                'posts' => '📰 Kelola Artikel Blog',
                                'testimonials' => '💬 Kelola Testimoni Member',
                                'faqs' => '❓ Kelola Pertanyaan FAQ',
                                'videos' => '🎬 Kelola Galeri Video',
                                'features' => '⭐ Kelola Keunggulan Studio',
                                'integrations' => '🔌 Integrasi Midtrans & WA Gateway',
                                'settings' => '⚙️ Pengaturan Website',
                            ];
                        @endphp

                        @foreach($allModules as $key => $label)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 0.75rem 1rem; font-weight: 800; color: #0f172a;">
                                {{ $label }}
                            </td>
                            <td style="padding: 0.75rem 1rem; text-align: center;">
                                <input type="checkbox" checked disabled style="width: 18px; height: 18px; accent-color: #ef4444;">
                            </td>
                            <td style="padding: 0.75rem 1rem; text-align: center;">
                                <input type="checkbox" name="permissions[receptionist][{{ $key }}]" value="1" {{ in_array($key, $menuPermissions['receptionist'] ?? []) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #0284c7; cursor: pointer;">
                            </td>
                            <td style="padding: 0.75rem 1rem; text-align: center;">
                                <input type="checkbox" name="permissions[coach][{{ $key }}]" value="1" {{ in_array($key, $menuPermissions['coach'] ?? []) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #8b5cf6; cursor: pointer;">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" onclick="toggleRbacMatrixModal()" class="btn" style="background: #f1f5f9; color: #475569; border: none; padding: 0.65rem 1.25rem; border-radius: 0.65rem; font-weight: 800;">Batal</button>
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.35rem;">
                    💾 Simpan Matriks Hak Akses RBAC
                </button>
            </div>
        </form>
    </div>

    <!-- Add Staff Modal Form Box (Hidden by default) -->
    <div id="addStaffModal" class="admin-card" style="display: none; padding: 1.75rem; border-radius: 1.25rem; background: #ffffff; border: 2px solid #0284c7; margin-bottom: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.75rem;">
            <h4 style="font-size: 1.15rem; color: #0284c7; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-user-shield"></i> Form Pendaftaran Akun Staf / Pengelola Baru
            </h4>
            <button type="button" onclick="toggleAddStaffModal()" style="background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #94a3b8;">&times;</button>
        </div>

        <form action="{{ route('admin.users.store-staff') }}" method="POST" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">NAMA LENGKAP STAF *</label>
                <input type="text" name="name" placeholder="e.g. Maya Resepsionis" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">ALAMAT EMAIL *</label>
                <input type="email" name="email" placeholder="e.g. maya.kasir@fitlife.id" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">NOMOR WHATSAPP *</label>
                <input type="text" name="phone" placeholder="e.g. 081298765432" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">PASSWORD *</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">JABATAN PERAN (ROLE RBAC) *</label>
                <select name="role" required style="width: 100%; border: 1.5px solid #0284c7; border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
                    <option value="receptionist">🧾 Resepsionis / Kasir POS Studio</option>
                    <option value="coach">🏋️ Personal Trainer (Coach)</option>
                    <option value="admin">👑 Admin / Owner (Akses Penuh)</option>
                    <option value="member">👤 Member Studio Standard</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.15rem;">
                    🚀 Simpan Akun Staf
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table Box & Filter -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
        
        <!-- Filter Tabs & Search Bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <a href="{{ route('admin.users.index', ['role_filter' => 'all', 'q' => $q]) }}" class="btn" style="background: {{ $roleFilter === 'all' ? '#0f172a' : '#f1f5f9' }}; color: {{ $roleFilter === 'all' ? 'white' : '#475569' }}; padding: 0.45rem 0.95rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    Semua Role
                </a>
                <a href="{{ route('admin.users.index', ['role_filter' => 'admin', 'q' => $q]) }}" class="btn" style="background: {{ $roleFilter === 'admin' ? '#ef4444' : '#f1f5f9' }}; color: {{ $roleFilter === 'admin' ? 'white' : '#475569' }}; padding: 0.45rem 0.95rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    👑 Admin
                </a>
                <a href="{{ route('admin.users.index', ['role_filter' => 'receptionist', 'q' => $q]) }}" class="btn" style="background: {{ $roleFilter === 'receptionist' ? '#0284c7' : '#f1f5f9' }}; color: {{ $roleFilter === 'receptionist' ? 'white' : '#475569' }}; padding: 0.45rem 0.95rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    🧾 Kasir
                </a>
                <a href="{{ route('admin.users.index', ['role_filter' => 'coach', 'q' => $q]) }}" class="btn" style="background: {{ $roleFilter === 'coach' ? '#8b5cf6' : '#f1f5f9' }}; color: {{ $roleFilter === 'coach' ? 'white' : '#475569' }}; padding: 0.45rem 0.95rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    🏋️ Trainer
                </a>
                <a href="{{ route('admin.users.index', ['role_filter' => 'member', 'q' => $q]) }}" class="btn" style="background: {{ $roleFilter === 'member' ? '#16a34a' : '#f1f5f9' }}; color: {{ $roleFilter === 'member' ? 'white' : '#475569' }}; padding: 0.45rem 0.95rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                    👤 Member
                </a>
            </div>

            <form method="GET" action="{{ route('admin.users.index') }}" style="display: flex; gap: 0.5rem;">
                <input type="hidden" name="role_filter" value="{{ $roleFilter }}">
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama / email / WA..." style="border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.45rem 0.85rem; font-size: 0.825rem; font-weight: 700; outline: none;">
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; padding: 0.45rem 0.85rem; font-size: 0.825rem; font-weight: 800;">Cari</button>
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569;">
                        <th style="padding: 0.85rem 1rem;">CARD ID / ID</th>
                        <th style="padding: 0.85rem 1rem;">NAMA PENGGUNA</th>
                        <th style="padding: 0.85rem 1rem;">EMAIL &amp; WHATSAPP</th>
                        <th style="padding: 0.85rem 1rem;">HAK AKSES RBAC SAAT INI</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">UBAH ROLE RBAC INSTAN</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php $userRole = $user->role ?: 'member'; @endphp
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 0.85rem 1rem; font-weight: 800; font-family: monospace; color: #0284c7;">
                            {{ $user->member_card_id ?: ('USR-' . $user->id) }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <div style="font-weight: 900; color: #0f172a;">{{ $user->name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">Terdaftar: {{ $user->created_at->format('d M Y') }}</div>
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <div style="font-weight: 700; color: #334155;">{{ $user->email }}</div>
                            <div style="font-size: 0.775rem; color: #64748b;">WA: {{ $user->phone ?: '-' }}</div>
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            @if($userRole === 'admin' || $userRole === 'superadmin')
                                <span style="background: #fee2e2; color: #991b1b; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid #fca5a5;">
                                    👑 ADMIN / OWNER
                                </span>
                            @elseif($userRole === 'receptionist' || $userRole === 'kasir')
                                <span style="background: #e0f2fe; color: #0369a1; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid #7dd3fc;">
                                    🧾 RESEPSIONIS / KASIR
                                </span>
                            @elseif($userRole === 'coach' || $userRole === 'pt')
                                <span style="background: #f3e8ff; color: #6b21a8; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid #d8b4fe;">
                                    🏋️ PERSONAL TRAINER
                                </span>
                            @else
                                <span style="background: #dcfce7; color: #16a34a; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid #86efac;">
                                    👤 MEMBER STUDIO
                                </span>
                            @endif
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()" style="border: 1.5px solid #cbd5e1; border-radius: 0.5rem; padding: 0.35rem 0.6rem; font-size: 0.8rem; font-weight: 800; outline: none; cursor: pointer; background: #ffffff;">
                                    <option value="member" {{ $userRole === 'member' ? 'selected' : '' }}>👤 Member</option>
                                    <option value="receptionist" {{ in_array($userRole, ['receptionist','kasir']) ? 'selected' : '' }}>🧾 Resepsionis Kasir</option>
                                    <option value="coach" {{ in_array($userRole, ['coach','pt']) ? 'selected' : '' }}>🏋️ Personal Trainer</option>
                                    <option value="admin" {{ in_array($userRole, ['admin','superadmin']) ? 'selected' : '' }}>👑 Admin Owner</option>
                                </select>
                            </form>
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            @if(auth()->id() != $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus akun pengguna {{ $user->name }}?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: #fee2e2; color: #ef4444; border: none; padding: 0.35rem 0.65rem; border-radius: 0.4rem; font-weight: 800; font-size: 0.75rem; cursor: pointer;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                            @else
                                <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 700;">(Anda)</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.25rem;">
            {{ $users->links() }}
        </div>
    </div>

</div>

<script>
    function toggleAddStaffModal() {
        const modal = document.getElementById('addStaffModal');
        if (modal) {
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        }
    }
    function toggleRbacMatrixModal() {
        const box = document.getElementById('rbacMatrixBox');
        if (box) {
            box.style.display = box.style.display === 'none' ? 'block' : 'none';
        }
    }
</script>
@endsection
