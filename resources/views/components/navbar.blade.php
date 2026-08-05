<nav class="navbar">
    <div class="container">
        <div class="navbar-inner">
            <!-- Brand Logo -->
            @php
                $siteName = site_setting('site_name', 'ApexFitness Center');
            @endphp
            <a href="{{ route('home') }}" class="brand-logo" aria-label="ApexFitness Homepage" style="display: flex; align-items: center; gap: 0.65rem; text-decoration: none;">
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; color: #ffffff; font-size: 1.25rem; box-shadow: 0 4px 14px rgba(16,185,129,0.35);">
                    <i class="fa-solid fa-dumbbell"></i>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <span style="font-weight: 900; font-size: 1.35rem; color: #ffffff; letter-spacing: -0.02em; font-family: 'Outfit', sans-serif;">APEX<span style="color: #10b981;">FITNESS</span></span>
                    <span style="font-size: 0.65rem; color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-top: -3px;">Gym & Personal Trainer</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <ul class="nav-links" id="mobileNavMenu">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang PT</a></li>
                <li><a href="{{ route('program.index') }}" class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}">Program</a></li>
                <li><a href="{{ route('lokasi') }}" class="nav-link {{ request()->routeIs('lokasi') ? 'active' : '' }}">Cabang Gym</a></li>
                <li><a href="{{ route('harga') }}" class="nav-link {{ request()->routeIs('harga') ? 'active' : '' }}">Harga & Member</a></li>
                <li><a href="{{ route('testimoni') }}" class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}">Transformasi</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog Fitness</a></li>
                <li><a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
                <li><a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
            </ul>

            <!-- Header Actions -->
            <div class="nav-actions" style="display: flex; align-items: center; gap: 0.85rem;">
                <button type="button" onclick="openTrialModal()" class="btn-cta-pulse" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 0.6rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 14px rgba(16,185,129,0.35);">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Free Trial PT</span>
                </button>

                <!-- Mobile Hamburger Button -->
                <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
