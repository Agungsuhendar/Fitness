@extends('admin.layout')

@section('title', 'Kelola Kode Promo Voucher - Admin FitLife Center')
@section('header_title', 'Kelola Voucher & Kode Promo Diskon')

@section('admin_content')
<div style="width: 100%;">

    <div class="admin-card" style="padding: 1.75rem 2rem; margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h3 style="font-size: 1.4rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                    🎟️ Kode Voucher &amp; Promo Diskon Membership
                </h3>
                <p style="color: #cbd5e1; font-size: 0.875rem; margin: 0;">
                    Buat voucher promo khusus untuk pendaftar &amp; member saat checkout via Midtrans.
                </p>
            </div>
        </div>
    </div>

    <!-- Create Promo Voucher Form Box -->
    <div class="admin-card" style="padding: 1.5rem 1.75rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08)); margin-bottom: 2rem;">
        <h4 style="font-size: 1.05rem; color: #ffffff; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-ticket-simple" style="color: var(--brand-lime, #84cc16);"></i> + Buat Kode Voucher Promo Baru
        </h4>

        <form action="{{ route('admin.promos.store') }}" method="POST" style="display: grid; grid-template-columns: 1.5fr 2fr 1fr 1.2fr 1fr auto; gap: 1rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">KODE PROMO *</label>
                <input type="text" name="code" placeholder="e.g. FITJOGJA50" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; text-transform: uppercase; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">NAMA / DESKRIPSI PROMO *</label>
                <input type="text" name="title" placeholder="e.g. Promo Diskon Spesial Mahasiswa UGM" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">TIPE DISKON *</label>
                <select name="type" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                    <option value="fixed">Nominal Rp (Fixed)</option>
                    <option value="percentage">Persentase %</option>
                </select>
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">NOMINAL DISKON *</label>
                <input type="number" name="discount_amount" placeholder="e.g. 50000" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">KUOTA PAKAI *</label>
                <input type="number" name="max_uses" value="100" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
            </div>
            <div>
                <button type="submit" class="btn" style="background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.15rem; border: none; cursor: pointer; box-shadow: 0 0 15px rgba(132, 204, 22, 0.3);">
                    + Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Promos Table -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.1); color: #94a3b8;">
                        <th style="padding: 0.85rem 1rem;">KODE VOUCHER</th>
                        <th style="padding: 0.85rem 1rem;">JUDUL PROMO</th>
                        <th style="padding: 0.85rem 1rem;">NILAI DISKON</th>
                        <th style="padding: 0.85rem 1rem;">STATUS PENGGUNAAN</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promos as $promo)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                        <td style="padding: 0.85rem 1rem; font-weight: 900; font-family: monospace; color: #06b6d4; font-size: 1rem;">
                            🎟️ {{ $promo->code }}
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; color: #f8fafc;">
                            {{ $promo->title }}
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: var(--brand-lime, #84cc16);">
                            @if($promo->type === 'fixed')
                                Diskon Rp {{ number_format($promo->discount_amount, 0, ',', '.') }}
                            @else
                                Diskon {{ (int)$promo->discount_amount }}%
                            @endif
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: rgba(6, 182, 212, 0.15); color: #06b6d4; font-weight: 800; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px; border: 1px solid rgba(6, 182, 212, 0.3);">
                                Terpakai {{ $promo->used_count }} / {{ $promo->max_uses }} kali
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo voucher {{ $promo->code }}?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: rgba(244, 63, 94, 0.15); color: #f43f5e; border: 1px solid rgba(244, 63, 94, 0.3); padding: 0.35rem 0.65rem; border-radius: 0.4rem; font-weight: 800; font-size: 0.75rem; cursor: pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
