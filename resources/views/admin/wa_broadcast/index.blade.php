@extends('admin.layout')

@section('title', 'Broadcast WhatsApp Massal - Admin FitLife Center')
@section('header_title', 'Broadcast WhatsApp Massal & Notifikasi Event')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #15803d 0%, #22c55e 100%); color: white; padding: 2rem; border-radius: 1.5rem; margin-bottom: 2rem; box-shadow: 0 15px 35px rgba(34, 197, 94, 0.25);">
        <span style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(255,255,255,0.3); margin-bottom: 0.75rem; display: inline-block;">
            📲 MASS WHATSAPP BROADCAST ENGINE
        </span>
        <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif;">
            Kirim Pesan WhatsApp Massal ke Seluruh Member &amp; Pendaftar
        </h2>
        <p style="color: #f0fdf4; margin: 0; font-size: 0.925rem;">
            Kirim pengumuman promo, ucapan ulang tahun, atau pengingat top-up kuota sesi PT dalam 1 klik via Wablas/Fonnte API.
        </p>
    </div>

    <!-- Target Audience Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;" class="grid-2">
        <div class="admin-card" style="padding: 1.25rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #22c55e;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #64748b; text-transform: uppercase;">SEMUA KONTAK WA</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #15803d; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['all'] }} Kontak
            </div>
        </div>

        <div class="admin-card" style="padding: 1.25rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #0284c7;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #0284c7; text-transform: uppercase;">MEMBER AKTIF</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #0284c7; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['active'] }} Member
            </div>
        </div>

        <div class="admin-card" style="padding: 1.25rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #ef4444;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #ef4444; text-transform: uppercase;">⚠️ KUOTA TERSIASA ≤ 2 SESI</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #ef4444; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['low_sessions'] }} Member
            </div>
        </div>

        <div class="admin-card" style="padding: 1.25rem; border-radius: 1.15rem; background: #ffffff; border-top: 4px solid #8b5cf6;">
            <span style="font-size: 0.75rem; font-weight: 800; color: #8b5cf6; text-transform: uppercase;">TOTAL SELURUH MEMBER</span>
            <div style="font-size: 1.7rem; font-weight: 900; color: #8b5cf6; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ $targetCounts['members'] }} User
            </div>
        </div>
    </div>

    <!-- Main Broadcast Form -->
    <div class="admin-card" style="padding: 2rem; border-radius: 1.5rem; background: #ffffff; border: 1.5px solid #e2e8f0; box-shadow: 0 15px 35px rgba(0,0,0,0.04);">
        <h4 style="font-size: 1.2rem; color: #0f172a; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.6rem;">
            <i class="fa-brands fa-whatsapp" style="color: #25d366; font-size: 1.4rem;"></i> Form Pengiriman Broadcast WhatsApp
        </h4>

        <form action="{{ route('admin.wa-broadcast.send') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 1.5rem;">
                <label style="font-size: 0.825rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.5rem;">
                    TARGET PENERIMA BROADCAST WA <span style="color: #ef4444;">*</span>
                </label>
                <select name="target_group" required style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.75rem; padding: 0.75rem 1rem; font-weight: 800; outline: none; font-size: 0.95rem; background: #ffffff;">
                    <option value="all">📢 Seluruh Kontak WA (Member + Pendaftar) — [{{ $targetCounts['all'] }} Kontak]</option>
                    <option value="low_sessions">⚠️ Target Khusus: Member dengan Kuota Sesi ≤ 2 (Prospek Top-Up) — [{{ $targetCounts['low_sessions'] }} Member]</option>
                    <option value="active">🟢 Member Status Aktif Saja — [{{ $targetCounts['active'] }} Member]</option>
                    <option value="members">👤 Seluruh Akun Member — [{{ $targetCounts['members'] }} User]</option>
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 800; color: #334155; margin: 0;">
                        PESAN TEMPLATE BROADCAST <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="font-size: 0.75rem; color: #64748b;">
                        Variabel Otomatis: <code style="color: #25d366; font-weight: bold;">{name}</code>, <code style="color: #25d366; font-weight: bold;">{sessions}</code>, <code style="color: #25d366; font-weight: bold;">{card_id}</code>
                    </div>
                </div>
                <textarea name="message_template" rows="7" required placeholder="Halo Kak {name}, sisa kuota sesi PT Anda saat ini tinggal {sessions} sesi lagi. Yuk top-up sekarang agar latihan fisik tidak terputus!" style="width: 100%; border: 1.5px solid #cbd5e1; border-radius: 0.85rem; padding: 1rem; font-weight: 600; outline: none; font-family: inherit; font-size: 0.95rem; line-height: 1.5;">🔥 *PROMO SPESIAL FITLIFE CENTER JOGJA* 🔥

Halo Kak *{name}* ({card_id}), 

Dapatkan diskon khusus Top-Up Sesi Personal Trainer pekan ini! Gunakan voucher promo *FITJOGJA50* untuk potongan Rp 50.000 via QRIS Midtrans.

Buka portal member Anda di {{ url('/login') }} untuk klaim promo sekarang! 💪</textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; align-items: center;">
                <span style="font-size: 0.8rem; color: #64748b;">Pesan akan dikirimkan berurutan via WhatsApp Gateway Server.</span>
                <button type="submit" class="btn glow-btn" style="background: linear-gradient(135deg, #25d366 0%, #16a34a 100%); color: white; border: none; padding: 0.85rem 1.75rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.65rem; box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);">
                    <i class="fa-brands fa-whatsapp" style="font-size: 1.2rem;"></i> KIRIM BROADCAST WHATSAPP SEKARANG
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
