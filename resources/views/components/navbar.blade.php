<nav class="navbar" style="background: rgba(10, 15, 13, 0.95); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.08); position: fixed; top: 0; left: 0; width: 100%; z-index: 10000; padding: 0.9rem 0; margin: 0;">
    <div class="container">
        <div class="navbar-inner" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
            <!-- Brand Logo FitLife -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="FitLife Homepage" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <img src="{{ asset('images/logo.png') }}" alt="FitLife Logo" style="height: 46px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(132, 204, 22, 0.3));">
            </a>

            <!-- Desktop & Mobile Nav Links -->
            <ul class="nav-links" id="mobileNavMenu">
                <li>
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                        @if(request()->routeIs('home'))
                            <span class="active-indicator"></span>
                        @endif
                    </a>
                </li>
                <li><a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a></li>
                <li><a href="{{ route('program.index') }}" class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}">Program</a></li>
                <li><a href="{{ route('lokasi') }}" class="nav-link {{ request()->routeIs('lokasi') ? 'active' : '' }}">Fasilitas</a></li>
                <li><a href="{{ route('harga') }}" class="nav-link {{ request()->routeIs('harga') ? 'active' : '' }}">Harga</a></li>
                <li><a href="{{ route('kalkulator') }}" class="nav-link {{ request()->routeIs('kalkulator') ? 'active' : '' }}">Kalkulator</a></li>
                <li><a href="{{ route('quiz') }}" class="nav-link {{ request()->routeIs('quiz') ? 'active' : '' }}">Quiz</a></li>
                <li><a href="{{ route('pelatih') }}" class="nav-link {{ request()->routeIs('pelatih') ? 'active' : '' }}">Pelatih</a></li>
                <li><a href="{{ route('kelas') }}" class="nav-link {{ request()->routeIs('kelas') ? 'active' : '' }}">Kelas</a></li>
                <li><a href="{{ route('member.dashboard') }}" class="nav-link {{ request()->routeIs('member.*') ? 'active' : '' }}">Member</a></li>
                <li><a href="{{ route('testimoni') }}" class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}">Testimoni</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>

                <!-- Mobile Action Links Inside Dropdown -->
                <li class="mobile-only-action" style="margin-top: 0.5rem;">
                    <button type="button" onclick="openTrialModal()" style="width: 100%; background: rgba(255, 255, 255, 0.08); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.75rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-regular fa-compass" style="color: #84cc16;"></i>
                        <span>Trial Gratis 7 Hari</span>
                    </button>
                </li>
                <li class="mobile-only-action">
                    <button type="button" onclick="openRegistrationModal()" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.75rem 1.35rem; border-radius: 99px; font-weight: 900; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
                        <span>Daftar Member Sekarang</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </li>
            </ul>

            <!-- Header Actions -->
            <div class="nav-actions" style="display: flex; align-items: center; gap: 0.85rem;">
                <!-- Mobile Toggle Button (Top Right) -->
                <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
