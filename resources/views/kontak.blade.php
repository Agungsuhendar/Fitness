@extends('layouts.app')

@section('title', 'Hubungi Kami & Layanan Pelanggan - Les Renang Jogja')
@section('meta_description', 'Kontak resmi Les Renang Jogja. WhatsApp, Formulir Konsultasi Gratis, Jam Operasional, & Peta Alamat Office.')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Layanan Pelanggan</span>
            <h1 class="hero-title">Hubungi <span class="text-gradient">Les Renang Jogja</span></h1>
            <p class="hero-description">
                Tim customer service dan instruktur kami siap membantu melayani konsultasi jadwal, lokasi kolam, dan pendaftaran Anda 7 hari seminggu.
            </p>
        </div>
    </div>
</section>

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-2" style="gap: 3rem;">
            <!-- Left Info -->
            <div>
                <div class="glass-card" style="padding: 2.25rem; background: #ffffff; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1.25rem;">Informasi Layanan</h3>
                    
                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem;">
                        <div style="width: 46px; height: 46px; background: rgba(37, 211, 102, 0.15); color: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--dark);">WhatsApp Admin Direct</div>
                            <div style="color: var(--text-muted); font-size: 0.9rem;">+62 812-3456-7890 (Respon Cepat)</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem;">
                        <div style="width: 46px; height: 46px; background: rgba(2, 132, 199, 0.15); color: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--dark);">Jam Operasional Latihan</div>
                            <div style="color: var(--text-muted); font-size: 0.9rem;">Senin – Minggu: 06.00 – 20.00 WIB</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem;">
                        <div style="width: 46px; height: 46px; background: rgba(245, 158, 11, 0.15); color: var(--accent-hover); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div style="font-weight: 800; color: var(--dark);">Kantor & Basecamp</div>
                            <div style="color: var(--text-muted); font-size: 0.9rem;">Jl. Colombo No.1, Caturtunggal, Depok, Sleman, D.I. Yogyakarta 55281</div>
                        </div>
                    </div>
                </div>

                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20konsultasi%20langsung" target="_blank" class="btn btn-whatsapp btn-lg" style="width: 100%;">
                    <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp Sekarang
                </a>
            </div>

            <!-- Right Contact Form -->
            <div>
                <div class="glass-card" style="padding: 2.25rem; background: #ffffff;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Kirim Pesan Konsultasi</h3>
                    <form action="{{ route('lead.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. WhatsApp</label>
                            <input type="tel" name="phone" class="form-control" placeholder="081234567890" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori Program</label>
                            <select name="program_name" class="form-control">
                                <option value="Les Renang Anak">Les Renang Anak</option>
                                <option value="Les Renang Dewasa Pemula">Les Renang Dewasa Pemula</option>
                                <option value="Les Renang Wanita">Les Renang Wanita</option>
                                <option value="Persiapan TNI/POLRI">Persiapan TNI/POLRI</option>
                            </select>
                        </div>
                        <input type="hidden" name="age_category" value="Umum">
                        <input type="hidden" name="preferred_location" value="Yogyakarta">
                        <input type="hidden" name="preferred_schedule" value="Fleksibel">
                        <div class="form-group">
                            <label class="form-label">Pesan / Pertanyaan</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Tuliskan pertanyaan atau kebutuhan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan via WA
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
