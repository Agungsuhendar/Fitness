<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Les Renang Jogja')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: #f4f9fc;
        }
        .admin-sidebar {
            width: 260px;
            background: #0b132b;
            color: #94a3b8;
            padding: 1.75rem 1.25rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-weight: 800;
            font-size: 1.15rem;
            margin-bottom: 2.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #1c2541;
            text-decoration: none;
        }
        .admin-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex: 1;
        }
        .admin-nav-item a {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem 1.15rem;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.925rem;
            border-radius: 0.75rem;
            transition: all 0.25s ease;
        }
        .admin-nav-item a:hover, .admin-nav-item a.active {
            background: #0077b6;
            color: white;
        }
        .admin-main {
            flex: 1;
            padding: 2.25rem;
            overflow-y: auto;
        }
        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            background: white;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: var(--shadow-sm);
        }
        table.admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        table.admin-table th, table.admin-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
        }
        table.admin-table th {
            background: #f8fafc;
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--dark-surface);
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <i class="fa-solid fa-person-swimming" style="color: #00b4d8; font-size: 1.6rem;"></i>
                <span>Admin Les Renang</span>
            </a>

            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line"></i> Dashboard Overview
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-swatchbook"></i> Kelola Program
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-circle-question"></i> Kelola FAQ (20+)
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-newspaper"></i> Kelola Artikel Blog
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.registrations') }}" class="{{ request()->routeIs('admin.registrations') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-card"></i> Data Pendaftaran
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.trials') }}" class="{{ request()->routeIs('admin.trials') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-check"></i> Data Booking Trial
                    </a>
                </li>
            </ul>

            <div style="padding-top: 1.5rem; border-top: 1px solid #1c2541;">
                <a href="{{ route('home') }}" target="_blank" style="color: #90e0ef; font-weight: 700; text-decoration: none; font-size: 0.875rem; display: block; margin-bottom: 1rem;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Website Utama
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm" style="width: 100%; border-color: #ef4444; color: #ef4444;">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div>
                    <h1 style="font-size: 1.8rem;">@yield('header_title', 'Dashboard Overview')</h1>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Selamat datang di Panel Admin Les Renang Jogja</p>
                </div>
                <div>
                    <span style="background: #e0f2fe; color: var(--primary-dark); padding: 0.5rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.875rem;">
                        <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name ?? 'Admin' }}
                    </span>
                </div>
            </header>

            @if(session('success'))
                <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 1rem 1.25rem; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>
</body>
</html>
