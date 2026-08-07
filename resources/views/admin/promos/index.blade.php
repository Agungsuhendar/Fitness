@extends('admin.layout')

@section('title', 'Kelola Kode Promo Voucher - Admin FitLife Center')
@section('header_title', 'Kelola Voucher & Kode Promo Diskon')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.35rem; color: #0f172a; margin: 0 0 0.2rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                🎟️ Kode Voucher &amp; Promo Diskon Membership
            </h3>
            <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                Buat voucher promo khusus untuk pendaftar &amp; member saat checkout via Midtrans.
            </p>
        </div>
    </div>

    <!-- Create Promo Voucher Form Box -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h4 style="font-size: 1.05rem; color: #03045e; margin-bottom: 1rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-ticket-simple" style="color: #0284c7;"></i> + Buat Kode Voucher Promo Baru
        </h4>

        <form action="{{ route('admin.promos.store') }}" method="POST" style="display: grid; grid-template-columns: 1.5fr 2fr 1fr 1.2fr 1fr auto; gap: 1rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">KODE PROMO *</label>
                <input type="text" name="code" placeholder="e.g. FITJOGJA50" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; text-transform: uppercase; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">NAMA / DESKRIPSI PROMO *</label>
                <input type="text" name="title" placeholder="e.g. Promo Diskon Spesial Mahasiswa UGM" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">TIPE DISKON *</label>
                <select name="type" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                    <option value="fixed">Nominal Rp (Fixed)</option>
                    <option value="percentage">Persentase %</option>
                </select>
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">NOMINAL DISKON *</label>
                <input type="number" name="discount_amount" placeholder="e.g. 50000" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">KUOTA PAKAI *</label>
                <input type="number" name="max_uses" value="100" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 800; outline: none;">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 900; padding: 0.65rem 1.15rem;">
                    + Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Promos Table -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569;">
                        <th style="padding: 0.85rem 1rem;">KODE VOUCHER</th>
                        <th style="padding: 0.85rem 1rem;">JUDUL PROMO</th>
                        <th style="padding: 0.85rem 1rem;">NILAI DISKON</th>
                        <th style="padding: 0.85rem 1rem;">STATUS PENGGUNAAN</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promos as $promo)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 0.85rem 1rem; font-weight: 900; font-family: monospace; color: #0284c7; font-size: 1rem;">
                            🎟️ {{ $promo->code }}
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; color: #0f172a;">
                            {{ $promo->title }}
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #16a34a;">
                            @if($promo->type === 'fixed')
                                Diskon Rp {{ number_format($promo->discount_amount, 0, ',', '.') }}
                            @else
                                Diskon {{ (int)$promo->discount_amount }}%
                            @endif
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: #e0f2fe; color: #0369a1; font-weight: 800; font-size: 0.775rem; padding: 0.25rem 0.75rem; border-radius: 99px;">
                                Terpakai {{ $promo->used_count }} / {{ $promo->max_uses }} kali
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <form action="{{ route('admin.promos.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo voucher {{ $promo->code }}?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background: #fee2e2; color: #ef4444; border: none; padding: 0.35rem 0.65rem; border-radius: 0.4rem; font-weight: 800; font-size: 0.75rem; cursor: pointer;">
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
