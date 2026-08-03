<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Col 1: Brand Info & SEO Text -->
            <div>
                <div style="display: flex; align-items: center; gap: 0.85rem; margin-bottom: 1.25rem;">
                    <img src="{{ asset('images/logo.webp') }}" alt="Les Renang Jogja Logo" style="height: 64px; width: auto; object-fit: contain; border-radius: 8px; background: white; padding: 4px;">
                    <div>
                        <span style="font-size: 1.35rem; font-weight: 900; color: #ffffff; display: block; line-height: 1.1;">LES RENANG JOGJA</span>
                        <span style="font-size: 0.725rem; font-weight: 700; color: var(--accent); letter-spacing: 1px; text-transform: uppercase;">KURSUS PRIVAT TERPERCAYA</span>
                    </div>
                </div>
                <p style="font-size: 0.925rem; line-height: 1.7; margin-bottom: 1.5rem; color: #94a3b8;">
                    Pusat pelatihan & kursus privat renang terpercaya di Yogyakarta. Menyediakan program khusus anak-anak, dewasa pemula, privat wanita/muslimah, serta kelas intensif persiapan tes TNI, POLRI & Kedinasan.
                </p>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="https://instagram.com" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://tiktok.com" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://youtube.com" target="_blank" style="width: 38px; height: 38px; background: #1e293b; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/6281234567890" target="_blank" style="width: 38px; height: 38px; background: #25d366; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: background 0.2s;"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Col 2: Navigation Links -->
            <div>
                <h4 class="footer-title">Program Pilihan</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('program.show', 'les-renang-anak') }}">Les Renang Anak (3-15 Th)</a></li>
                    <li><a href="{{ route('program.show', 'les-renang-dewasa') }}">Les Renang Dewasa Pemula</a></li>
                    <li><a href="{{ route('program.show', 'les-renang-wanita') }}">Les Renang Wanita / Muslimah</a></li>
                    <li><a href="{{ route('program.show', 'persiapan-tni-polri') }}">Persiapan Tes TNI & POLRI</a></li>
                    <li><a href="{{ route('program.show', 'terapi-renang') }}">Terapi Renang Medis</a></li>
                    <li><a href="{{ route('program.show', 'corporate-training') }}">Corporate & Group Class</a></li>
                </ul>
            </div>

            <!-- Col 3: Service Areas (Target SEO keywords) -->
            <div>
                <h4 class="footer-title">Area Layanan</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('lokasi') }}">Sleman & Depok (UNY / DSC)</a></li>
                    <li><a href="{{ route('lokasi') }}">Kota Yogyakarta & Umbulharjo</a></li>
                    <li><a href="{{ route('lokasi') }}">Bantul & Kasihan</a></li>
                    <li><a href="{{ route('lokasi') }}">Kulon Progo</a></li>
                    <li><a href="{{ route('lokasi') }}">Semarang & Solo</a></li>
                    <li><a href="{{ route('lokasi') }}">Magelang & Klaten</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & Hours -->
            <div>
                <h4 class="footer-title">Informasi & Kontak</h4>
                <div style="font-size: 0.9rem; margin-bottom: 1rem; color: #94a3b8;">
                    <p style="margin-bottom: 0.5rem;"><i class="fa-solid fa-location-dot" style="color: var(--primary); margin-right: 0.5rem;"></i> Head Office: Sleman, D.I. Yogyakarta</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-brands fa-whatsapp" style="color: #25d366; margin-right: 0.5rem;"></i> +62 812-3456-7890 (Admin WA)</p>
                    <p style="margin-bottom: 0.5rem;"><i class="fa-regular fa-clock" style="color: var(--accent); margin-right: 0.5rem;"></i> Buka Setiap Hari: 06.00 - 20.00 WIB</p>
                </div>
                <button onclick="openTrialModal()" class="btn btn-accent btn-sm" style="width: 100%;">
                    <i class="fa-solid fa-bolt"></i> Booking Trial Gratis 30m
                </button>
            </div>
        </div>

        <!-- SEO Target Keywords Footer Tag Cloud -->
        <div style="border-top: 1px solid rgba(255,255,255,0.08); margin-top: 2.5rem; padding-top: 1.5rem; font-size: 0.825rem; color: #64748b;">
            <div style="font-weight: 800; color: #94a3b8; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;">
                <i class="fa-solid fa-tags" style="color: var(--accent);"></i> Kata Kunci Pencarian Populer:
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; line-height: 1.8;">
                <a href="{{ route('program.show', 'les-renang-anak') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Les Renang Jogja</a>
                <a href="{{ route('program.show', 'les-renang-anak') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Les Renang Anak Jogja</a>
                <a href="{{ route('program.show', 'les-renang-dewasa') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Les Renang Dewasa Yogyakarta</a>
                <a href="{{ route('program.show', 'les-renang-wanita') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Pelatih Renang Wanita Muslimah Jogja</a>
                <a href="{{ route('program.show', 'persiapan-tni-polri') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Renang TNI POLRI Jogja</a>
                <a href="{{ route('harga') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Biaya Les Renang Privat Jogja</a>
                <a href="{{ route('lokasi') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Les Renang Sleman Depok UGM</a>
                <a href="{{ route('lokasi') }}" style="color: #94a3b8; text-decoration: none; background: rgba(255,255,255,0.04); padding: 0.2rem 0.6rem; border-radius: 4px;">Les Renang Bantul & Kota Jogja</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                © {{ date('Y') }} <strong>Les Renang Jogja</strong>. Hak Cipta Dilindungi Undang-Undang.
            </div>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; justify-content: center;">
                <a href="{{ route('faq') }}" style="color: #64748b; text-decoration: none;">FAQ</a>
                <a href="{{ route('blog.index') }}" style="color: #64748b; text-decoration: none;">Artikel Tips</a>
                <a href="{{ route('kontak') }}" style="color: #64748b; text-decoration: none;">Hubungi Kami</a>
                <a href="{{ route('admin.login') }}" style="color: #64748b; text-decoration: none;"><i class="fa-solid fa-lock"></i> Admin Panel</a>
            </div>
        </div>
    </div>
</footer>
