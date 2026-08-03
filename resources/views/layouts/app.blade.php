<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Les Renang Jogja - Privat Anak, Dewasa, Wanita & Persiapan TNI POLRI')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Les Renang Jogja profesional & privat di Yogyakarta. Melayani les renang anak, dewasa pemula, khusus wanita/muslimah, & persiapan tes TNI/POLRI. Garansi cepat bisa!')">
    <meta name="keywords" content="Les Renang Jogja, Les Renang Yogyakarta, Les Renang Anak Jogja, Les Renang Dewasa Jogja, Les Privat Renang Jogja, Kursus Renang Jogja, Pelatih Renang Jogja, Renang TNI Jogja, Renang POLRI Jogja">
    <meta name="author" content="Les Renang Jogja">
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="YOUR_GOOGLE_VERIFICATION_CODE_HERE">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Les Renang Jogja - Kursus Privat & Garansi Cepat Bisa')">
    <meta property="og:description" content="@yield('meta_description', 'Pelatih renang berlisensi di Yogyakarta untuk Anak, Dewasa, & TNI/POLRI.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Les Renang Jogja">
    <meta property="og:image" content="{{ asset('images/logo.webp') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">

    <!-- Geo Meta Tags for Google Local Search -->
    <meta name="geo.region" content="ID-YO">
    <meta name="geo.placename" content="Yogyakarta">
    <meta name="geo.position" content="-7.797068;110.370529">
    <meta name="ICBM" content="-7.797068, 110.370529">

    <!-- Schema.org JSON-LD Structured Data for Google Rich Snippets & Star Ratings -->
    <script type="application/ld+json">
    {
      "{{ '@context' }}": "https://schema.org",
      "@type": "SportsActivityLocation",
      "name": "Les Renang Jogja",
      "image": "{{ asset('images/logo.webp') }}",
      "@id": "http://lesrenangjogja.site.je",
      "url": "http://lesrenangjogja.site.je",
      "telephone": "+6281234567890",
      "priceRange": "Rp 150.000 - Rp 850.000",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Kaliurang KM 5, Depok, Sleman",
        "addressLocality": "Yogyakarta",
        "addressRegion": "DI Yogyakarta",
        "postalCode": "55281",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": -7.797068,
        "longitude": 110.370529
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "06:00",
        "closes": "18:00"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "250"
      }
    }
    </script>

    <!-- FAQPage Schema.org JSON-LD for Google SERP Rich Accordions -->
    <script type="application/ld+json">
    {
      "{{ '@context' }}": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Berapa biaya les renang privat di Les Renang Jogja?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Biaya les renang di Les Renang Jogja mulai dari Rp 150.000 per sesi atau paket privat hemat Rp 850.000 garansi sampai bisa renang."
          }
        },
        {
          "@type": "Question",
          "name": "Dimana lokasi kolam renang latihan Les Renang Jogja?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Latihan dilakukan di kolam renang bersih & higienis di Yogyakarta, Sleman, Bantul, UNY, FIK, atau kolam renang pribadi/hotel sesuai permintaan Anda."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah ada kelas les renang khusus wanita/muslimah di Jogja?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ya, kami menyediakan kelas les renang privat khusus wanita/muslimah di Jogja dengan pelatih wanita berlisensi yang menjaga privasi."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa lama rata-rata siswa bisa mahir berenang?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Dengan metode 1-on-1 privat, rata-rata peserta anak maupun dewasa bisa mengapung dan meluncur dalam 2-4 kali pertemuan."
          }
        }
      ]
    }
    </script>

    <!-- Local FontAwesome & CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Theme Switcher Button & Dropdown Styles */
        .theme-switcher-wrapper {
            position: relative;
            display: inline-block;
        }
        .theme-picker-btn {
            width: 38px;
            height: 38px;
            border-radius: 99px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .theme-picker-btn:hover {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            transform: rotate(20deg) scale(1.05);
        }
        .theme-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.65rem);
            right: 0;
            width: 220px;
            background: #ffffff;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
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
            border-bottom: 1px solid #f1f5f9;
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
            color: #334155;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
            width: 100%;
        }
        .theme-option-btn:hover, .theme-option-btn.active {
            background: #f1f5f9;
            color: var(--primary);
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

        /* Dynamic Soft & Aesthetic Theme Variable Overrides */
        [data-theme="dark"] {
            --primary: #38bdf8;
            --primary-dark: #0284c7;
            --primary-light: #7dd3fc;
            --accent: #fbbf24;
            --dark: #f8fafc;
            --text-muted: #94a3b8;
        }
        [data-theme="dark"] body {
            background-color: #0f172a !important;
            color: #f8fafc !important;
        }
        [data-theme="dark"] .navbar {
            background: rgba(15, 23, 42, 0.94) !important;
            border-bottom: 1px solid #334155 !important;
        }
        [data-theme="dark"] .glass-card, 
        [data-theme="dark"] .program-card, 
        [data-theme="dark"] .blog-card, 
        [data-theme="dark"] .faq-card,
        [data-theme="dark"] .pricing-card,
        [data-theme="dark"] .location-card,
        [data-theme="dark"] .section-bg-alt {
            background: #1e293b !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        [data-theme="dark"] .section-title, 
        [data-theme="dark"] .hero-title, 
        [data-theme="dark"] h1, [data-theme="dark"] h2, [data-theme="dark"] h3, [data-theme="dark"] h4 {
            color: #ffffff !important;
        }
        [data-theme="dark"] .nav-link {
            color: #cbd5e1 !important;
        }
        [data-theme="dark"] .theme-picker-btn {
            background: #1e293b;
            border-color: #334155;
            color: #38bdf8;
        }
        [data-theme="dark"] .theme-dropdown-menu {
            background: #1e293b;
            border-color: #334155;
        }
        [data-theme="dark"] .theme-option-btn {
            color: #e2e8f0;
        }
        [data-theme="dark"] .theme-option-btn:hover {
            background: #334155;
        }

        /* 🌸 Soft Rose & Lavender Theme */
        [data-theme="rose"] {
            --primary: #e11d48;
            --primary-dark: #881337;
            --primary-light: #f43f5e;
            --accent: #fb7185;
            --light-bg: #fff1f2;
        }
        [data-theme="rose"] .hero-section {
            background: linear-gradient(180deg, #fff1f2 0%, #ffe4e6 65%, #ffffff 100%) !important;
        }
        [data-theme="rose"] .btn-primary {
            background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%) !important;
            border: none;
        }

        /* 🌿 Sage Mint (Soft Green Theme) */
        [data-theme="sage"] {
            --primary: #059669;
            --primary-dark: #064e3b;
            --primary-light: #10b981;
            --accent: #f59e0b;
            --light-bg: #f0fdf4;
        }
        [data-theme="sage"] .hero-section {
            background: linear-gradient(180deg, #ecfdf5 0%, #d1fae5 65%, #ffffff 100%) !important;
        }
        [data-theme="sage"] .btn-primary {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
            border: none;
        }
        .tab-btn:hover, .tab-btn.active {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 8px 20px rgba(0, 119, 182, 0.3);
        }

        /* 🌅 Warm Peach Sunset Theme */
        [data-theme="peach"] {
            --primary: #ea580c;
            --primary-dark: #7c2d12;
            --primary-light: #f97316;
            --accent: #0284c7;
            --light-bg: #fff7ed;
        }
        [data-theme="peach"] .hero-section {
            background: linear-gradient(180deg, #fff7ed 0%, #ffedd5 65%, #ffffff 100%) !important;
        }
        [data-theme="peach"] .btn-primary {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 100%) !important;
            border: none;
        }
    </style>

    <script>
        // Apply theme immediately before page render
        (function() {
            const savedTheme = localStorage.getItem('lesrenang_theme') || 'ocean';
            if (savedTheme !== 'ocean') {
                document.documentElement.setAttribute('data-theme', savedTheme);
            }
        })();

        function setWebTheme(themeName) {
            if (themeName === 'ocean') {
                document.documentElement.removeAttribute('data-theme');
            } else {
                document.documentElement.setAttribute('data-theme', themeName);
            }
            localStorage.setItem('lesrenang_theme', themeName);
            
            // Update active dropdown items
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

    <!-- Schema.org JSON-LD Structured Data for Local Business SEO -->
    <script type="application/ld+json">
    {
      "{{ '@context' }}": "https://schema.org",
      "@type": "SportsActivityLocation",
      "name": "Les Renang Jogja",
      "image": "{{ asset('images/logo.webp') }}",
      "telephone": "+6281234567890",
      "email": "info@lesrenangjogja.com",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Colombo No.1, Caturtunggal, Depok",
        "addressLocality": "Sleman",
        "addressRegion": "D.I. Yogyakarta",
        "postalCode": "55281",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "-7.7702812",
        "longitude": "110.3853112"
      },
      "url": "{{ url('/') }}",
      "priceRange": "Rp 150.000 - Rp 850.000",
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
        ],
        "opens": "06:00",
        "closes": "20:00"
      },
      "areaServed": ["Yogyakarta", "Sleman", "Bantul", "Kulon Progo", "Semarang", "Solo", "Magelang", "Klaten"]
    }
    </script>

    @stack('styles')
</head>
<body>

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
    <main>
        @yield('content')
    </main>

    <!-- Live Social Proof Toast Notification -->
    <div class="live-toast" id="liveSocialProofToast">
        <div style="width: 44px; height: 44px; background: rgba(16, 185, 129, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--emerald); font-size: 1.25rem;">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <div style="font-weight: 800; font-size: 0.875rem; color: var(--dark);" id="toastTitle">Pendaftaran Baru!</div>
            <div style="font-size: 0.8rem; color: var(--text-muted);" id="toastMessage">Ibu Ratna mendaftar Les Renang Anak di Sleman (1 menit lalu)</div>
        </div>
    </div>

    <!-- Video Modal Lightbox Overlay -->
    <div class="video-modal-overlay" id="videoModal">
        <div class="video-modal-container">
            <button onclick="closeVideoModal()" class="modal-close" style="top: 10px; right: 10px; z-index: 10; background: rgba(255,255,255,0.8);">&times;</button>
            <iframe id="videoIframe" width="100%" height="100%" src="" title="Video Aktivitas Les Renang Jogja" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

    <!-- Global Javascript Interactivity -->
    <script>
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

        function openVideoModal(videoUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1') {
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

        // Toggle Navbar Mobile Menu & Accordion
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('mobileNavToggle');
            const menu = document.getElementById('mobileNavMenu');
            if (toggle && menu) {
                toggle.addEventListener('click', function() {
                    menu.classList.toggle('active');
                });
            }

            // Theme Picker Dropdown Toggle
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

            // Sync active theme class in dropdown
            const currentTheme = localStorage.getItem('lesrenang_theme') || 'ocean';
            document.querySelectorAll('.theme-option-btn').forEach(btn => {
                if (btn.getAttribute('data-theme-val') === currentTheme) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });

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

            // Live Social Proof Toast Notification Rotation
            const toastMessages = [
                { title: '🎉 Pendaftaran Baru!', msg: 'Ibu Dewi mendaftar Les Renang Anak (Sleman)' },
                { title: '⚡ Booking Trial Gratis!', msg: 'Bagas booking trial Persiapan TNI POLRI (UNY)' },
                { title: '🌸 Pendaftaran Muslimah!', msg: 'Mba Siti mendaftar Les Renang Wanita Privat' },
                { title: '⭐ Ulasan Bintang 5!', msg: 'Dr. Hendra memberi ulasan 5/5 Terapi Renang' }
            ];
            let toastIdx = 0;
            const toast = document.getElementById('liveSocialProofToast');
            const toastTitle = document.getElementById('toastTitle');
            const toastMsg = document.getElementById('toastMessage');

            if (toast) {
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

    @stack('scripts')
</body>
</html>
