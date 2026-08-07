@extends('admin.layout')

@section('title', 'Broadcast WhatsApp Massal - Admin FitLife Center')
@section('header_title', 'Broadcast WhatsApp Massal & Notifikasi Event')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #10b981; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2;">
            <span style="background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); color: var(--brand-lime, #84cc16); margin-bottom: 0.75rem; display: inline-block;">
                📲 MASS WHATSAPP BROADCAST ENGINE
            </span>
            <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                Kirim Pesan WhatsApp Massal ke Seluruh Member &amp; Pendaftar
            </h2>
            <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                Kirim pengumuman promo, ucapan ulang tahun, atau pengingat top-up kuota sesi PT dalam 1 klik via Wablas/Fonnte API.
            </p>
        </div>
    </div>

    <!-- Target Audience Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid var(--brand-lime, #84cc16); border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">SEMUA KONTAK WA</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['all'] }} Kontak
            </div>
            <div style="font-size: 0.75rem; color: var(--brand-lime, #84cc16); font-weight: 800; margin-top: 0.3rem;">
                Total Kontak Terdata
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #06b6d4; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">MEMBER AKTIF</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['active'] }} Member
            </div>
            <div style="font-size: 0.75rem; color: #06b6d4; font-weight: 800; margin-top: 0.3rem;">
                Status Aktif Saja
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #ef4444; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #ef4444; text-transform: uppercase; letter-spacing: 0.05em;">⚠️ KUOTA TERSIASA ≤ 2 SESI</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['low_sessions'] }} Member
            </div>
            <div style="font-size: 0.75rem; color: #ef4444; font-weight: 800; margin-top: 0.3rem;">
                Prospek Top-Up Sesi
            </div>
        </div>

        <div class="admin-card admin-card-hover" style="padding: 1.25rem 1.5rem; border-radius: 1.15rem; background: var(--admin-card-bg, #0d1410); border-top: 4px solid #8b5cf6; border-left: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-right: 1px solid var(--admin-border, rgba(255,255,255,0.08)); border-bottom: 1px solid var(--admin-border, rgba(255,255,255,0.08));">
            <span style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">TOTAL SELURUH MEMBER</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['members'] }} User
            </div>
            <div style="font-size: 0.75rem; color: #8b5cf6; font-weight: 800; margin-top: 0.3rem;">
                Semua Akun Member
            </div>
        </div>
    </div>

    <!-- Main Broadcast Form -->
    <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); shadow: 0 15px 35px rgba(0,0,0,0.4);">
        <h4 style="font-size: 1.2rem; color: #ffffff; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-brands fa-whatsapp" style="color: var(--brand-lime, #84cc16); font-size: 1.4rem;"></i> Form Pengiriman Broadcast WhatsApp
        </h4>

        <form action="{{ route('admin.wa-broadcast.send') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.825rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                    TARGET PENERIMA BROADCAST WA <span style="color: #ef4444;">*</span>
                </label>
                <select name="target_group" required style="width: 100%; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.75rem; padding: 0.75rem 1rem; font-weight: 800; outline: none; font-size: 0.95rem; background: #121c17; color: #ffffff; color-scheme: dark;">
                    <option value="all">📢 Seluruh Kontak WA (Member + Pendaftar) — [{{ $targetCounts['all'] }} Kontak]</option>
                    <option value="low_sessions">⚠️ Target Khusus: Member dengan Kuota Sesi ≤ 2 (Prospek Top-Up) — [{{ $targetCounts['low_sessions'] }} Member]</option>
                    <option value="active">🟢 Member Status Aktif Saja — [{{ $targetCounts['active'] }} Member]</option>
                    <option value="members">👤 Seluruh Akun Member — [{{ $targetCounts['members'] }} User]</option>
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 800; color: #cbd5e1; margin: 0; letter-spacing: 0.05em;">
                        PESAN TEMPLATE BROADCAST <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="font-size: 0.75rem; color: #94a3b8;">
                        Variabel Otomatis: <code style="color: var(--brand-lime, #84cc16); font-weight: bold; background: rgba(132,204,22,0.1); padding: 0.1rem 0.35rem; border-radius: 4px;">{name}</code>, <code style="color: var(--brand-lime, #84cc16); font-weight: bold; background: rgba(132,204,22,0.1); padding: 0.1rem 0.35rem; border-radius: 4px;">{sessions}</code>, <code style="color: var(--brand-lime, #84cc16); font-weight: bold; background: rgba(132,204,22,0.1); padding: 0.1rem 0.35rem; border-radius: 4px;">{card_id}</code>
                    </div>
                </div>
                <textarea name="message_template" rows="7" required placeholder="Halo Kak {name}, sisa kuota sesi PT Anda saat ini tinggal {sessions} sesi lagi. Yuk top-up sekarang agar latihan fisik tidak terputus!" style="width: 100%; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 1rem; font-weight: 600; outline: none; font-family: inherit; font-size: 0.95rem; line-height: 1.5; background: #121c17; color: #ffffff;">🔥 *PROMO SPESIAL FITLIFE CENTER JOGJA* 🔥

Halo Kak *{name}* ({card_id}), 

Dapatkan diskon khusus Top-Up Sesi Personal Trainer pekan ini! Gunakan voucher promo *FITJOGJA50* untuk potongan Rp 50.000 via QRIS Midtrans.

Buka portal member Anda di {{ url('/login') }} untuk klaim promo sekarang! 💪</textarea>
            </div>

            <div style="display: flex; justify-content: space-between; gap: 1rem; align-items: center; flex-wrap: wrap;">
                <span style="font-size: 0.8rem; color: #94a3b8;">Pesan akan dikirimkan berurutan via WhatsApp Gateway Server.</span>
                <button type="submit" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border: none; padding: 0.85rem 1.75rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.65rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.35);">
                    <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i> KIRIM BROADCAST WHATSAPP SEKARANG
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
