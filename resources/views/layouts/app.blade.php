@php
    $defaultSeoTitle = site_setting('site_seo_title', 'ApexFitness Center - Gym, Personal Trainer Privat & Body Transformation Studio');
    $defaultSeoDesc = site_setting('site_seo_description', 'ApexFitness Center Yogyakarta. Pusat fitness gym & Personal Trainer privat 1-on-1 tersertifikasi APKI. Program Weight Loss, Muscle Building, Female Body Shaping & Persiapan TNI POLRI. InBody Scan & Garansi Hasil!');
    $rawShareLogo = site_setting('site_share_image', 'images/logo.png');
    if (Str::endsWith($rawShareLogo, '.webp') && file_exists(public_path('images/logo.png'))) {
        $rawShareLogo = 'images/logo.png';
    }
    $shareImageUrl = Str::startsWith($rawShareLogo, 'http') ? $rawShareLogo : url('/') . '/' . ltrim($rawShareLogo, '/');

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
    } catch (\Exception $e) {}

    if (empty($liveToasts)) {
        $liveToasts = [
            ['title' => '🎉 Free Trial PT Booked!', 'msg' => 'Bima Santoso booking Sesi Trial PT (Apex Fitness Sleman)'],
            ['title' => '⚡ Target Weight Loss Tembus!', 'msg' => 'Ibu Anisa pangkas 8kg lemak tubuh dalam 6 minggu'],
            ['title' => '🌸 Member Wanita Baru!', 'msg' => 'Siti Rahmawati mendaftar Female Fitness & Pilates Studio'],
            ['title' => '⭐ Transformasi Bintang 5!', 'msg' => 'Rian A.: "Pull-up dari 3x jadi 18x & lulus tes TNI POLRI"'],
        ];
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
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

    <link rel="icon" type="image/webp" href="{{ asset('images/logo-icon.webp?v=2') }}">

    <!-- PWA Web Manifest & App Meta Tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="ApexFitness">

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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1.0.5">

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

    @stack('scripts')
</body>
</html>
