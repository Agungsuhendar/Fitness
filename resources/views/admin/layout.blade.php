<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - FitLife Gym Jogja')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body.admin-body {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            background-color: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            background: #f1f5f9;
        }
        .admin-sidebar {
            width: 270px;
            background: linear-gradient(180deg, #03045e 0%, #0077b6 100%);
            color: #e0f2fe;
            padding: 1.5rem 1.15rem;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* Collapsed Sidebar Mode (Mini Icon-Only) */
        .admin-wrapper.collapsed .admin-sidebar {
            width: 82px;
            padding: 1.5rem 0.65rem;
        }
        .admin-wrapper.collapsed .nav-text {
            display: none !important;
        }
        .admin-wrapper.collapsed .admin-brand img {
            height: 36px !important;
        }
        .admin-wrapper.collapsed .admin-nav-item a {
            justify-content: center;
            padding: 0.85rem 0;
        }
        .admin-wrapper.collapsed .admin-nav-item a i {
            font-size: 1.25rem;
            margin: 0;
        }
        .admin-wrapper.collapsed .sidebar-bottom-link {
            text-align: center;
            display: flex;
            justify-content: center;
        }
        .admin-wrapper.collapsed .sidebar-logout-btn {
            padding: 0.75rem 0;
            display: flex;
            justify-content: center;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-weight: 800;
            font-size: 1.15rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.15rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-decoration: none;
        }
        .admin-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
            flex: 1;
        }
        .admin-nav-item a {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.85rem 1.15rem;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.925rem;
            border-radius: 0.85rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }
        .admin-nav-item a i {
            color: #ffffff !important;
            font-size: 1.1rem;
        }
        .admin-nav-item a:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff !important;
            transform: translateX(4px);
        }
        .admin-nav-item a.active {
            background: linear-gradient(135deg, #00b4d8 0%, #00f2fe 100%);
            color: #03045e !important;
            font-weight: 800;
            box-shadow: 0 4px 18px rgba(0, 180, 216, 0.4);
        }
        .admin-nav-item a.active i {
            color: #03045e !important;
        }
        .admin-main {
            flex: 1;
            padding: 1.75rem 2.5rem;
            overflow-y: auto;
        }
        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1.15rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        /* Toggle Sidebar Button */
        .sidebar-toggle-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #475569;
            width: 42px;
            height: 42px;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }
        .sidebar-toggle-btn:hover {
            background: #0284c7;
            border-color: #0284c7;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.3);
        }

        /* Glass Cards & Tables */
        .admin-card {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .admin-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
        }

        /* High Contrast Admin Inputs & Form Controls */
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        select,
        textarea,
        .search-input {
            color: #0f172a !important;
            background-color: #ffffff !important;
            font-weight: 700 !important;
        }
        input::placeholder,
        textarea::placeholder {
            color: #94a3b8 !important;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            background: white;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            -webkit-overflow-scrolling: touch;
        }
        table.admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            min-width: 600px;
        }
        table.admin-table th, table.admin-table td {
            padding: 1.1rem 1.35rem;
            border-bottom: 1px solid #f1f5f9;
        }
        table.admin-table tr:hover td {
            background-color: #f8fafc;
        }
        table.admin-table th {
            background: #f8fafc;
            font-weight: 800;
            font-size: 0.8rem;
            color: #475569;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* Mobile Overlay Backdrop */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
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
                left: -290px; /* FULL HIDE off-screen */
                width: 280px !important;
                z-index: 1050;
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.3);
            }
            .admin-wrapper.mobile-open .admin-sidebar {
                left: 0; /* SLIDE IN DRAWER */
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
                justify-content: flex-end;
            }
        }

        @media (max-width: 767.98px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
            .admin-header h1 {
                font-size: 1.35rem !important;
            }
            .admin-card {
                padding: 1.25rem 1rem !important;
            }
        }
    </style>
</head>
<body class="admin-body">
    <!-- Backdrop Overlay for Mobile Drawer -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-wrapper" id="adminWrapper">
        <aside class="admin-sidebar" id="adminSidebar">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <a href="{{ route('admin.dashboard') }}" class="admin-brand" style="margin-bottom: 0; border-bottom: none; padding-bottom: 0;">
                    @php $adminLogoUrl = site_setting('site_logo_footer', 'images/logo-footer.webp'); @endphp
                    <img src="{{ Str::startsWith($adminLogoUrl, 'http') ? $adminLogoUrl : asset($adminLogoUrl) }}" alt="Admin Logo" style="height: 52px; width: auto; object-fit: contain; border-radius: 8px;">
                </a>
                <button type="button" id="mobileCloseSidebar" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; display: none;" title="Tutup Menu">
                    &times;
                </button>
            </div>

            <ul class="admin-nav">
                <li class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard Overview">
                        <i class="fa-solid fa-chart-line"></i>
                        <span class="nav-text">Dashboard Overview</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active' : '' }}" title="Kelola Program">
                        <i class="fa-solid fa-swatchbook"></i>
                        <span class="nav-text">Kelola Program</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" title="Kelola FAQ">
                        <i class="fa-solid fa-circle-question"></i>
                        <span class="nav-text">Kelola FAQ (20+)</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" title="Kelola Artikel Blog">
                        <i class="fa-solid fa-newspaper"></i>
                        <span class="nav-text">Kelola Artikel Blog</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.coaches.index') }}" class="{{ request()->routeIs('admin.coaches.*') ? 'active' : '' }}" title="Kelola Tim Pelatih">
                        <i class="fa-solid fa-user-tie"></i>
                        <span class="nav-text">Kelola Tim Pelatih</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" title="Kelola Testimoni">
                        <i class="fa-solid fa-comments"></i>
                        <span class="nav-text">Kelola Testimoni</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}" title="Kelola Galeri Video">
                        <i class="fa-solid fa-clapperboard"></i>
                        <span class="nav-text">Kelola Galeri Video</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.features.index') }}" class="{{ request()->routeIs('admin.features.*') ? 'active' : '' }}" title="Kelola Keunggulan">
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <span class="nav-text">Kelola Keunggulan</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.registrations') }}" class="{{ request()->routeIs('admin.registrations') ? 'active' : '' }}" title="Data Pendaftaran">
                        <i class="fa-solid fa-address-card"></i>
                        <span class="nav-text">Data Pendaftaran</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.trials') }}" class="{{ request()->routeIs('admin.trials') ? 'active' : '' }}" title="Data Booking Trial">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span class="nav-text">Data Booking Trial</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" title="Pengaturan Website">
                        <i class="fa-solid fa-gears"></i>
                        <span class="nav-text">Pengaturan Website</span>
                    </a>
                </li>
            </ul>

            <div style="padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                <a href="{{ route('home') }}" target="_blank" class="sidebar-bottom-link" style="color: #ffffff; font-weight: 700; text-decoration: none; font-size: 0.875rem; display: block; margin-bottom: 1rem;" title="Lihat Website Utama">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span class="nav-text" style="margin-left: 0.5rem;">Lihat Website Utama</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn sidebar-logout-btn" style="width: 100%; border: 1px solid #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.05); font-weight: 700;" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="nav-text" style="margin-left: 0.4rem;">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div style="display: flex; align-items: center; gap: 1.25rem;">
                    <button type="button" class="sidebar-toggle-btn" id="sidebarToggle" title="Sembunyikan / Tampilkan Menu Sidebar">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                    <div>
                        <h1 style="font-size: 1.75rem; margin: 0; line-height: 1.2; color: #0f172a;">@yield('header_title', 'Dashboard Overview')</h1>
                        <p style="color: #64748b; font-size: 0.875rem; margin-top: 0.2rem;">Selamat datang di Panel Admin FitLife Gym Jogja</p>
                    </div>
                </div>
                <div>
                    <span style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%); color: #0369a1; padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 800; font-size: 0.875rem; box-shadow: 0 2px 8px rgba(3, 105, 161, 0.1);">
                        <i class="fa-solid fa-user-circle" style="margin-right: 0.35rem;"></i> {{ Auth::user()->name ?? 'Admin' }}
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

    <!-- CKEditor 5 Rich Text Editor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 240px;
            border-radius: 0 0 0.85rem 0.85rem !important;
            font-size: 0.95rem;
            color: #1e293b;
        }
        .ck-toolbar {
            border-radius: 0.85rem 0.85rem 0 0 !important;
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
        }
        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: #cbd5e1 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('adminWrapper');
            const toggleBtn = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');
            const closeBtn = document.getElementById('mobileCloseSidebar');

            // Load saved sidebar state for Desktop
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

            // Auto-close mobile sidebar when clicking a nav link
            document.querySelectorAll('.admin-nav-item a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) closeMobileSidebar();
                });
            });

            // Initialize CKEditor on all .rich-editor elements
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
