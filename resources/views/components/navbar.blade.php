<nav class="navbar">
    <div class="container">
        <div class="navbar-inner">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="Les Renang Jogja Homepage">
                <img src="{{ asset('images/logo.webp?v=2') }}" alt="Les Renang Jogja Logo" class="brand-logo-img">
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

                <!-- Theme Switcher Dropdown -->
                <div class="theme-switcher-wrapper">
                    <button type="button" class="theme-picker-btn" id="themePickerToggle" title="Pilih Tema Website" aria-label="Pilih Warna Tema Website">
                        <i class="fa-solid fa-palette"></i>
                    </button>
                    <div class="theme-dropdown-menu" id="themeDropdownMenu">
                        <div class="theme-dropdown-header">Pilih Tema Website (Soft & Aesthetic)</div>
                        <button type="button" onclick="setWebTheme('ocean')" class="theme-option-btn active" data-theme-val="ocean">
                            <span class="theme-color-dot" style="background: linear-gradient(135deg, #0284c7, #38bdf8);"></span>
                            <span>Ocean Breeze (Default)</span>
                        </button>
                        <button type="button" onclick="setWebTheme('dark')" class="theme-option-btn" data-theme-val="dark">
                            <span class="theme-color-dot" style="background: linear-gradient(135deg, #070a12, #38bdf8);"></span>
                            <span>Obsidian Night (Tema Gelap Luxury)</span>
                        </button>
                        <button type="button" onclick="setWebTheme('rose')" class="theme-option-btn" data-theme-val="rose">
                            <span class="theme-color-dot" style="background: linear-gradient(135deg, #f43f5e, #fda4af);"></span>
                            <span>Pastel Rose & Lavender</span>
                        </button>
                        <button type="button" onclick="setWebTheme('sage')" class="theme-option-btn" data-theme-val="sage">
                            <span class="theme-color-dot" style="background: linear-gradient(135deg, #10b981, #6ee7b7);"></span>
                            <span>Sage Mint (Soft Green)</span>
                        </button>
                        <button type="button" onclick="setWebTheme('peach')" class="theme-option-btn" data-theme-val="peach">
                            <span class="theme-color-dot" style="background: linear-gradient(135deg, #f97316, #fdba74);"></span>
                            <span>Warm Peach Sunset</span>
                        </button>
                    </div>
                </div>

                <!-- Mobile Hamburger Button -->
                <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
