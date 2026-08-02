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
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Media Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Les Renang Jogja - Kursus Privat & Garansi Cepat Bisa')">
    <meta property="og:description" content="@yield('meta_description', 'Pelatih renang berlisensi di Yogyakarta untuk Anak, Dewasa, & TNI/POLRI.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Les Renang Jogja">
    <meta property="og:image" content="{{ asset('images/logo.webp') }}">
    <link rel="icon" type="image/webp" href="{{ asset('images/logo.webp') }}">

    <!-- Local FontAwesome & CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Schema.org JSON-LD Structured Data for Local Business SEO -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SportsActivityLocation",
      "name": "Les Renang Jogja",
      "image": "{{ asset('images/hero.svg') }}",
      "telephone": "+6281234567890",
      "email": "info@lesrenangjogja.com",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "Jl. Colombo No.1, Caturtunggal, Depok",
        "addressLocality": "Sleman",
        "addressRegion": "D.I. Yogyakarta",
        "postalCode": "55281",
        "addressCountry": "ID"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": "-7.7702812",
        "longitude": "110.3853112"
      },
      "url": "{{ url('/') }}",
      "priceRange": "Rp 350.000 - Rp 1.200.000",
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
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
