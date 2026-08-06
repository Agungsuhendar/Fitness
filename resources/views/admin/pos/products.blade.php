@extends('admin.layout')

@section('title', 'Kelola Stok & Harga Produk POS - Admin FitLife Center')
@section('header_title', 'Kelola Stok & Harga Produk POS Kasir')

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
                Inventaris Produk POS Kasir Studio
            </h3>
            <p style="color: #64748b; font-size: 0.875rem; margin: 0;">
                Kelola stok air mineral, whey protein shake, tiket masuk harian, &amp; aksesoris gym.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem;">
            <a href="{{ route('admin.pos.index') }}" class="btn" style="background: #0284c7; color: white; border-radius: 0.85rem; font-weight: 800; text-decoration: none; padding: 0.65rem 1.25rem;">
                <i class="fa-solid fa-cart-shopping"></i> Buka Mesin Kasir POS ➔
            </a>
        </div>
    </div>

    <!-- Add Product Form Box -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
        <h4 style="font-size: 1.05rem; color: #03045e; margin-bottom: 1rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-square-plus" style="color: #0284c7;"></i> Tambah Produk / Tiket Baru
        </h4>

        <form action="{{ route('admin.products.store') }}" method="POST" style="display: grid; grid-template-columns: 1fr 2fr 1.5fr 1fr 1fr auto; gap: 1rem; align-items: end;">
            @csrf
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">KODE *</label>
                <input type="text" name="code" placeholder="e.g. SUP-05" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">NAMA PRODUK *</label>
                <input type="text" name="name" placeholder="e.g. Air Mineral Cleo 600ml" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">KATEGORI *</label>
                <select name="category" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                    <option value="Suplemen & Minuman">Suplemen &amp; Minuman</option>
                    <option value="Tiket Harian">Tiket Harian</option>
                    <option value="Perlengkapan & Sewa">Perlengkapan &amp; Sewa</option>
                    <option value="Merchandise">Merchandise</option>
                </select>
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">HARGA (RP) *</label>
                <input type="number" name="price" placeholder="e.g. 15000" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <label style="font-size: 0.775rem; font-weight: 800; color: #334155; display: block; margin-bottom: 0.35rem;">STOK *</label>
                <input type="number" name="stock" placeholder="100" required style="width: 100%; border: 1px solid #cbd5e1; border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="border-radius: 0.65rem; font-weight: 800; padding: 0.65rem 1.15rem;">
                    + Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: #ffffff; border: 1px solid #e2e8f0;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569;">
                        <th style="padding: 0.85rem 1rem;">KODE</th>
                        <th style="padding: 0.85rem 1rem;">NAMA PRODUK</th>
                        <th style="padding: 0.85rem 1rem;">KATEGORI</th>
                        <th style="padding: 0.85rem 1rem;">HARGA JUAL</th>
                        <th style="padding: 0.85rem 1rem;">SISA STOK</th>
                        <th style="padding: 0.85rem 1rem; text-align: center;">AKSI EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 0.85rem 1rem; font-weight: 800; font-family: monospace; color: #0284c7;">
                            {{ $p->code }}
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 800; color: #0f172a;">
                            {{ $p->name }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="background: #e0f2fe; color: #0369a1; font-weight: 800; font-size: 0.75rem; padding: 0.2rem 0.6rem; border-radius: 99px;">
                                {{ $p->category }}
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; font-weight: 900; color: #16a34a;">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </td>
                        <td style="padding: 0.85rem 1rem;">
                            <span style="font-weight: 900; color: {{ $p->stock > 10 ? '#0f172a' : '#dc2626' }};">
                                {{ $p->stock }} Pcs
                            </span>
                        </td>
                        <td style="padding: 0.85rem 1rem; text-align: center;">
                            <form action="{{ route('admin.products.update', $p->id) }}" method="POST" style="display: inline-flex; gap: 0.5rem; align-items: center;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $p->name }}">
                                <input type="hidden" name="category" value="{{ $p->category }}">
                                <input type="number" name="price" value="{{ (int)$p->price }}" style="width: 90px; border: 1px solid #cbd5e1; border-radius: 0.4rem; padding: 0.25rem 0.4rem; font-size: 0.8rem; font-weight: 700;">
                                <input type="number" name="stock" value="{{ $p->stock }}" style="width: 70px; border: 1px solid #cbd5e1; border-radius: 0.4rem; padding: 0.25rem 0.4rem; font-size: 0.8rem; font-weight: 700;">
                                <button type="submit" class="btn" style="background: #e2e8f0; color: #0f172a; border: none; padding: 0.3rem 0.65rem; border-radius: 0.4rem; font-weight: 800; font-size: 0.75rem; cursor: pointer;">
                                    Update
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
