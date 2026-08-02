<nav class="navbar">
    <div class="container">
        <div class="navbar-inner">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo">
                <img src="{{ asset('images/logo.webp') }}" alt="Les Renang Jogja Logo" class="brand-logo-img">
                <div class="brand-text-group">
                    <div class="brand-title">LES RENANG JOGJA</div>
                    <div class="brand-subtitle">KURSUS PRIVAT & GARANSI BISA</div>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <ul class="nav-links" id="mobileNavMenu">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="{{ route('program.index') }}" class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}">Program</a></li>
                <li><a href="{{ route('lokasi') }}" class="nav-link {{ request()->routeIs('lokasi') ? 'active' : '' }}">Lokasi</a></li>
                <li><a href="{{ route('harga') }}" class="nav-link {{ request()->routeIs('harga') ? 'active' : '' }}">Harga</a></li>
                <li><a href="{{ route('testimoni') }}" class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
                <li><a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
            </ul>

            <!-- Header Actions -->
            <div class="nav-actions">
                <button onclick="openTrialModal()" class="btn btn-outline btn-sm hidden-mobile" style="border-radius: 99px;">
                    <i class="fa-solid fa-calendar-check"></i> Trial Gratis
                </button>
                <button onclick="openRegistrationModal()" class="btn btn-primary btn-sm hidden-mobile">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Now
                </button>

                <!-- Mobile Hamburger Button -->
                <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
