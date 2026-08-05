<nav class="navbar" style="background: rgba(10, 15, 13, 0.95); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.08); position: fixed; top: 0; left: 0; width: 100%; z-index: 10000; padding: 0.9rem 0; margin: 0;">
    <div class="container">
        <div class="navbar-inner" style="display: flex; align-items: center; justify-content: space-between;">
            <!-- Brand Logo FitLife -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="FitLife Homepage" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <img src="{{ asset('images/logo.png') }}" alt="FitLife Logo" style="height: 46px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(132, 204, 22, 0.3));">
            </a>

            <!-- Desktop Nav Links -->
            <ul class="nav-links" id="mobileNavMenu" style="display: flex; align-items: center; gap: 1.75rem; list-style: none; margin: 0; padding: 0;">
                <li>
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" style="color: {{ request()->routeIs('home') ? '#84cc16' : '#cbd5e1' }}; text-decoration: none; font-weight: 700; font-size: 0.925rem; position: relative; padding-bottom: 0.3rem;">
                        Beranda
                        @if(request()->routeIs('home'))
                            <span style="position: absolute; bottom: -2px; left: 0; width: 100%; height: 3px; background: #84cc16; border-radius: 99px;"></span>
                        @endif
                    </a>
                </li>
                <li><a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Tentang</a></li>
                <li><a href="{{ route('program.index') }}" class="nav-link {{ request()->routeIs('program.*') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Program</a></li>
                <li><a href="{{ route('lokasi') }}" class="nav-link {{ request()->routeIs('lokasi') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Fasilitas</a></li>
                <li><a href="{{ route('harga') }}" class="nav-link {{ request()->routeIs('harga') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Harga</a></li>
                <li><a href="{{ route('testimoni') }}" class="nav-link {{ request()->routeIs('testimoni') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Testimoni</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Blog</a></li>
                <li><a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.925rem;">Kontak</a></li>
            </ul>

            <!-- Header Actions -->
            <div class="nav-actions" style="display: flex; align-items: center; gap: 0.85rem;">
                <button type="button" onclick="openTrialModal()" style="background: rgba(255, 255, 255, 0.05); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.6rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.875rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s;">
                    <i class="fa-regular fa-compass" style="color: #cbd5e1; font-size: 0.85rem;"></i>
                    <span>Trial Gratis</span>
                </button>

                <button type="button" onclick="openRegistrationModal()" style="background: #84cc16; color: #090d0b; border: none; padding: 0.65rem 1.35rem; border-radius: 99px; font-weight: 900; font-size: 0.875rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
                    <span>Daftar Sekarang</span>
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.85rem;"></i>
                </button>

                <!-- Mobile Hamburger Button -->
                <button class="mobile-toggle" id="mobileNavToggle" aria-label="Toggle Navigation" style="background: transparent; border: none; color: white; font-size: 1.35rem; cursor: pointer; display: none;">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
