<!DOCTYPE html>
<html lang="id">
<head>
@php
    $defaultSeoTitle = site_setting('site_seo_title', 'FitLife Gym Jogja - Privat Anak, Dewasa, Wanita & Persiapan TNI POLRI');
    $defaultSeoDesc = site_setting('site_seo_description', 'FitLife Gym Jogja profesional & privat di Yogyakarta. Melayani fitness & personal trainer anak, dewasa pemula, khusus wanita/muslimah, & persiapan tes TNI/POLRI.');
    $siteLogoPath = site_setting('site_logo', 'images/logo.png');
    $siteLogoUrl = Str::startsWith($siteLogoPath, 'http') ? $siteLogoPath : asset($siteLogoPath);
    $siteFaviconPath = site_setting('site_favicon', 'images/favicon.png');
    $siteFaviconUrl = Str::startsWith($siteFaviconPath, 'http') ? $siteFaviconPath : asset($siteFaviconPath);
    $sitePwaIconPath = site_setting('site_pwa_icon', 'images/icon-512.png');
    $sitePwaIconUrl = Str::startsWith($sitePwaIconPath, 'http') ? $sitePwaIconPath : asset($sitePwaIconPath);
    $rawShareLogo = site_setting('site_share_image', $siteLogoPath);
    $shareImageUrl = Str::startsWith($rawShareLogo, 'http') ? $rawShareLogo : asset($rawShareLogo);

    // Build Dynamic Live Toast Notifications from Database
    $liveToasts = [];
    try {
        $recentRegs = \App\Models\Registration::orderByDesc('created_at')->take(4)->get();
        foreach ($recentRegs as $r) {
            $liveToasts[] = [
                'title' => '🎉 Pendaftaran PT Baru!',
                'msg' => $r->name . ' mendaftar ' . ($r->program_name ?? 'ApexFitness Sesi PT') . ($r->preferred_location ? ' (' . $r->preferred_location . ')' : ''),
            ];
        }

        $recentTrials = \App\Models\TrialBooking::orderByDesc('created_at')->take(3)->get();
        foreach ($recentTrials as $t) {
            $liveToasts[] = [
                'title' => '⚡ Free Trial PT Booked!',
                'msg' => ($t->parent_name ?: $t->participant_name) . ' booking Free Sesi Trial ' . ($t->program_name ?? 'ApexFitness'),
            ];
        }

        $recentReviews = \App\Models\Testimonial::where('is_approved', true)->orderByDesc('created_at')->take(3)->get();
        foreach ($recentReviews as $rev) {
            $liveToasts[] = [
                'title' => '⭐ Ulasan Bintang ' . $rev->rating . '!',
                'msg' => $rev->name . ': "' . Str::limit($rev->review, 45) . '"',
            ];
        }
    } catch (\Throwable $e) {}

    if (empty($liveToasts)) {
        $liveToasts = [
            ['title' => '🎉 Free Trial PT Booked!', 'msg' => 'Bima Santoso booking Sesi Trial PT (Apex Fitness Sleman)'],
            ['title' => '⚡ Target Weight Loss Tembus!', 'msg' => 'Ibu Anisa pangkas 8kg lemak tubuh dalam 6 minggu'],
            ['title' => '🌸 Member Wanita Baru!', 'msg' => 'Siti Rahmawati mendaftar Female Fitness & Pilates Studio'],
            ['title' => '⭐ Transformasi Bintang 5!', 'msg' => 'Rian A.: "Pull-up dari 3x jadi 18x & lulus tes TNI POLRI"'],
        ];
    }

    $pwaManifestJson = json_encode([
        'id' => '/',
        'name' => site_setting('site_seo_title', 'FitLife Center Jogja - Gym & Personal Trainer'),
        'short_name' => site_setting('hero_title', 'FitLife Hub'),
        'description' => site_setting('site_seo_description', 'Pusat fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta.'),
        'start_url' => '/',
        'scope' => '/',
        'display' => 'standalone',
        'orientation' => 'portrait',
        'background_color' => '#060907',
        'theme_color' => '#0a0f0d',
        'icons' => [
            [
                'src' => asset('images/icon-192.png'),
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'any maskable'
            ],
            [
                'src' => asset('images/icon-512.png'),
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'any maskable'
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $pwaManifestDataUri = 'data:application/manifest+json;base64,' . base64_encode($pwaManifestJson);
@endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $defaultSeoTitle)</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', $defaultSeoDesc)">
    <meta name="keywords" content="ApexFitness, Gym Jogja, Personal Trainer Jogja, Weight Loss Jogja, Fitness Center Sleman, Private PT Jogja, Tempat Fitnes Jogja, Fitnes Wanita Jogja, Latihan Beban Jogja, Persiapan Fisik TNI POLRI">
    <meta name="author" content="ApexFitness Center">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Sharing Meta -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="ApexFitness Center">
    <meta property="og:title" content="@yield('title', $defaultSeoTitle)">
    <meta property="og:description" content="@yield('meta_description', $defaultSeoDesc)">
    <meta property="og:image" content="{{ $shareImageUrl }}">
    <meta property="og:image:secure_url" content="{{ $shareImageUrl }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">

    <!-- Twitter Card Meta -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $defaultSeoTitle)">
    <meta name="twitter:description" content="@yield('meta_description', $defaultSeoDesc)">
    <meta name="twitter:image" content="{{ $shareImageUrl }}">

    <!-- Dynamic Favicon & Touch Icons from Site Settings -->
    <link rel="icon" type="image/png" href="{{ $siteFaviconUrl }}">
    <link rel="shortcut icon" type="image/png" href="{{ $siteFaviconUrl }}">
    <link rel="apple-touch-icon" href="{{ $sitePwaIconUrl }}">

    <!-- PWA Web Manifest & App Meta Tags -->
    <link rel="manifest" href="{{ $pwaManifestDataUri }}">
    <meta name="theme-color" content="#0a0f0d">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ site_setting('hero_title', 'FitLife Gym') }}">

    <!-- Geo Meta Tags for Google Local Search -->
    <meta name="geo.region" content="ID-YO">
    <meta name="geo.placename" content="Yogyakarta">
    <meta name="geo.position" content="-7.7702812;110.3853112">

    <!-- Schema.org JSON-LD Structured Data for ApexFitness -->
    <script type="application/ld+json">
    {
      "{{ '@context' }}": "https://schema.org",
      "@type": "ExerciseGym",
      "name": "ApexFitness Center & Personal Training Studio",
      "image": "{{ asset('images/logo.webp') }}",
      "url": "{{ url('/') }}",
      "telephone": "+{{ site_setting('whatsapp_number', '6281234567890') }}",
      "priceRange": "Rp 450.000 - Rp 1.500.000",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ site_setting('office_address', 'Jl. Kaliurang KM 5.5, Depok, Sleman') }}",
        "addressLocality": "Yogyakarta",
        "addressRegion": "DI Yogyakarta",
        "postalCode": "55281",
        "addressCountry": "ID"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
        "opens": "06:00",
        "closes": "22:00"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "320"
      }
    }
    </script>

    <!-- Local FontAwesome & Custom CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1.1.6">

    <script>
        (function() {
            const savedTheme = localStorage.getItem('fitlife_theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
            }
        })();
    </script>

    <style>
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #060907 !important;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Dynamic Theme Engine CSS Variables & Universal Color Overrides */
        :root {
            --brand-primary: #84cc16;
            --brand-primary-dark: #65a30d;
            --brand-glow: rgba(132, 204, 22, 0.4);
            --brand-glow-subtle: rgba(132, 204, 22, 0.12);
            --brand-bg: #060907;
            --brand-card-bg: #0d1310;
        }

        :root[data-theme="cyberpunk"] {
            --brand-primary: #f43f5e;
            --brand-primary-dark: #e11d48;
            --brand-glow: rgba(244, 63, 94, 0.5);
            --brand-glow-subtle: rgba(244, 63, 94, 0.15);
            --brand-bg: #090507;
            --brand-card-bg: #130a0d;
        }

        :root[data-theme="cyan"] {
            --brand-primary: #06b6d4;
            --brand-primary-dark: #0891b2;
            --brand-glow: rgba(6, 182, 212, 0.5);
            --brand-glow-subtle: rgba(6, 182, 212, 0.15);
            --brand-bg: #05080b;
            --brand-card-bg: #091016;
        }

        :root[data-theme="gold"] {
            --brand-primary: #eab308;
            --brand-primary-dark: #ca8a04;
            --brand-glow: rgba(234, 179, 8, 0.5);
            --brand-glow-subtle: rgba(234, 179, 8, 0.15);
            --brand-bg: #0a0904;
            --brand-card-bg: #14120a;
        }

        /* Dynamic Theme Class Overrides */
        .text-primary, .active-indicator, .nav-link.active, .nav-dropdown-link:hover {
            color: var(--brand-primary) !important;
        }
        .btn-primary, button[type="submit"] {
            background-color: var(--brand-primary) !important;
            color: #090d0b !important;
        }
        .glow-btn {
            background-color: var(--brand-primary) !important;
            box-shadow: 0 0 20px var(--brand-glow) !important;
        }
        
        /* Auto Theme Adaptor for Hardcoded Color Elements */
        [style*="#84cc16"] {
            color: var(--brand-primary) !important;
        }
        [style*="background: #84cc16"], [style*="background:#84cc16"], [style*="background: rgb(132, 204, 22)"] {
            background-color: var(--brand-primary) !important;
        }
        [style*="border: 1.5px solid #84cc16"], [style*="border: 2px solid #84cc16"], [style*="border: 1px solid #84cc16"] {
            border-color: var(--brand-primary) !important;
        }
        [style*="rgba(132, 204, 22, 0.15)"], [style*="rgba(132, 204, 22, 0.12)"], [style*="rgba(132, 204, 22, 0.1)"], [style*="rgba(132, 204, 22, 0.2)"] {
            background-color: var(--brand-glow-subtle) !important;
        }

        /* Bulletproof Topbar Offset */
        main {
            margin-top: 72px !important;
            padding-top: 0 !important;
            display: block;
            background-color: #060907 !important;
        }
        @media (max-width: 768px) {
            main {
                margin-top: 64px !important;
            }
        }

        /* Mobile Topbar Action Bar Styling */
        @media (max-width: 991px) {
            .nav-actions {
                display: flex !important;
                align-items: center !important;
                gap: 0.65rem !important;
            }
            .mobile-toggle {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
            .nav-links.active {
                display: flex !important;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(13, 19, 16, 0.98);
                backdrop-filter: blur(20px);
                border-bottom: 2px solid var(--brand-primary, #84cc16);
                padding: 1.25rem 1.5rem;
                box-shadow: 0 20px 40px rgba(0,0,0,0.9);
                z-index: 9999;
            }
        /* ========================================================= */
        /* BULLETPROOF TOPBAR NAVIGATION SYSTEM                      */
        /* ========================================================= */
        .navbar {
            background: rgba(10, 15, 13, 0.95) !important;
            backdrop-filter: blur(16px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 100000 !important;
            padding: 0.8rem 0 !important;
            margin: 0 !important;
        }

        .navbar-inner {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            position: relative !important;
            width: 100% !important;
        }

        /* Global Default: Dropdown Menu Hidden */
        .nav-dropdown-menu {
            display: none !important;
        }

        /* 1. Desktop Mode (Screens >= 992px) */
        @media (min-width: 992px) {
            .hidden-mobile { display: flex !important; }
            .mobile-only,
            .mobile-hero-wrapper { display: none !important; }
            .mobile-toggle { display: none !important; }

            .desktop-nav-links.hidden-mobile,
            .desktop-nav-links {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                gap: 1.35rem !important;
                list-style: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .desktop-nav-links > li {
                display: inline-flex !important;
                align-items: center !important;
                position: relative !important;
                list-style: none !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .desktop-nav-links > li > .nav-link {
                display: inline-flex !important;
                align-items: center !important;
                gap: 0.4rem !important;
                color: #cbd5e1 !important;
                font-weight: 700 !important;
                font-size: 0.9rem !important;
                text-decoration: none !important;
                padding: 0.45rem 0.25rem !important;
                white-space: nowrap !important;
            }

            .desktop-nav-links > li > .nav-link:hover,
            .desktop-nav-links > li > .nav-link.active {
                color: var(--brand-primary, #84cc16) !important;
            }

            .nav-dropdown-item {
                position: relative !important;
            }

            .desktop-nav-links .nav-dropdown-menu {
                display: none !important;
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                background: #0d1310 !important;
                border: 1.5px solid rgba(132, 204, 22, 0.4) !important;
                border-radius: 1.15rem !important;
                padding: 0.75rem 0.5rem !important;
                min-width: 230px !important;
                box-shadow: 0 20px 40px rgba(0,0,0,0.9), 0 0 25px rgba(132,204,22,0.2) !important;
                flex-direction: column !important;
                gap: 0.25rem !important;
                z-index: 100005 !important;
            }

            /* Show Dropdown on Hover or Click */
            .nav-dropdown-item:hover > .nav-dropdown-menu,
            .nav-dropdown-item.show > .nav-dropdown-menu {
                display: flex !important;
            }
        }

        /* 2. Mobile Mode (Screens < 992px) */
        @media (max-width: 991px) {
            .hidden-mobile { display: none !important; }
            .mobile-only { display: block !important; }
            .mobile-toggle { display: flex !important; }

            #mobileNavDrawer {
                display: none !important;
            }

            #mobileNavDrawer.active {
                display: flex !important;
            }

            .nav-links {
                display: none;
                flex-direction: column !important;
                position: absolute !important;
                top: 100% !important;
                left: 0 !important;
                width: 100% !important;
                background: rgba(13, 19, 16, 0.98) !important;
                backdrop-filter: blur(20px) !important;
                border-bottom: 2px solid var(--brand-primary, #84cc16) !important;
                padding: 1.25rem 1.5rem !important;
                box-shadow: 0 20px 40px rgba(0,0,0,0.9) !important;
                z-index: 9999 !important;
                gap: 0.85rem !important;
            }

            .nav-links.active {
                display: flex !important;
            }

            .nav-dropdown-menu {
                display: flex !important;
                position: static !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0.25rem 0 0.5rem 1rem !important;
                opacity: 1 !important;
                visibility: visible !important;
                pointer-events: auto !important;
                transform: none !important;
            }
        }
        .nav-dropdown-link {
            display: flex !important;
            align-items: center;
            gap: 0.65rem;
            padding: 0.65rem 1rem !important;
            border-radius: 0.75rem;
            color: #cbd5e1 !important;
            font-size: 0.85rem !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }
        .nav-dropdown-link:hover {
            background: rgba(132, 204, 22, 0.12) !important;
            color: #84cc16 !important;
            padding-left: 1.25rem !important;
        }

        /* Theme Switcher Button & Dropdown Styles */
        .theme-switcher-wrapper {
            position: relative;
            display: inline-block;
        }
        .theme-picker-btn {
            width: 38px;
            height: 38px;
            border-radius: 99px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(15, 23, 42, 0.8);
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .theme-picker-btn:hover {
            background: #10b981;
            color: #ffffff;
            border-color: #10b981;
            transform: rotate(20deg) scale(1.05);
        }
        .theme-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.65rem);
            right: 0;
            width: 220px;
            background: #0f172a;
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            padding: 0.75rem;
            display: none;
            flex-direction: column;
            gap: 0.35rem;
            z-index: 1000;
            animation: fadeInScale 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .theme-dropdown-menu.show {
            display: flex;
        }
        .theme-dropdown-header {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            padding: 0.35rem 0.5rem 0.5rem;
            border-bottom: 1px solid #1e293b;
            margin-bottom: 0.25rem;
        }
        .theme-option-btn {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.75rem;
            border-radius: 0.65rem;
            border: none;
            background: transparent;
            color: #cbd5e1;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
            width: 100%;
        }
        .theme-option-btn:hover, .theme-option-btn.active {
            background: #1e293b;
            color: #10b981;
        }
        .theme-color-dot {
            width: 14px;
            height: 14px;
            border-radius: 99px;
            display: inline-block;
            flex-shrink: 0;
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.95) translateY(-5px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
    </style>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('apexfitness_theme') || 'dark';
            if (savedTheme !== 'dark') {
                document.documentElement.setAttribute('data-theme', savedTheme);
            }
        })();

        function setWebTheme(themeName) {
            if (themeName === 'dark') {
                document.documentElement.removeAttribute('data-theme');
            } else {
                document.documentElement.setAttribute('data-theme', themeName);
            }
            localStorage.setItem('apexfitness_theme', themeName);
            
            document.querySelectorAll('.theme-option-btn').forEach(btn => {
                if (btn.getAttribute('data-theme-val') === themeName) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

            const menu = document.getElementById('themeDropdownMenu');
            if (menu) menu.classList.remove('show');
        }
    </script>

    @stack('styles')
</head>
<body style="background-color: #060907 !important; margin: 0 !important; padding: 0 !important; color: #ffffff !important;">

    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Flash Notifications -->
    @if(session()->has('success'))
        <div class="container" style="margin-top: 1rem;">
            <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 1rem 1.25rem; border-radius: 0.75rem; font-weight: 600;">
                <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem;"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main style="margin-top: 84px;">
        @yield('content')
    </main>

    <!-- Live Social Proof Toast Notification -->
    <div class="live-toast" id="liveSocialProofToast">
        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.25rem;">
            <i class="fa-solid fa-fire"></i>
        </div>
        <div>
            <div style="font-weight: 800; font-size: 0.875rem; color: #ffffff;" id="toastTitle">Free Trial Booked!</div>
            <div style="font-size: 0.8rem; color: #94a3b8;" id="toastMessage">Bima Santoso booking Sesi Trial PT ApexFitness</div>
        </div>
    </div>

    <!-- Video Modal Lightbox Overlay -->
    <div class="video-modal-overlay" id="videoModal">
        <div class="video-modal-container">
            <button onclick="closeVideoModal()" class="modal-close" style="top: 10px; right: 10px; z-index: 10; background: rgba(255,255,255,0.8);">&times;</button>
            <iframe id="videoIframe" width="100%" height="100%" src="" title="Video Transformasi ApexFitness" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <!-- Reel Video Modal Lightbox Overlay -->
    <div id="reelModalOverlay" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1rem;">
        <div style="position: relative; width: 100%; max-width: 380px; background: #0f172a; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.15);">
            <div style="padding: 1rem; background: #1e293b; color: white; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #334155;">
                <div>
                    <div id="reelModalTitle" style="font-weight: 800; font-size: 1rem; color: #10b981;">Nama Member</div>
                    <div id="reelModalSub" style="font-size: 0.75rem; color: #94a3b8;">Transformasi Fitness</div>
                </div>
                <button onclick="closeReelModal()" style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 0.2rem 0.6rem;">&times;</button>
            </div>
            <div style="position: relative; padding-top: 140%; width: 100%;">
                <iframe id="reelModalIframe" style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- Footer Component -->
    @include('components.footer')

    <!-- WhatsApp Floating Widget -->
    @include('components.whatsapp-float')

    <!-- Back To Top Button -->
    @include('components.back-to-top')

    <!-- Registration Modal -->
    @include('components.registration-modal')

    <!-- Booking Trial Modal -->
    @include('components.trial-modal')

    <!-- CTA Choice Decision Modal -->
    @include('components.cta-choice-modal')

    <!-- Global Javascript Interactivity -->
    <script>
        function openCtaChoiceModal() {
            const modal = document.getElementById('ctaChoiceModal');
            if (modal) modal.classList.add('active');
        }

        function closeCtaChoiceModal() {
            const modal = document.getElementById('ctaChoiceModal');
            if (modal) modal.classList.remove('active');
        }

        function openRegistrationModal(programName = '') {
            const modal = document.getElementById('registrationModal');
            if (programName) {
                const programSelect = document.getElementById('modalProgramSelect');
                if (programSelect) programSelect.value = programName;
            }
            modal.classList.add('active');
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.remove('active');
        }

        function openTrialModal(programName = '') {
            const modal = document.getElementById('trialModal');
            if (programName) {
                const select = document.getElementById('trialProgramSelect');
                if (select) select.value = programName;
            }
            modal.classList.add('active');
        }

        function closeTrialModal() {
            document.getElementById('trialModal').classList.remove('active');
        }

        function openVideoModal(videoUrl = 'https://www.youtube.com/embed/5ee8sX_1-9c?autoplay=1') {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoIframe');
            iframe.src = videoUrl;
            modal.classList.add('active');
        }

        function closeVideoModal() {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoIframe');
            iframe.src = '';
            modal.classList.remove('active');
        }

        function openReelModal(title, sub, videoUrl) {
            const overlay = document.getElementById('reelModalOverlay');
            if (!overlay) return;
            document.getElementById('reelModalTitle').innerText = title;
            document.getElementById('reelModalSub').innerText = sub;
            document.getElementById('reelModalIframe').src = videoUrl + '?autoplay=1';
            overlay.style.display = 'flex';
        }

        function closeReelModal() {
            const overlay = document.getElementById('reelModalOverlay');
            if (!overlay) return;
            document.getElementById('reelModalIframe').src = '';
            overlay.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('mobileNavToggle');
            const menu = document.getElementById('mobileNavMenu');
            if (toggle && menu) {
                toggle.addEventListener('click', function() {
                    menu.classList.toggle('active');
                });
            }

            const themeToggleBtn = document.getElementById('themePickerToggle');
            const themeDropdownMenu = document.getElementById('themeDropdownMenu');
            if (themeToggleBtn && themeDropdownMenu) {
                themeToggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    themeDropdownMenu.classList.toggle('show');
                });
                document.addEventListener('click', (e) => {
                    if (!themeDropdownMenu.contains(e.target) && e.target !== themeToggleBtn) {
                        themeDropdownMenu.classList.remove('show');
                    }
                });
            }

            // Accordion Logic
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const header = item.querySelector('.faq-header');
                if (header) {
                    header.addEventListener('click', () => {
                        item.classList.toggle('active');
                    });
                }
            });

            // Dynamic Social Proof Toast Rotation
            const toastMessages = @json($liveToasts);
            let toastIdx = 0;
            const toast = document.getElementById('liveSocialProofToast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMsg = document.getElementById('toastMessage');

            if (toast && toastMessages.length > 0) {
                setInterval(() => {
                    const current = toastMessages[toastIdx];
                    toastTitle.innerText = current.title;
                    toastMsg.innerText = current.msg;
                    toast.classList.add('show');

                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 4500);

                    toastIdx = (toastIdx + 1) % toastMessages.length;
                }, 12000);
            }
        });
    </script>

    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('PWA ServiceWorker registered with scope:', reg.scope))
                    .catch(err => console.log('ServiceWorker registration failed:', err));
            });
        }
    </script>

    <!-- Floating PWA Install Prompt Banner (Top Right Corner - Slightly Lower) -->
    <div id="pwaInstallBanner" style="display: none; position: fixed; top: 105px; right: 20px; left: auto; transform: none; z-index: 99998; width: calc(100% - 40px); max-width: 420px; background: #0d1310; border: 2px solid var(--brand-primary, #84cc16); border-radius: 1.25rem; padding: 0.85rem 1.1rem; box-shadow: 0 20px 40px rgba(0,0,0,0.9), 0 0 25px var(--brand-glow, rgba(132,204,22,0.35)); align-items: center; justify-content: space-between; gap: 0.85rem; color: white;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 0.85rem; padding: 0.4rem; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="FitLife App Icon" style="height: 34px; width: auto; object-fit: contain;">
            </div>
            <div>
                <div style="font-weight: 900; font-size: 0.9rem; color: #ffffff;">FitLife Hub App</div>
                <div style="font-size: 0.75rem; color: #cbd5e1;">Akses cepat &amp; hemat kuota di HP Anda</div>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <button onclick="triggerPwaInstall()" style="background: var(--brand-primary, #84cc16); color: #ffffff !important; border: none; padding: 0.5rem 1.1rem; border-radius: 99px; font-weight: 900; font-size: 0.825rem; cursor: pointer; white-space: nowrap; display: inline-flex; align-items: center; gap: 0.4rem; box-shadow: 0 0 15px var(--brand-glow, rgba(132,204,22,0.4));">
                <i class="fa-solid fa-mobile-screen-button" style="color: #ffffff !important;"></i>
                <span style="color: #ffffff !important;">Install App</span>
            </button>
            <button onclick="dismissPwaBanner()" style="background: transparent; border: none; color: #94a3b8; font-size: 1.3rem; cursor: pointer; padding: 0 0.3rem;" title="Tutup">
                &times;
            </button>
        </div>
    </div>

    <!-- Universal PWA Instruction Modal (macOS, iOS, Android & Desktop) -->
    <div id="pwaInstructionModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(12px); z-index: 100005; align-items: center; justify-content: center; padding: 1.25rem;">
        <div style="background: #0d1310; border: 2px solid var(--brand-primary, #84cc16); border-radius: 1.5rem; max-width: 480px; width: 100%; padding: 2rem; box-shadow: 0 25px 50px rgba(0,0,0,0.9); position: relative; color: white; text-align: center;">
            <button onclick="closePwaModal()" style="position: absolute; top: 1rem; right: 1rem; background: transparent; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;" title="Tutup">&times;</button>

            <div style="width: 60px; height: 60px; border-radius: 50%; background: rgba(132, 204, 22, 0.15); border: 2px solid var(--brand-primary, #84cc16); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 1.8rem; color: var(--brand-primary, #84cc16);">
                <i class="fa-solid fa-desktop" id="pwaOsIcon"></i>
            </div>

            <h3 style="font-size: 1.35rem; font-weight: 900; margin-bottom: 0.5rem; font-family: 'Outfit', sans-serif;">Cara Install FitLife Hub App</h3>
            <p style="color: #cbd5e1; font-size: 0.875rem; margin-bottom: 1.5rem; line-height: 1.6;">
                Nikmati akses cepat 1-Klik langsung dari Launchpad / Dock Mac, Desktop Windows, atau Layar Utama HP Anda!
            </p>

            <div style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.15rem; text-align: left; font-size: 0.85rem; display: flex; flex-direction: column; gap: 0.85rem; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <span style="background: var(--brand-primary, #84cc16); color: #090d0b; font-weight: 900; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px;">1</span>
                    <span><b>Di Mac / Desktop (Chrome/Edge):</b> Klik ikon <b>Install <i class="fa-solid fa-download"></i></b> di sebelah kanan bilah URL browser atau menu <b>Titik 3 ➔ Install FitLife Hub</b>.</span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <span style="background: var(--brand-primary, #84cc16); color: #090d0b; font-weight: 900; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px;">2</span>
                    <span><b>Di Mac (Safari):</b> Pilih menu <b>File ➔ Tambahkan ke Dock</b> untuk membuat ikon aplikasi instan di Dock Mac OS.</span>
                </div>
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <span style="background: var(--brand-primary, #84cc16); color: #090d0b; font-weight: 900; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; flex-shrink: 0; margin-top: 2px;">3</span>
                    <span><b>Di iPhone / Android:</b> Ketuk tombol <b>Bagikan <i class="fa-solid fa-share-nodes"></i> ➔ Tambahkan ke Layar Utama</b>.</span>
                </div>
            </div>

            <div style="display: flex; gap: 0.75rem; width: 100%;">
                <button onclick="triggerPwaInstall(); closePwaModal();" style="flex: 1; background: var(--brand-primary, #84cc16); color: #090d0b; border: none; padding: 0.75rem 1rem; border-radius: 99px; font-weight: 900; font-size: 0.875rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem;">
                    <i class="fa-solid fa-download"></i> Install Sekarang
                </button>
                <button onclick="closePwaModal()" style="background: transparent; color: #cbd5e1; border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 1.25rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; cursor: pointer;">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        let deferredPwaPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPwaPrompt = e;
            showPwaBanner();
        });

        // Show banner after 1.5 seconds if not dismissed
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                if (!sessionStorage.getItem('pwa_banner_dismissed')) {
                    showPwaBanner();
                }
            }, 1500);
        });

        function showPwaBanner() {
            const banner = document.getElementById('pwaInstallBanner');
            if (banner) banner.style.display = 'flex';
        }

        function triggerPwaInstall() {
            if (deferredPwaPrompt) {
                deferredPwaPrompt.prompt();
                deferredPwaPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('User accepted PWA install prompt');
                    }
                    deferredPwaPrompt = null;
                    dismissPwaBanner();
                });
            } else {
                const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0 || navigator.userAgent.includes('Macintosh');
                const icon = document.getElementById('pwaOsIcon');
                if (icon) {
                    if (isMac) {
                        icon.className = 'fa-solid fa-laptop';
                    } else if (/iPad|iPhone|iPod/.test(navigator.userAgent)) {
                        icon.className = 'fa-solid fa-mobile-screen-button';
                    } else {
                        icon.className = 'fa-solid fa-desktop';
                    }
                }

                const modal = document.getElementById('pwaInstructionModal');
                if (modal) modal.style.display = 'flex';
            }
        }

        function closePwaModal() {
            const modal = document.getElementById('pwaInstructionModal');
            if (modal) modal.style.display = 'none';
        }

        function dismissPwaBanner() {
            const banner = document.getElementById('pwaInstallBanner');
            if (banner) banner.style.display = 'none';
            sessionStorage.setItem('pwa_banner_dismissed', '1');
        }
    </script>

    @include('components.ai_chatbot')

    @stack('scripts')
</body>
</html>
