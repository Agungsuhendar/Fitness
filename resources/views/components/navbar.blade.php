<nav class="navbar" style="background: rgba(10, 15, 13, 0.95); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.08); position: fixed; top: 0; left: 0; width: 100%; z-index: 100000; padding: 0.8rem 0; margin: 0;">
    <div class="container">
        <div class="navbar-inner" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; position: relative; width: 100%; flex-wrap: nowrap;">
            
            <!-- Brand Logo FitLife -->
            <a href="{{ route('home') }}" class="brand-logo" aria-label="FitLife Homepage" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; flex-shrink: 0;">
                <img src="{{ asset('images/logo.png') }}" alt="FitLife Logo" style="height: 46px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(132, 204, 22, 0.3));">
            </a>

            <!-- ========================================================= -->
            <!-- 1. EKSKLUSIF DESKTOP FLAT HORIZONTAL MENU (Layar >= 992px) -->
            <!-- ========================================================= -->
            <ul class="desktop-nav-links hidden-mobile" style="display: flex; flex-direction: row; align-items: center; gap: 1.25rem; list-style: none; margin: 0; padding: 0; white-space: nowrap; flex-wrap: nowrap;">
                
                <!-- Beranda -->
                <li style="display: inline-flex; align-items: center; flex-shrink: 0;">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" style="color: #cbd5e1; text-decoration: none; font-weight: 700; font-size: 0.9rem; padding: 0.45rem 0.25rem; white-space: nowrap;">
                        Beranda
                        @if(request()->routeIs('home'))
                            <span class="active-indicator"></span>
                        @endif
                    </a>
                </li>

                <!-- Fasilitas Gym (Dropdown Desktop) -->
                <li class="nav-dropdown-item" style="display: inline-flex; align-items: center; flex-shrink: 0; position: relative;">
                    <a href="javascript:void(0)" class="dropdown-trigger-btn nav-link {{ request()->routeIs('lokasi', 'virtual-tour', 'kelas') ? 'active' : '' }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #cbd5e1; text-decoration: none; font-weight: 700; font-size: 0.9rem; padding: 0.45rem 0.25rem; white-space: nowrap;">
                        <span>Fasilitas Gym</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; color: #84cc16;"></i>
                    </a>
                    <div class="nav-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.15rem; padding: 0.75rem 0.5rem; min-width: 240px; box-shadow: 0 20px 40px rgba(0,0,0,0.95), 0 0 25px rgba(132,204,22,0.2); flex-direction: column; gap: 0.25rem; z-index: 100005;">
                        <a href="{{ route('lokasi') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-location-dot" style="color: #84cc16; width: 16px;"></i>
                            <span>Lokasi Studio</span>
                        </a>
                        <a href="{{ route('virtual-tour') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #ffffff !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-vr-cardboard" style="color: #ffffff; width: 16px;"></i>
                            <span style="color: #ffffff !important;">Tur Virtual 360°</span>
                        </a>
                        <a href="{{ route('kelas') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-people-group" style="color: #fbbf24; width: 16px;"></i>
                            <span>Jadwal Kelas Group</span>
                        </a>
                    </div>
                </li>

                <!-- Program & Fitur (Dropdown Desktop) -->
                <li class="nav-dropdown-item" style="display: inline-flex; align-items: center; flex-shrink: 0; position: relative;">
                    <a href="javascript:void(0)" class="dropdown-trigger-btn nav-link {{ request()->routeIs('program.*', 'pelatih', 'toko', 'kalkulator', 'quiz') ? 'active' : '' }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #cbd5e1; text-decoration: none; font-weight: 700; font-size: 0.9rem; padding: 0.45rem 0.25rem; white-space: nowrap;">
                        <span>Program &amp; Fitur</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; color: #84cc16;"></i>
                    </a>
                    <div class="nav-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.15rem; padding: 0.75rem 0.5rem; min-width: 240px; box-shadow: 0 20px 40px rgba(0,0,0,0.95), 0 0 25px rgba(132,204,22,0.2); flex-direction: column; gap: 0.25rem; z-index: 100005;">
                        <a href="{{ route('program.index') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-dumbbell" style="color: #84cc16; width: 16px;"></i>
                            <span>Personal Trainer</span>
                        </a>
                        <a href="{{ route('pelatih') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-user-ninja" style="color: #ec4899; width: 16px;"></i>
                            <span>Profil Trainer</span>
                        </a>
                        <a href="{{ route('toko') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-store" style="color: #38bdf8; width: 16px;"></i>
                            <span>Toko Suplemen</span>
                        </a>
                        <a href="{{ route('kalkulator') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-calculator" style="color: #fbbf24; width: 16px;"></i>
                            <span>Kalkulator Fitness</span>
                        </a>
                        <a href="{{ route('quiz') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-list-check" style="color: #a78bfa; width: 16px;"></i>
                            <span>Kuis Rekomendasi (Quiz)</span>
                        </a>
                    </div>
                </li>

                <!-- Informasi (Dropdown Desktop) -->
                <li class="nav-dropdown-item" style="display: inline-flex; align-items: center; flex-shrink: 0; position: relative;">
                    <a href="javascript:void(0)" class="dropdown-trigger-btn nav-link {{ request()->routeIs('harga', 'tentang', 'testimoni', 'blog.*', 'kontak') ? 'active' : '' }}" style="display: inline-flex; align-items: center; gap: 0.4rem; color: #cbd5e1; text-decoration: none; font-weight: 700; font-size: 0.9rem; padding: 0.45rem 0.25rem; white-space: nowrap;">
                        <span>Informasi</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem; color: #84cc16;"></i>
                    </a>
                    <div class="nav-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; background: #0d1310; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.15rem; padding: 0.75rem 0.5rem; min-width: 240px; box-shadow: 0 20px 40px rgba(0,0,0,0.95), 0 0 25px rgba(132,204,22,0.2); flex-direction: column; gap: 0.25rem; z-index: 100005;">
                        <a href="{{ route('harga') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #ffffff !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-tags" style="color: #ffffff; width: 16px;"></i>
                            <span style="color: #ffffff !important;">Harga &amp; Paket</span>
                        </a>
                        <a href="{{ route('tentang') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-circle-info" style="color: #38bdf8; width: 16px;"></i>
                            <span>Tentang FitLife</span>
                        </a>
                        <a href="{{ route('testimoni') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-star" style="color: #fbbf24; width: 16px;"></i>
                            <span>Ulasan Member</span>
                        </a>
                        <a href="{{ route('blog.index') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-newspaper" style="color: #a78bfa; width: 16px;"></i>
                            <span>Artikel &amp; Blog</span>
                        </a>
                        <a href="{{ route('kontak') }}" class="nav-dropdown-link" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.65rem 1rem; border-radius: 0.75rem; color: #cbd5e1 !important; font-size: 0.85rem; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-phone" style="color: #4ade80; width: 16px;"></i>
                            <span>Hubungi Kami</span>
                        </a>
                    </div>
                </li>

                <!-- Member Button -->
                <li style="display: inline-flex; align-items: center; flex-shrink: 0;">
                    <a href="{{ route('member.dashboard') }}" class="btn" style="background: rgba(255,255,255,0.06); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.15); padding: 0.45rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.45rem; white-space: nowrap;">
                        <i class="fa-solid fa-user-check" style="color: #84cc16;"></i>
                        <span>Member</span>
                    </a>
                </li>

                <!-- CTA Button Daftar Trial -->
                <li style="display: inline-flex; align-items: center; flex-shrink: 0;">
                    <button type="button" onclick="openTrialModal()" class="btn glow-btn" style="background: var(--brand-primary, #84cc16); color: #ffffff !important; border: none; padding: 0.45rem 1.15rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.45rem; box-shadow: 0 0 15px var(--brand-glow, rgba(132,204,22,0.4)); white-space: nowrap;">
                        <i class="fa-solid fa-bolt" style="color: #ffffff !important;"></i>
                        <span style="color: #ffffff !important;">Daftar Trial</span>
                    </button>
                </li>
            </ul>

            <!-- Right Header Actions (Tombol Tema + Tombol Hamburger Toggle Mobile) -->
            <div class="nav-actions" style="display: flex; align-items: center; gap: 0.75rem; position: relative; z-index: 100001; flex-shrink: 0;">
                <!-- Icon-Only Theme Switcher Button (Bulat Sempurna 1:1) -->
                <div style="position: relative; flex-shrink: 0;">
                    <button type="button" onclick="toggleThemePickerMenu(event)" class="btn" style="background: rgba(255,255,255,0.08); color: var(--brand-primary, #84cc16); border: 1.5px solid rgba(255,255,255,0.25); width: 42px !important; height: 42px !important; min-width: 42px !important; min-height: 42px !important; padding: 0 !important; border-radius: 50% !important; display: inline-flex; align-items: center; justify-content: center; font-size: 1.1rem; cursor: pointer; transition: all 0.25s ease; flex-shrink: 0; box-shadow: 0 0 12px rgba(0,0,0,0.3);" title="Ganti Tema Warna Website">
                        <i class="fa-solid fa-palette"></i>
                    </button>
                    
                    <div id="themePickerMenu" style="display: none; position: absolute; top: calc(100% + 0.5rem); right: 0; background: #0d1310; border: 2px solid var(--brand-primary, #84cc16); border-radius: 1.15rem; padding: 0.75rem; min-width: 220px; box-shadow: 0 20px 40px rgba(0,0,0,0.9), 0 0 25px var(--brand-glow, rgba(132,204,22,0.4)); flex-direction: column; gap: 0.4rem; z-index: 100000;">
                        <span style="font-size: 0.725rem; color: #94a3b8; font-weight: 800; text-transform: uppercase; padding: 0.2rem 0.5rem;">PILIH TEMA WARNA:</span>
                        <a href="javascript:void(0)" onclick="applyTheme('neon')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: white; text-decoration: none; font-size: 0.85rem; font-weight: 800; background: rgba(132,204,22,0.1);">
                            <span style="width: 14px; height: 14px; border-radius: 50%; background: #84cc16; display: inline-block; box-shadow: 0 0 8px #84cc16;"></span>
                            <span>Neon Lime (Default)</span>
                        </a>
                        <a href="javascript:void(0)" onclick="applyTheme('cyberpunk')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: white; text-decoration: none; font-size: 0.85rem; font-weight: 800; background: rgba(244,63,94,0.1);">
                            <span style="width: 14px; height: 14px; border-radius: 50%; background: #f43f5e; display: inline-block; box-shadow: 0 0 8px #f43f5e;"></span>
                            <span>Cyberpunk Crimson</span>
                        </a>
                        <a href="javascript:void(0)" onclick="applyTheme('cyan')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: white; text-decoration: none; font-size: 0.85rem; font-weight: 800; background: rgba(6,182,212,0.1);">
                            <span style="width: 14px; height: 14px; border-radius: 50%; background: #06b6d4; display: inline-block; box-shadow: 0 0 8px #06b6d4;"></span>
                            <span>Electric Cyan</span>
                        </a>
                        <a href="javascript:void(0)" onclick="applyTheme('gold')" style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.85rem; border-radius: 0.75rem; color: white; text-decoration: none; font-size: 0.85rem; font-weight: 800; background: rgba(234,179,8,0.1);">
                            <span style="width: 14px; height: 14px; border-radius: 50%; background: #eab308; display: inline-block; box-shadow: 0 0 8px #eab308;"></span>
                            <span>Gold VIP Luxury</span>
                        </a>
                    </div>
                </div>

                <!-- Mobile Toggle Button (Hanya Muncul di Layar Mobile < 992px) -->
                <button class="mobile-toggle mobile-only" id="mobileNavToggle" aria-label="Toggle Navigation" style="background: rgba(255,255,255,0.08); color: white; border: 1.5px solid rgba(255,255,255,0.2); width: 42px; height: 42px; border-radius: 0.75rem; font-size: 1.25rem; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- ========================================================= -->
        <!-- 2. EKSKLUSIF MOBILE DRAWER MENU (Ter-view Lengkap 100%) -->
        <!-- ========================================================= -->
        <div id="mobileNavDrawer" class="mobile-only" style="display: none; position: absolute; top: 100%; left: 0; width: 100%; max-height: 85vh; overflow-y: auto; background: rgba(13, 19, 16, 0.98); backdrop-filter: blur(20px); border-bottom: 2px solid var(--brand-primary, #84cc16); padding: 1.25rem 1.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.95); z-index: 99999; flex-direction: column; gap: 0.4rem;">
            
            <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #ffffff; text-decoration: none; font-weight: 800; padding: 0.6rem 0; border-bottom: 1px solid rgba(255,255,255,0.08);">
                <i class="fa-solid fa-house" style="color: #84cc16; width: 22px;"></i>
                <span>Beranda</span>
            </a>

            <!-- Category 1: Fasilitas Gym -->
            <div style="font-size: 0.7rem; font-weight: 800; color: #84cc16; text-transform: uppercase; letter-spacing: 0.05em; padding-top: 0.6rem; padding-bottom: 0.15rem;">Fasilitas Gym</div>
            <a href="{{ route('lokasi') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-location-dot" style="color: #84cc16; width: 18px;"></i>
                <span>Lokasi Studio Gym</span>
            </a>
            <a href="{{ route('virtual-tour') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #ffffff !important; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-vr-cardboard" style="color: #ffffff; width: 18px;"></i>
                <span style="color: #ffffff !important;">Tur Virtual 360°</span>
            </a>
            <a href="{{ route('kelas') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-people-group" style="color: #fbbf24; width: 18px;"></i>
                <span>Jadwal Kelas Group</span>
            </a>

            <!-- Category 2: Program & Fitur -->
            <div style="font-size: 0.7rem; font-weight: 800; color: #84cc16; text-transform: uppercase; letter-spacing: 0.05em; padding-top: 0.6rem; padding-bottom: 0.15rem;">Program & Fitur</div>
            <a href="{{ route('program.index') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-dumbbell" style="color: #84cc16; width: 18px;"></i>
                <span>Personal Trainer</span>
            </a>
            <a href="{{ route('pelatih') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-user-ninja" style="color: #ec4899; width: 18px;"></i>
                <span>Profil Trainer</span>
            </a>
            <a href="{{ route('toko') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-store" style="color: #38bdf8; width: 18px;"></i>
                <span>Toko Suplemen</span>
            </a>
            <a href="{{ route('kalkulator') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-calculator" style="color: #fbbf24; width: 18px;"></i>
                <span>Kalkulator Fitness</span>
            </a>
            <a href="{{ route('quiz') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-list-check" style="color: #a78bfa; width: 18px;"></i>
                <span>Kuis Rekomendasi (Quiz)</span>
            </a>

            <!-- Category 3: Informasi -->
            <div style="font-size: 0.7rem; font-weight: 800; color: #84cc16; text-transform: uppercase; letter-spacing: 0.05em; padding-top: 0.6rem; padding-bottom: 0.15rem;">Informasi</div>
            <a href="{{ route('harga') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #ffffff !important; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-tags" style="color: #ffffff; width: 18px;"></i>
                <span style="color: #ffffff !important;">Harga &amp; Paket</span>
            </a>
            <a href="{{ route('tentang') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-circle-info" style="color: #38bdf8; width: 18px;"></i>
                <span>Tentang FitLife</span>
            </a>
            <a href="{{ route('testimoni') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-star" style="color: #fbbf24; width: 18px;"></i>
                <span>Ulasan Member</span>
            </a>
            <a href="{{ route('blog.index') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-newspaper" style="color: #a78bfa; width: 18px;"></i>
                <span>Artikel &amp; Blog</span>
            </a>
            <a href="{{ route('kontak') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #cbd5e1; text-decoration: none; font-weight: 700; padding: 0.5rem 0.65rem; border-radius: 0.5rem; background: rgba(255,255,255,0.03);">
                <i class="fa-solid fa-phone" style="color: #4ade80; width: 18px;"></i>
                <span>Hubungi Kami</span>
            </a>

            <!-- Area Member -->
            <a href="{{ route('member.dashboard') }}" style="display: flex; align-items: center; gap: 0.75rem; color: #ffffff; text-decoration: none; font-weight: 800; padding: 0.6rem 0; border-top: 1px solid rgba(255,255,255,0.08); margin-top: 0.4rem;">
                <i class="fa-solid fa-user-check" style="color: #84cc16; width: 22px;"></i>
                <span>Area Member</span>
            </a>

            <!-- Action Buttons Mobile -->
            <div style="display: flex; flex-direction: column; gap: 0.65rem; margin-top: 0.5rem; padding-bottom: 0.5rem;">
                <button type="button" onclick="openTrialModal()" style="width: 100%; background: rgba(255, 255, 255, 0.08); color: #ffffff !important; border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.75rem 1.2rem; border-radius: 99px; font-weight: 700; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <i class="fa-regular fa-compass" style="color: #84cc16;"></i>
                    <span style="color: #ffffff !important;">Daftar Trial 7 Hari</span>
                </button>

                <button type="button" onclick="openRegistrationModal()" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.75rem 1.35rem; border-radius: 99px; font-weight: 900; font-size: 0.9rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4);">
                    <span style="color: #ffffff !important;">Daftar Member Sekarang</span>
                    <i class="fa-solid fa-arrow-right" style="color: #ffffff !important;"></i>
                </button>
            </div>
        </div>

    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('mobileNavToggle');
        const drawer = document.getElementById('mobileNavDrawer');
        
        if (toggleBtn && drawer) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                drawer.classList.toggle('active');
                if (drawer.classList.contains('active')) {
                    drawer.style.setProperty('display', 'flex', 'important');
                } else {
                    drawer.style.setProperty('display', 'none', 'important');
                }
            });

            // Close mobile drawer when clicking anywhere outside
            document.addEventListener('click', function(e) {
                if (drawer && drawer.classList.contains('active') && !drawer.contains(e.target) && !toggleBtn.contains(e.target)) {
                    drawer.classList.remove('active');
                    drawer.style.setProperty('display', 'none', 'important');
                }
            });

            // Close mobile drawer when clicking any link or button inside drawer
            drawer.querySelectorAll('a, button').forEach(function(item) {
                item.addEventListener('click', function() {
                    drawer.classList.remove('active');
                    drawer.style.setProperty('display', 'none', 'important');
                });
            });
        }

        // Desktop Dropdown Trigger Click & Hover Handler
        document.querySelectorAll('.nav-dropdown-item').forEach(function(item) {
            const trigger = item.querySelector('.dropdown-trigger-btn');
            const menu = item.querySelector('.nav-dropdown-menu');

            if (trigger && menu) {
                trigger.addEventListener('click', function(e) {
                    if (window.innerWidth >= 992) {
                        e.preventDefault();
                        e.stopPropagation();
                        const isShowing = item.classList.contains('show');
                        document.querySelectorAll('.nav-dropdown-item').forEach(function(other) {
                            other.classList.remove('show');
                            const otherMenu = other.querySelector('.nav-dropdown-menu');
                            if (otherMenu) otherMenu.style.setProperty('display', 'none', 'important');
                        });
                        if (!isShowing) {
                            item.classList.add('show');
                            menu.style.setProperty('display', 'flex', 'important');
                        }
                    }
                });

                item.addEventListener('mouseenter', function() {
                    if (window.innerWidth >= 992) {
                        menu.style.setProperty('display', 'flex', 'important');
                    }
                });

                item.addEventListener('mouseleave', function() {
                    if (window.innerWidth >= 992) {
                        if (!item.classList.contains('show')) {
                            menu.style.setProperty('display', 'none', 'important');
                        }
                    }
                });
            }
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.nav-dropdown-item')) {
                document.querySelectorAll('.nav-dropdown-item').forEach(function(item) {
                    item.classList.remove('show');
                    const menu = item.querySelector('.nav-dropdown-menu');
                    if (menu) menu.style.setProperty('display', 'none', 'important');
                });
            }
            const menu = document.getElementById('themePickerMenu');
            if (menu && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
    });

    function toggleThemePickerMenu(e) {
        if (e) e.stopPropagation();
        const menu = document.getElementById('themePickerMenu');
        if (menu.style.display === 'none' || !menu.style.display) {
            menu.style.display = 'flex';
        } else {
            menu.style.display = 'none';
        }
    }

    function applyTheme(themeName) {
        if (themeName === 'neon') {
            document.documentElement.removeAttribute('data-theme');
            document.body.removeAttribute('data-theme');
            localStorage.removeItem('fitlife_theme');
        } else {
            document.documentElement.setAttribute('data-theme', themeName);
            document.body.setAttribute('data-theme', themeName);
            localStorage.setItem('fitlife_theme', themeName);
        }
        document.getElementById('themePickerMenu').style.display = 'none';
    }
</script>
