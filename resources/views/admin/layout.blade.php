<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard & Studio Operations - FitLife Gym Jogja')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        (function() {
            const savedAdminTheme = localStorage.getItem('fitlife_admin_theme') || 'lime';
            document.documentElement.setAttribute('data-admin-theme', savedAdminTheme);
        })();
    </script>
    <style>
        :root, :root[data-admin-theme="lime"] {
            --admin-bg: #060907;
            --admin-card-bg: #0d1410;
            --admin-card-hover: #121c17;
            --admin-border: rgba(255, 255, 255, 0.08);
            --brand-lime: #84cc16;
            --brand-lime-dark: #65a30d;
            --brand-glow: rgba(132, 204, 22, 0.4);
            --brand-glow-subtle: rgba(132, 204, 22, 0.12);
        }

        :root[data-admin-theme="cyberpunk"] {
            --brand-lime: #f43f5e;
            --brand-lime-dark: #e11d48;
            --brand-glow: rgba(244, 63, 94, 0.4);
            --brand-glow-subtle: rgba(244, 63, 94, 0.12);
        }

        :root[data-admin-theme="cyan"] {
            --brand-lime: #06b6d4;
            --brand-lime-dark: #0891b2;
            --brand-glow: rgba(6, 182, 212, 0.4);
            --brand-glow-subtle: rgba(6, 182, 212, 0.12);
        }

        :root[data-admin-theme="gold"] {
            --brand-lime: #eab308;
            --brand-lime-dark: #ca8a04;
            --brand-glow: rgba(234, 179, 8, 0.4);
            --brand-glow-subtle: rgba(234, 179, 8, 0.12);
        }

        :root[data-admin-theme="violet"] {
            --brand-lime: #8b5cf6;
            --brand-lime-dark: #7c3aed;
            --brand-glow: rgba(139, 92, 246, 0.4);
            --brand-glow-subtle: rgba(139, 92, 246, 0.12);
        }

        /* Universal Admin Auto Theme Adaptor Rules */
        .text-primary, [style*="color: #84cc16"], [style*="color:#84cc16"] {
            color: var(--brand-lime) !important;
        }
        .btn-primary, [style*="background: #84cc16"], [style*="background:#84cc16"], [style*="background: rgb(132, 204, 22)"] {
            background-color: var(--brand-lime) !important;
            color: #060907 !important;
        }
        [style*="border: 1.5px solid #84cc16"], [style*="border: 2px solid #84cc16"], [style*="border: 1px solid #84cc16"], [style*="border-top: 4px solid #84cc16"] {
            border-color: var(--brand-lime) !important;
        }
        [style*="rgba(132, 204, 22, 0.15)"], [style*="rgba(132, 204, 22, 0.12)"], [style*="rgba(132, 204, 22, 0.1)"], [style*="rgba(132, 204, 22, 0.2)"], [style*="rgba(132, 204, 22, 0.3)"], [style*="rgba(132, 204, 22, 0.08)"] {
            background-color: var(--brand-glow-subtle) !important;
        }
        [style*="linear-gradient(135deg, #84cc16 0%, #10b981 100%)"], [style*="linear-gradient(135deg,#84cc16 0%,#10b981 100%)"] {
            background: linear-gradient(135deg, var(--brand-lime) 0%, var(--brand-lime-dark) 100%) !important;
        }

        .text-lime {
            color: var(--brand-lime, #84cc16) !important;
        }
        .btn-lime {
            background: linear-gradient(135deg, var(--brand-lime, #84cc16) 0%, var(--brand-lime-dark, #65a30d) 100%) !important;
            color: #060907 !important;
            border: none !important;
            font-weight: 800 !important;
        }
        .btn-lime:hover {
            opacity: 0.95;
            color: #060907 !important;
        }
        .border-lime {
            border-color: var(--brand-lime, #84cc16) !important;
        }
        .form-control.bg-dark, .form-select.bg-dark {
            background-color: #0d1410 !important;
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.15) !important;
            border-radius: 0.85rem !important;
            padding: 0.65rem 0.95rem !important;
        }
        .form-control.bg-dark:focus, .form-select.bg-dark:focus {
            background-color: #121c17 !important;
            color: #ffffff !important;
            border-color: var(--brand-lime, #84cc16) !important;
            box-shadow: 0 0 0 0.25rem var(--brand-glow-subtle, rgba(132, 204, 22, 0.25)) !important;
        }
        .form-select.bg-dark option {
            background-color: #0d1410 !important;
            color: #ffffff !important;
        }

        * {
            box-sizing: border-box;
        }

        html, body.admin-body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: var(--admin-bg) !important;
            color: #f8fafc !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: radial-gradient(circle at 10% 20%, var(--brand-glow-subtle) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(6, 182, 212, 0.03) 0%, transparent 40%),
                        #060907;
        }

        /* ---------------------------------------------------- */
        /* GLASSMORPHIC ADMIN SIDEBAR                           */
        /* ---------------------------------------------------- */
        .admin-sidebar {
            width: 280px;
            background: rgba(13, 20, 16, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            color: #cbd5e1;
            padding: 1.5rem 1.15rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid var(--admin-border);
            z-index: 100;
        }

        .nav-text {
            display: inline-block !important;
            font-weight: 700 !important;
            margin-left: 0.6rem;
            font-size: 0.9rem;
        }

        .admin-wrapper.collapsed .admin-sidebar {
            width: 88px;
        }
        .admin-wrapper.collapsed .nav-text,
        .admin-wrapper.collapsed .nav-section-title,
        .admin-wrapper.collapsed .sidebar-bottom-text {
            display: none !important;
        }
        .admin-wrapper.collapsed .admin-brand {
            justify-content: center;
        }
        .admin-wrapper.collapsed .admin-brand img {
            height: 38px !important;
        }
        .admin-wrapper.collapsed .admin-nav-item a {
            justify-content: center;
            padding: 0.85rem 0;
        }
        .admin-wrapper.collapsed .admin-nav-item a i {
            font-size: 1.25rem;
            margin: 0;
        }
        .admin-wrapper.collapsed .sidebar-bottom-link,
        .admin-wrapper.collapsed .sidebar-logout-btn {
            justify-content: center;
            padding: 0.75rem 0;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: white;
            font-weight: 900;
            font-size: 1.15rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1.15rem;
            border-bottom: 1px solid var(--admin-border);
            text-decoration: none;
            font-family: 'Outfit', sans-serif;
        }

        .admin-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex: 1;
            padding: 0;
            margin: 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255,255,255,0.1) transparent;
        }

        .nav-section-title {
            font-size: 0.675rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin: 1.15rem 0.75rem 0.35rem;
        }

        .admin-nav-item a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #94a3b8 !important;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 0.85rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            border: 1px solid transparent;
        }
        .admin-nav-item a i {
            color: #64748b;
            font-size: 1.1rem;
            transition: all 0.25s ease;
            width: 20px;
            text-align: center;
        }
        .admin-nav-item a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }
        .admin-nav-item a:hover i {
            color: var(--brand-lime);
        }
        .admin-nav-item a.active {
            background: linear-gradient(135deg, var(--brand-lime) 0%, #10b981 100%) !important;
            color: #060907 !important;
            font-weight: 900 !important;
            box-shadow: 0 0 25px var(--brand-glow) !important;
            border-color: transparent !important;
        }
        .admin-nav-item a.active i,
        .admin-nav-item a.active .nav-text {
            color: #060907 !important;
        }

        /* ---------------------------------------------------- */
        /* MAIN CONTENT AREA & FLOATING GLASS HEADER            */
        /* ---------------------------------------------------- */
        .admin-main {
            flex: 1;
            padding: 1.75rem 2.25rem;
            overflow-y: auto;
            min-width: 0;
        }

        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 1.15rem 1.75rem;
            background: rgba(13, 20, 16, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--admin-border);
            border-radius: 1.25rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .admin-header h1 {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 1.65rem;
            margin: 0;
            color: #ffffff !important;
            letter-spacing: -0.02em;
        }

        .sidebar-toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--admin-border);
            color: #94a3b8;
            width: 44px;
            height: 44px;
            border-radius: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 1.15rem;
        }
        .sidebar-toggle-btn:hover {
            background: var(--brand-lime);
            border-color: var(--brand-lime);
            color: #060907;
            box-shadow: 0 0 20px var(--brand-glow);
        }

        /* ---------------------------------------------------- */
        /* UNIVERSAL DARK GLASS CARDS & TABLES                  */
        /* ---------------------------------------------------- */
        .admin-card {
            background: var(--admin-card-bg) !important;
            border-radius: 1.25rem !important;
            border: 1px solid var(--admin-border) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #ffffff !important;
        }
        .admin-card-hover:hover {
            transform: translateY(-4px);
            border-color: var(--brand-lime) !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6), 0 0 25px var(--brand-glow-subtle) !important;
        }

        /* Text Contrast Overrides inside Cards */
        .admin-card h1, .admin-card h2, .admin-card h3, .admin-card h4, .admin-card h5, .admin-card h6 {
            color: #ffffff !important;
        }
        .admin-card p, .admin-card span, .admin-card label {
            color: #cbd5e1;
        }
        .admin-card .text-muted, .admin-card small {
            color: #94a3b8 !important;
        }

        /* Universal Form Control Styling for Dark Theme */
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            color: #ffffff !important;
            background-color: #090e0b !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.75rem !important;
            padding: 0.75rem 1rem !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            transition: all 0.25s ease !important;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--brand-lime) !important;
            box-shadow: 0 0 15px var(--brand-glow-subtle) !important;
            outline: none !important;
        }
        input::placeholder, textarea::placeholder {
            color: #64748b !important;
        }

        /* Universal Tables Dark Glass Styling */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            background: var(--admin-card-bg);
            border-radius: 1.25rem;
            border: 1px solid var(--admin-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            -webkit-overflow-scrolling: touch;
        }
        table.admin-table, table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            color: #f8fafc !important;
        }
        table.admin-table th, table th {
            background: rgba(255, 255, 255, 0.03) !important;
            font-weight: 800 !important;
            font-size: 0.8rem !important;
            color: #94a3b8 !important;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 1.1rem 1.25rem !important;
            border-bottom: 1px solid var(--admin-border) !important;
        }
        table.admin-table td, table td {
            padding: 1.1rem 1.25rem !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
            color: #e2e8f0 !important;
        }
        table.admin-table tr:hover td, table tr:hover td {
            background-color: var(--brand-glow-subtle) !important;
        }

        /* Mobile Backdrop Overlay */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(6, 9, 7, 0.85);
            backdrop-filter: blur(8px);
            z-index: 1040;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-backdrop.active {
            display: block;
            opacity: 1;
        }

        /* Responsive Breakpoints (< 992px) */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -290px;
                width: 280px !important;
                z-index: 1050;
                box-shadow: 10px 0 40px rgba(0, 0, 0, 0.8);
            }
            .admin-wrapper.mobile-open .admin-sidebar {
                left: 0;
            }
            .admin-main {
                padding: 1.25rem 1rem !important;
                width: 100%;
            }
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .admin-header > div:last-child {
                align-self: stretch;
                display: flex;
                justify-content: space-between;
                width: 100%;
        }

        /* Fullscreen Standalone Kiosk & POS Mode - Separate Rules to Prevent Parser Invalidation */
        body.is-fullscreen-mode .admin-sidebar,
        body.is-fullscreen-mode .admin-header,
        body.is-fullscreen-mode .sidebar-backdrop,
        body.is-fullscreen-mode footer,
        body.is-fullscreen-mode header,
        body.is-fullscreen-mode nav,
        body.is-fullscreen-mode .floating-action-stack,
        body.is-fullscreen-mode #aiChatbotModal,
        body.is-fullscreen-mode #pwaInstallBanner,
        body.is-fullscreen-mode #pwaInstructionModal {
            display: none !important;
            height: 0 !important;
            width: 0 !important;
            opacity: 0 !important;
            pointer-events: none !important;
            visibility: hidden !important;
        }

        body.is-fullscreen-mode .admin-wrapper {
            grid-template-columns: 1fr !important;
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            min-height: 100vh !important;
        }

        body.is-fullscreen-mode .admin-main {
            padding: 0.75rem 1rem !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }

        :fullscreen .admin-sidebar,
        :fullscreen .admin-header,
        :fullscreen .sidebar-backdrop,
        :fullscreen footer,
        :fullscreen header,
        :fullscreen nav,
        :fullscreen .floating-action-stack,
        :fullscreen #aiChatbotModal,
        :fullscreen #pwaInstallBanner,
        :fullscreen #pwaInstructionModal {
            display: none !important;
        }

        :fullscreen .admin-wrapper {
            grid-template-columns: 1fr !important;
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        :fullscreen .admin-main {
            padding: 0.75rem 1rem !important;
            margin: 0 !important;
            width: 100% !important;
        }

        :-webkit-full-screen .admin-sidebar,
        :-webkit-full-screen .admin-header,
        :-webkit-full-screen .sidebar-backdrop,
        :-webkit-full-screen footer,
        :-webkit-full-screen header,
        :-webkit-full-screen nav,
        :-webkit-full-screen .floating-action-stack,
        :-webkit-full-screen #aiChatbotModal,
        :-webkit-full-screen #pwaInstallBanner,
        :-webkit-full-screen #pwaInstructionModal {
            display: none !important;
        }

        :-webkit-full-screen .admin-wrapper {
            grid-template-columns: 1fr !important;
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
        }

        :-webkit-full-screen .admin-main {
            padding: 0.75rem 1rem !important;
            margin: 0 !important;
            width: 100% !important;
        }
    </style>
</head>
<body class="admin-body">
    <!-- Backdrop Overlay for Mobile Drawer -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-wrapper" id="adminWrapper">
        <aside class="admin-sidebar" id="adminSidebar">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                <!-- CLEAN LOGO WITHOUT LABELS -->
                <a href="{{ route('admin.dashboard') }}" class="admin-brand" style="margin-bottom: 0; border-bottom: none; padding-bottom: 0; gap: 0;">
                    @php $adminLogoUrl = site_setting('site_logo_footer', 'images/logo-footer.webp'); @endphp
                    <img src="{{ Str::startsWith($adminLogoUrl, 'http') ? $adminLogoUrl : asset($adminLogoUrl) }}" alt="FitLife Logo" style="height: 52px; width: auto; object-fit: contain; filter: drop-shadow(0 0 12px var(--brand-glow));">
                </a>
                <button type="button" id="mobileCloseSidebar" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer; display: none;" title="Tutup Menu">
                    &times;
                </button>
            </div>

            <ul class="admin-nav">
                @php
                    $uRole = auth()->user()->role ?? 'member';
                    $isAdminRole = in_array($uRole, ['admin', 'superadmin']);
                    
                    $defaultPerms = [
                        'receptionist' => ['pos', 'checkin', 'members', 'payments'],
                        'coach' => ['checkin', 'members'],
                        'member' => [],
                    ];
                    $rawPerms = \App\Models\Setting::get('rbac_menu_permissions');
                    $matrixPerms = $rawPerms ? json_decode($rawPerms, true) : $defaultPerms;
                    $userPerms = $matrixPerms[$uRole] ?? [];

                    $activeTier = \App\Models\Setting::get('subscription_tier', 'enterprise');
                    $tierAllowed = [
                        'starter' => ['members', 'checkin', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'settings'],
                        'pro' => ['members', 'checkin', 'pos', 'payments', 'reports', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'ai-copywriter', 'settings'],
                        'enterprise' => ['members', 'checkin', 'pos', 'payments', 'reports', 'promos', 'classes', 'inventory-log', 'wa-broadcast', 'registrations', 'trials', 'programs', 'coaches', 'posts', 'testimonials', 'faqs', 'videos', 'features', 'integrations', 'users', 'ai-churn', 'ai-copywriter', 'ai-forecasting', 'settings'],
                    ];
                    $allowedModules = $tierAllowed[$activeTier] ?? $tierAllowed['enterprise'];

                    $canAccess = function($key) use ($isAdminRole, $userPerms, $allowedModules) {
                        if (!in_array($key, $allowedModules)) return false;
                        return $isAdminRole || in_array($key, $userPerms);
                    };
                @endphp

                <!-- 1. OPERASIONAL STUDIO -->
                <div class="nav-section-title">📊 OPERASIONAL STUDIO</div>

                @if($isAdminRole)
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                @endif

                @if($canAccess('members'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}" title="Member">
                        <i class="fa-solid fa-users-gear"></i>
                        <span class="nav-text">Member VIP</span>
                    </a>
                </li>
                @endif

                @if($canAccess('pos'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.pos.index') }}" class="{{ request()->routeIs('admin.pos.*') ? 'active' : '' }}" title="Kasir (POS)">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="nav-text">Kasir (POS)</span>
                    </a>
                </li>
                @endif

                @if($canAccess('checkin'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.checkin.index') }}" class="{{ request()->routeIs('admin.checkin.*') ? 'active' : '' }}" title="Presensi">
                        <i class="fa-solid fa-qrcode"></i>
                        <span class="nav-text">Presensi Kiosk</span>
                    </a>
                </li>
                @endif

                @if($canAccess('payments'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" title="Pembayaran">
                        <i class="fa-solid fa-receipt"></i>
                        <span class="nav-text">Pembayaran</span>
                    </a>
                </li>
                @endif

                @if($canAccess('reports'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" title="Laporan">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span class="nav-text">Laporan Keuangan</span>
                    </a>
                </li>
                @endif

                <li class="admin-nav-item">
                    <a href="{{ route('admin.workout_logs.index') }}" class="{{ request()->routeIs('admin.workout_logs.*') ? 'active' : '' }}" title="Workout Logs">
                        <i class="fa-solid fa-dumbbell"></i>
                        <span class="nav-text">Workout Logs</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.nutrition_logs.index') }}" class="{{ request()->routeIs('admin.nutrition_logs.*') ? 'active' : '' }}" title="Nutrition Logs">
                        <i class="fa-solid fa-utensils"></i>
                        <span class="nav-text">Nutrition Logs</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.leaderboard.index') }}" class="{{ request()->routeIs('admin.leaderboard.*') ? 'active' : '' }}" title="Leaderboard XP">
                        <i class="fa-solid fa-trophy"></i>
                        <span class="nav-text">Leaderboard XP</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.branches.index') }}" class="{{ request()->routeIs('admin.branches.*') ? 'active' : '' }}" title="Cabang & Crowd">
                        <i class="fa-solid fa-location-dot"></i>
                        <span class="nav-text">Cabang &amp; Crowd</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.notifications.index') }}" class="{{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}" title="Broadcast Notif">
                        <i class="fa-solid fa-bell"></i>
                        <span class="nav-text">Broadcast Notif</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.membership_plans.index') }}" class="{{ request()->routeIs('admin.membership_plans.*') ? 'active' : '' }}" title="Paket Keanggotaan">
                        <i class="fa-solid fa-id-card"></i>
                        <span class="nav-text">Paket Keanggotaan</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.training_programs.index') }}" class="{{ request()->routeIs('admin.training_programs.*') ? 'active' : '' }}" title="Training Programs">
                        <i class="fa-solid fa-dumbbell"></i>
                        <span class="nav-text">Training Programs</span>
                    </a>
                </li>

                <!-- 2. PENDAFTARAN & KELAS -->
                @if($isAdminRole)
                <div class="nav-section-title">👥 PELANGGAN &amp; KELAS</div>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.registrations') }}" class="{{ request()->routeIs('admin.registrations') ? 'active' : '' }}" title="Pendaftaran">
                        <i class="fa-solid fa-address-card"></i>
                        <span class="nav-text">Pendaftaran Lead</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.trials') }}" class="{{ request()->routeIs('admin.trials') ? 'active' : '' }}" title="Booking Trial">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span class="nav-text">Booking Trial</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.promos.index') }}" class="{{ request()->routeIs('admin.promos.*') ? 'active' : '' }}" title="Voucher Promo">
                        <i class="fa-solid fa-ticket"></i>
                        <span class="nav-text">Voucher Promo</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}" title="Program">
                        <i class="fa-solid fa-swatchbook"></i>
                        <span class="nav-text">Program Fitness</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.coaches.index') }}" class="{{ request()->routeIs('admin.coaches.*') ? 'active' : '' }}" title="Pelatih">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="nav-text">Personal Trainer</span>
                    </a>
                </li>
                @endif

                <!-- 3. KONTEN & MEDIA -->
                @if($isAdminRole)
                <div class="nav-section-title">📝 KONTEN &amp; MEDIA</div>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" title="Blog">
                        <i class="fa-solid fa-newspaper"></i>
                        <span class="nav-text">Blog &amp; Artikel</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" title="Testimoni">
                        <i class="fa-solid fa-comments"></i>
                        <span class="nav-text">Testimoni Member</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" title="FAQ">
                        <i class="fa-solid fa-circle-question"></i>
                        <span class="nav-text">FAQ Pertanyaan</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}" title="Video">
                        <i class="fa-solid fa-video"></i>
                        <span class="nav-text">Video Transformasi</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.features.index') }}" class="{{ request()->routeIs('admin.features.*') ? 'active' : '' }}" title="Keunggulan">
                        <i class="fa-solid fa-star"></i>
                        <span class="nav-text">Keunggulan Studio</span>
                    </a>
                </li>
                @endif

                <!-- 4. INTEGRASI & SISTEM -->
                <div class="nav-section-title">⚙️ INTEGRASI &amp; RBAC</div>

                @if($canAccess('integrations'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.integrations.index') }}" class="{{ request()->routeIs('admin.integrations.*') ? 'active' : '' }}" title="Integrasi">
                        <i class="fa-solid fa-plug"></i>
                        <span class="nav-text">Integrasi API</span>
                    </a>
                </li>
                @endif

                @if($isAdminRole)
                <li class="admin-nav-item">
                    <a href="{{ route('admin.wa-broadcast.index') }}" class="{{ request()->routeIs('admin.wa-broadcast.*') ? 'active' : '' }}" title="WA Broadcast">
                        <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i>
                        <span class="nav-text">WA Broadcast</span>
                    </a>
                </li>
                <!-- 5. FITUR AI SMART TOOLS -->
                <div class="nav-section-title" style="color: #a855f7 !important;">🤖 FITUR AI SMART TOOLS</div>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.ai-copywriter.index') }}" class="{{ request()->routeIs('admin.ai-copywriter.*') ? 'active' : '' }}" title="AI Copywriter">
                        <i class="fa-solid fa-wand-magic-sparkles" style="color: #a855f7;"></i>
                        <span class="nav-text">AI Copywriter</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.ai-forecasting.index') }}" class="{{ request()->routeIs('admin.ai-forecasting.*') ? 'active' : '' }}" title="AI Financial Forecaster">
                        <i class="fa-solid fa-chart-pie" style="color: #38bdf8;"></i>
                        <span class="nav-text">AI Financial Forecaster</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.ai-churn.index') }}" class="{{ request()->routeIs('admin.ai-churn.*') ? 'active' : '' }}" title="AI Churn Predictor">
                        <i class="fa-solid fa-user-slash" style="color: #f43f5e;"></i>
                        <span class="nav-text">AI Churn Predictor</span>
                    </a>
                </li>

                <li class="admin-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}" title="Pengguna & Role RBAC">
                        <i class="fa-solid fa-user-shield"></i>
                        <span class="nav-text">Pengguna &amp; Matriks RBAC</span>
                    </a>
                </li>
                @endif

                @if($canAccess('settings'))
                <li class="admin-nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" title="Pengaturan">
                        <i class="fa-solid fa-gears"></i>
                        <span class="nav-text">Pengaturan Website</span>
                    </a>
                </li>
                @endif
            </ul>

            <div style="padding-top: 1.25rem; border-top: 1px solid var(--admin-border); margin-top: 0.75rem;">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-bottom-link" style="color: #cbd5e1; font-weight: 700; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.85rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; background: rgba(255,255,255,0.03);" title="Lihat Website Utama">
                    <i class="fa-solid fa-arrow-up-right-from-square" style="color: var(--brand-lime);"></i>
                    <span class="sidebar-bottom-text">Website Utama</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-logout-btn" style="width: 100%; border: 1px solid rgba(239, 68, 68, 0.4); color: #f87171; background: rgba(239, 68, 68, 0.08); font-weight: 800; padding: 0.65rem 1rem; border-radius: 0.75rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.25s ease;" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="sidebar-bottom-text">Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <!-- FLOATING GLASS HEADER BAR -->
            <header class="admin-header">
                <div style="display: flex; align-items: center; gap: 1.25rem;">
                    <button type="button" class="sidebar-toggle-btn" id="sidebarToggle" title="Sembunyikan / Tampilkan Menu Sidebar">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                    <div>
                        <h1>@yield('header_title', 'Dashboard Overview')</h1>
                        <div style="display: flex; align-items: center; gap: 0.65rem; margin-top: 0.25rem;">
                            <span style="display: inline-flex; align-items: center; gap: 0.35rem; font-size: 0.75rem; font-weight: 800; color: var(--brand-lime); background: var(--brand-glow-subtle); padding: 0.2rem 0.65rem; border-radius: 99px; border: 1px solid var(--brand-glow);">
                                <span style="width: 7px; height: 7px; background: var(--brand-lime); border-radius: 50%; display: inline-block; box-shadow: 0 0 8px var(--brand-lime);"></span>
                                STUDIO ONLINE
                            </span>
                            <span style="color: #64748b; font-size: 0.8rem; font-weight: 600;">
                                <i class="fa-regular fa-clock" style="margin-right: 0.25rem;"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 0.85rem; flex-wrap: wrap;">
                    <!-- INTERACTIVE THEME SELECTOR UI -->
                    <div style="position: relative;" id="adminThemeDropdownContainer">
                        <button type="button" id="adminThemeBtn" style="background: rgba(255,255,255,0.05); border: 1px solid var(--admin-border); color: #ffffff; padding: 0.55rem 0.9rem; border-radius: 0.85rem; font-weight: 800; font-size: 0.825rem; cursor: pointer; display: flex; align-items: center; gap: 0.45rem; transition: all 0.25s ease;" title="Ganti Tema Warna Admin">
                            <span id="themeDotIndicator" style="width: 10px; height: 10px; border-radius: 50%; background: var(--brand-lime); display: inline-block; box-shadow: 0 0 8px var(--brand-lime);"></span>
                            <span style="font-size: 0.825rem;">Tema Admin</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem; color: #94a3b8; margin-left: 0.2rem;"></i>
                        </button>
                        
                        <div id="adminThemeMenu" style="display: none; position: absolute; top: 125%; right: 0; background: #0d1410; border: 1px solid rgba(255,255,255,0.15); border-radius: 1.15rem; padding: 0.6rem; min-width: 200px; box-shadow: 0 25px 50px rgba(0,0,0,0.9); z-index: 10005;">
                            <div style="font-size: 0.675rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; padding: 0.35rem 0.75rem 0.5rem;">PILIHAN TEMA ADAPTIF</div>
                            
                            <div onclick="switchAdminTheme('lime')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #ffffff; cursor: pointer; font-size: 0.85rem; font-weight: 700; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(132,204,22,0.15)'" onmouseout="this.style.background='transparent'">
                                <span style="width: 12px; height: 12px; border-radius: 50%; background: #84cc16; box-shadow: 0 0 8px #84cc16;"></span>
                                <span>🌿 Emerald Lime</span>
                            </div>
                            <div onclick="switchAdminTheme('cyberpunk')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #ffffff; cursor: pointer; font-size: 0.85rem; font-weight: 700; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(244,63,94,0.15)'" onmouseout="this.style.background='transparent'">
                                <span style="width: 12px; height: 12px; border-radius: 50%; background: #f43f5e; box-shadow: 0 0 8px #f43f5e;"></span>
                                <span>⚡ Neon Red</span>
                            </div>
                            <div onclick="switchAdminTheme('cyan')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #ffffff; cursor: pointer; font-size: 0.85rem; font-weight: 700; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(6,182,212,0.15)'" onmouseout="this.style.background='transparent'">
                                <span style="width: 12px; height: 12px; border-radius: 50%; background: #06b6d4; box-shadow: 0 0 8px #06b6d4;"></span>
                                <span>💎 Electric Cyan</span>
                            </div>
                            <div onclick="switchAdminTheme('gold')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #ffffff; cursor: pointer; font-size: 0.85rem; font-weight: 700; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(234,179,8,0.15)'" onmouseout="this.style.background='transparent'">
                                <span style="width: 12px; height: 12px; border-radius: 50%; background: #eab308; box-shadow: 0 0 8px #eab308;"></span>
                                <span>👑 Royal Gold</span>
                            </div>
                            <div onclick="switchAdminTheme('violet')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: #ffffff; cursor: pointer; font-size: 0.85rem; font-weight: 700; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(139,92,246,0.15)'" onmouseout="this.style.background='transparent'">
                                <span style="width: 12px; height: 12px; border-radius: 50%; background: #8b5cf6; box-shadow: 0 0 8px #8b5cf6;"></span>
                                <span>🔮 Deep Violet</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Direct Action Buttons -->
                    <a href="{{ route('admin.pos.index') }}" class="btn" style="background: var(--brand-glow-subtle); border: 1.5px solid var(--brand-lime); color: var(--brand-lime); border-radius: 0.85rem; font-weight: 800; font-size: 0.825rem; padding: 0.55rem 0.95rem; display: inline-flex; align-items: center; gap: 0.45rem; text-decoration: none;" title="Buka POS Kasir">
                        <i class="fa-solid fa-cart-shopping"></i> Kasir POS
                    </a>
                    
                    <a href="{{ route('admin.checkin.index') }}" class="btn" style="background: rgba(6, 182, 212, 0.15); border: 1.5px solid #06b6d4; color: #06b6d4; border-radius: 0.85rem; font-weight: 800; font-size: 0.825rem; padding: 0.55rem 0.95rem; display: inline-flex; align-items: center; gap: 0.45rem; text-decoration: none;" title="Presensi Kiosk">
                        <i class="fa-solid fa-qrcode"></i> Kiosk Presensi
                    </a>

                    <!-- User Profile Badge -->
                    <div style="display: flex; align-items: center; gap: 0.65rem; background: rgba(255,255,255,0.04); border: 1px solid var(--admin-border); padding: 0.45rem 0.95rem; border-radius: 99px;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--brand-lime) 0%, #10b981 100%); color: #060907; font-weight: 900; display: flex; align-items: center; justify-content: center; font-size: 0.85rem;">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <span style="font-size: 0.825rem; font-weight: 800; color: #ffffff;">{{ Auth::user()->name ?? 'Admin Studio' }}</span>
                            <span style="font-size: 0.675rem; font-weight: 800; color: var(--brand-lime); text-transform: uppercase;">
                                @php
                                    $roleLabels = [
                                        'admin' => '👑 Admin Owner',
                                        'receptionist' => '🧾 Kasir / Resepsionis',
                                        'coach' => '🏋️ Personal Trainer',
                                        'member' => '👤 Member Studio',
                                    ];
                                @endphp
                                {{ $roleLabels[Auth::user()->role ?? 'admin'] ?? '👑 Admin' }}
                            </span>
                        </div>
                    </div>
                </div>
            </header>

            @if(session('success'))
                <div style="background: var(--brand-glow-subtle); border: 1.5px solid var(--brand-lime); color: var(--brand-lime); padding: 1rem 1.25rem; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem; box-shadow: 0 0 20px var(--brand-glow-subtle);">
                    <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: rgba(244, 63, 94, 0.15); border: 1.5px solid #f43f5e; color: #f43f5e; padding: 1rem 1.25rem; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem; box-shadow: 0 0 20px rgba(244, 63, 94, 0.15);">
                    <i class="fa-solid fa-circle-xmark" style="font-size: 1.2rem;"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
            @yield('admin_content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle & CKEditor -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 240px;
            border-radius: 0 0 0.85rem 0.85rem !important;
            font-size: 0.95rem;
            color: #ffffff;
            background: var(--admin-card-bg, #0d1410) !important;
        }
        .ck-toolbar {
            border-radius: 0.85rem 0.85rem 0 0 !important;
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
        }
    </style>

    <script>
        // Admin Theme Switcher Helper
        function switchAdminTheme(themeName) {
            document.documentElement.setAttribute('data-admin-theme', themeName);
            localStorage.setItem('fitlife_admin_theme', themeName);
            
            const dot = document.getElementById('themeDotIndicator');
            const colors = {
                'lime': '#84cc16',
                'cyberpunk': '#f43f5e',
                'cyan': '#06b6d4',
                'gold': '#eab308',
                'violet': '#8b5cf6'
            };
            if (dot && colors[themeName]) {
                dot.style.background = colors[themeName];
                dot.style.boxShadow = '0 0 8px ' + colors[themeName];
            }

            const menu = document.getElementById('adminThemeMenu');
            if (menu) menu.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('adminWrapper');
            const toggleBtn = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');
            const closeBtn = document.getElementById('mobileCloseSidebar');

            // Theme Dropdown Toggle
            const themeBtn = document.getElementById('adminThemeBtn');
            const themeMenu = document.getElementById('adminThemeMenu');

            themeBtn?.addEventListener('click', function(e) {
                e.stopPropagation();
                if (themeMenu) {
                    themeMenu.style.display = themeMenu.style.display === 'none' ? 'block' : 'none';
                }
            });

            document.addEventListener('click', function() {
                if (themeMenu) themeMenu.style.display = 'none';
            });

            if (window.innerWidth >= 992 && localStorage.getItem('admin_sidebar_collapsed') === 'true') {
                wrapper.classList.add('collapsed');
            }

            function openMobileSidebar() {
                wrapper.classList.add('mobile-open');
                if (backdrop) backdrop.classList.add('active');
            }

            function closeMobileSidebar() {
                wrapper.classList.remove('mobile-open');
                if (backdrop) backdrop.classList.remove('active');
            }

            toggleBtn?.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    if (wrapper.classList.contains('mobile-open')) {
                        closeMobileSidebar();
                    } else {
                        openMobileSidebar();
                    }
                } else {
                    wrapper.classList.toggle('collapsed');
                    const isCollapsed = wrapper.classList.contains('collapsed');
                    localStorage.setItem('admin_sidebar_collapsed', isCollapsed ? 'true' : 'false');
                }
            });

            backdrop?.addEventListener('click', closeMobileSidebar);
            closeBtn?.addEventListener('click', closeMobileSidebar);

            document.querySelectorAll('.admin-nav-item a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) closeMobileSidebar();
                });
            });

            document.querySelectorAll('.rich-editor').forEach(textarea => {
                ClassicEditor
                    .create(textarea, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
                    })
                    .catch(error => {
                        console.error('CKEditor Error:', error);
                    });
            });
        });
    </script>
</body>
</html>
