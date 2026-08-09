@extends('admin.layout')

@section('title', 'Kelola Stok, Barcode & Produk POS - Admin FitLife Center')
@section('header_title', 'Kelola Inventaris POS (Upload Foto, Barcode & Stok)')

@section('admin_content')
<div style="width: 100%;">

    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: rgba(34, 197, 94, 0.15); border: 1.5px solid #4ade80; color: #4ade80; border-radius: 1rem; font-weight: 800; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i> {{ session('success') }}
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div style="background: rgba(239, 68, 68, 0.15); border: 1.5px solid #ef4444; color: #fca5a5; padding: 1rem 1.25rem; border-radius: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="font-size: 1.5rem; color: #ffffff; margin: 0 0 0.25rem; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📦 Inventaris Produk POS Standar Kasir
            </h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                Kelola stok terkontrol via PO suplier, audit stock opname, &amp; barang jasa unlimited.
            </p>
        </div>

        <div style="display: flex; gap: 0.85rem; flex-wrap: wrap;">
            <button type="button" onclick="openAddProductModal()" class="btn" style="background: var(--brand-lime, #84cc16); color: #060907; border-radius: 99px; font-weight: 900; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.35); border: none; cursor: pointer;">
                <i class="fa-solid fa-plus-circle"></i> + Tambah Produk Baru
            </button>

            <a href="{{ route('admin.pos.index') }}" class="btn" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1.5px solid #38bdf8; border-radius: 99px; font-weight: 900; text-decoration: none; padding: 0.65rem 1.35rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-cart-shopping"></i> Buka Mesin Kasir POS Studio ➔
            </a>
        </div>
    </div>

    <!-- Inventory Stats Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem;">
        <div style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.3); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">TOTAL MODAL ASSET STOK</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($totalAssetValue ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">ESTIMASI OMSET OMSET JUAL</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($totalPotentialRevenue ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid #38bdf8; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: #38bdf8; font-weight: 800; text-transform: uppercase;">ESTIMASI UNTUNG BERSIH</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: #38bdf8; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                Rp {{ number_format($totalPotentialProfit ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: #0d1410; border: 1.5px solid {{ ($lowStockCount ?? 0) > 0 ? '#f87171' : 'rgba(255,255,255,0.1)' }}; border-radius: 1.25rem; padding: 1.25rem;">
            <span style="font-size: 0.75rem; color: {{ ($lowStockCount ?? 0) > 0 ? '#f87171' : '#94a3b8' }}; font-weight: 800; text-transform: uppercase;">STOK MENIPIS (&lt; 5 PCS)</span>
            <div style="font-size: 1.5rem; font-weight: 900; color: {{ ($lowStockCount ?? 0) > 0 ? '#f87171' : 'white' }}; font-family: 'Outfit', sans-serif; margin-top: 0.2rem;">
                {{ number_format($lowStockCount ?? 0) }} Produk
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;">
            <h4 style="font-size: 1.15rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                📋 Daftar Inventaris Produk &amp; Kontrol Stok
            </h4>
            <span style="font-size: 0.8rem; color: #94a3b8;">* Stok Barang Fisik Terkunci 🔒 Dari PO Supplier | Jasa Berstatus ♾️ Unlimited</span>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.775rem; text-transform: uppercase;">
                        <th style="padding: 1rem; width: 65px;">Foto</th>
                        <th style="padding: 1rem;">Kode SKU / Barcode</th>
                        <th style="padding: 1rem;">Nama Produk</th>
                        <th style="padding: 1rem;">Kategori</th>
                        <th style="padding: 1rem;">Harga Jual (Rp)</th>
                        <th style="padding: 1rem;">HPP Modal</th>
                        <th style="padding: 1rem;">Margin %</th>
                        <th style="padding: 1rem;">Status Stok</th>
                        <th style="padding: 1rem; text-align: right;">Aksi Management</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    @php
                        $margin = $p->profit_margin;
                        $isTracked = isset($p->is_track_stock) ? $p->is_track_stock : ($p->category !== 'Tiket Harian');
                    @endphp
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem;">
                            <div style="width: 48px; height: 48px; border-radius: 0.75rem; background: #1b2620; border: 1.5px solid rgba(255,255,255,0.15); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                @if($p->image)
                                    <img src="{{ $p->image }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=POS'">
                                @else
                                    <i class="fa-solid fa-image" style="color: #64748b; font-size: 1.1rem;"></i>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 900; font-family: monospace; color: #38bdf8; font-size: 0.85rem;">
                                {{ $p->code }}
                            </div>
                            <div style="font-size: 0.75rem; color: #94a3b8; font-family: monospace; display: flex; align-items: center; gap: 0.3rem;">
                                <i class="fa-solid fa-barcode" style="font-size: 0.8rem;"></i> {{ $p->barcode ?: $p->code }}
                            </div>
                        </td>
                        <td style="padding: 1rem;">
                            <div style="font-weight: 800; color: #ffffff;">{{ $p->name }}</div>
                            @if($p->description)
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.15rem;">{{ \Illuminate\Support\Str::limit($p->description, 40) }}</div>
                            @endif
                        </td>
                        <td style="padding: 1rem;">
                            <span style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; font-weight: 800; font-size: 0.75rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid rgba(56, 189, 248, 0.3);">
                                {{ $p->category }}
                            </span>
                        </td>
                        <form action="{{ route('admin.products.update', $p->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="code" value="{{ $p->code }}">
                            <input type="hidden" name="barcode" value="{{ $p->barcode }}">
                            <input type="hidden" name="name" value="{{ $p->name }}">
                            <input type="hidden" name="category" value="{{ $p->category }}">
                            <input type="hidden" name="cost_price" value="{{ (int)$p->cost_price }}">
                            <input type="hidden" name="unit" value="{{ $p->unit ?: 'Pcs' }}">
                            <input type="hidden" name="image" value="{{ $p->image }}">
                            <input type="hidden" name="description" value="{{ $p->description }}">
                            <input type="hidden" name="is_track_stock" value="{{ $isTracked ? '1' : '0' }}">
                            <input type="hidden" name="stock" value="{{ $p->stock }}">

                            <td style="padding: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.35rem;">
                                    <span style="color: #84cc16; font-weight: 900;">Rp</span>
                                    <input type="number" name="price" value="{{ (int)$p->price }}" class="form-control bg-dark text-white border-secondary fw-bold" style="width: 110px; color: #84cc16 !important; font-size: 0.85rem;" required>
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <div style="color: #94a3b8; font-weight: 700; font-size: 0.825rem;">
                                    Rp {{ number_format($p->cost_price ?: 0, 0, ',', '.') }}
                                </div>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="background: {{ $margin >= 30 ? 'rgba(34, 197, 94, 0.15)' : ($margin >= 10 ? 'rgba(234, 179, 8, 0.15)' : 'rgba(239, 68, 68, 0.15)') }}; color: {{ $margin >= 30 ? '#4ade80' : ($margin >= 10 ? '#eab308' : '#fca5a5') }}; font-weight: 900; font-size: 0.775rem; padding: 0.25rem 0.65rem; border-radius: 99px; border: 1px solid {{ $margin >= 30 ? '#4ade80' : ($margin >= 10 ? '#eab308' : '#fca5a5') }}; display: inline-block;">
                                    {{ $margin }}%
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                @if(!$isTracked)
                                    <span style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; font-weight: 900; font-size: 0.775rem; padding: 0.3rem 0.75rem; border-radius: 99px; border: 1px solid #38bdf8; display: inline-flex; align-items: center; gap: 0.3rem;">
                                        ♾️ Unlimited (Jasa)
                                    </span>
                                @else
                                    <div style="display: flex; align-items: center; gap: 0.35rem;">
                                        <input type="number" readonly value="{{ $p->stock }}" class="form-control bg-dark text-white border-secondary fw-bold" style="width: 75px; color: {{ $p->stock > 5 ? '#84cc16' : '#f87171' }} !important; background: #16221b !important; cursor: not-allowed; font-size: 0.85rem;" title="🔒 Stok Barang Fisik Terkunci (Diupdate via PO Supplier atau Stock Opname)">
                                        <span style="color: #94a3b8; font-size: 0.775rem;">{{ $p->unit ?: 'Pcs' }}</span>
                                    </div>
                                    @if($p->stock <= 5)
                                        <div style="font-size: 0.7rem; color: #f87171; font-weight: 800; margin-top: 0.2rem;">
                                            ⚠️ Menipis (&lt; 5 Pcs)
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td style="padding: 0.85rem 1rem; text-align: right; white-space: nowrap; width: 230px;">
                                <div style="display: inline-flex; gap: 0.3rem; justify-content: flex-end; align-items: center; white-space: nowrap;">
                                    <button type="submit" title="Simpan Perubahan Harga Jual" style="background: rgba(132, 204, 22, 0.2); color: #84cc16; border: 1px solid rgba(132, 204, 22, 0.5); padding: 0.35rem 0.65rem; border-radius: 8px; font-weight: 800; font-size: 0.75rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.25rem; white-space: nowrap;">
                                        <i class="fa-solid fa-check"></i> Simpan
                                    </button>

                                    @if($isTracked)
                                    <button type="button" onclick="openStockOpnameModal('{{ $p->id }}', '{{ addslashes($p->name) }}', '{{ $p->stock }}')" title="Audit Stock Opname Fisik" style="background: rgba(234, 179, 8, 0.15); color: #facc15; border: 1px solid rgba(234, 179, 8, 0.4); width: 32px; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-scale-balanced"></i>
                                    </button>

                                    <a href="{{ route('admin.purchase-orders.create') }}" title="Terbitkan PO Supplier Restock" style="background: rgba(56, 189, 248, 0.15); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.4); width: 32px; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-truck-ramp-box"></i>
                                    </a>
                                    @endif

                                    <button type="button" onclick="openEditProductModal('{{ $p->id }}', '{{ addslashes($p->code) }}', '{{ addslashes($p->barcode) }}', '{{ addslashes($p->name) }}', '{{ addslashes($p->category) }}', '{{ (int)$p->price }}', '{{ (int)$p->cost_price }}', '{{ $p->stock }}', '{{ addslashes($p->unit ?: 'Pcs') }}', '{{ addslashes($p->image) }}', '{{ addslashes($p->description) }}', '{{ $isTracked ? '1' : '0' }}')" title="Edit Lengkap Produk" style="background: rgba(255, 255, 255, 0.08); color: #e2e8f0; border: 1px solid rgba(255, 255, 255, 0.2); width: 32px; height: 32px; border-radius: 8px; font-weight: 800; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Stock Opname Audit -->
<div class="modal fade" id="stockOpnameModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(234, 179, 8, 0.5); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-scale-balanced" style="color: #facc15;"></i> Stock Opname Physical Audit
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeStockOpnameModal()"></button>
            </div>
            <form id="stockOpnameForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div style="background: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.3); padding: 0.85rem; border-radius: 0.85rem; margin-bottom: 1.25rem; font-size: 0.825rem; color: #facc15;">
                        ⚖️ <strong>Audit Stok Opname:</strong> Gunakan fitur ini jika terdapat selisih fisik toko (e.g. barang pecah/kadaluarsa atau hasil hitung opname bulanan).
                    </div>

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NAMA PRODUK AUDIT</label>
                        <input type="text" id="opnameProductName" readonly class="form-control bg-dark text-white border-secondary fw-bold" style="background: #18221b !important; color: #38bdf8 !important;">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">STOK SAAT INI (SISTEM)</label>
                            <input type="text" id="opnameCurrentStock" readonly class="form-control bg-dark text-white border-secondary fw-bold" style="background: #18221b !important;">
                        </div>
                        <div class="col-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">STOK FISIK BARU (AUDIT) *</label>
                            <input type="number" name="new_stock" id="opnameNewStock" required min="0" class="form-control bg-dark text-white border-secondary fw-bold" style="color: #84cc16 !important;">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #f87171; text-transform: uppercase;">ALASAN PENYESUAIAN OPNAME *</label>
                        <input type="text" name="reason" placeholder="e.g. 2 botol pecah di rak / Hasil opname fisik akhir bulan" required class="form-control bg-dark text-white border-secondary">
                    </div>
                </div>

                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" onclick="closeStockOpnameModal()" style="border-radius: 0.65rem; font-weight: 700;">Batal</button>
                    <button type="submit" class="btn btn-warning" style="border-radius: 0.65rem; font-weight: 900; padding: 0.5rem 1.25rem; background: #facc15; color: #000; border: none;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Audit Stock Opname
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk (Standard POS with Auto SKU & Stock Type) -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-box-open" style="color: var(--brand-lime, #84cc16);"></i> Tambah Produk / Barang POS Standar Kasir
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeAddProductModal()"></button>
            </div>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">KODE SKU PRODUK (OTOMATIS)</label>
                            <input type="text" name="code" id="addSkuField" readonly placeholder="Terisi Otomatis (e.g. PRD-0010)" class="form-control bg-dark text-white border-secondary fw-bold" style="background: #18221b !important; color: #84cc16 !important; cursor: not-allowed;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #38bdf8; text-transform: uppercase;">NOMOR BARCODE (EAN/UPC)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-secondary border-secondary"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" name="barcode" id="addBarcodeField" placeholder="e.g. 8991234567890" class="form-control bg-dark text-white border-secondary fw-bold">
                                <button type="button" class="btn btn-outline-info" onclick="generateRandomBarcode('addBarcodeField')" title="Generate Barcode Acak">Gen</button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NAMA PRODUK / BARANG *</label>
                            <input type="text" name="name" placeholder="e.g. Air Mineral Cleo 600ml" required class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">KATEGORI PRODUK *</label>
                            <select name="category" class="form-select bg-dark text-white border-secondary fw-bold" required>
                                <option value="Suplemen & Minuman">🥤 Suplemen &amp; Minuman</option>
                                <option value="Tiket Harian">🎟️ Tiket Harian (Jasa)</option>
                                <option value="Perlengkapan & Sewa">🧘 Perlengkapan &amp; Sewa</option>
                                <option value="Merchandise">👕 Merchandise</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">TIPE PENGELOLAAN STOK *</label>
                            <select name="is_track_stock" class="form-select bg-dark text-white border-secondary fw-bold" required>
                                <option value="1" selected>🥤 Barang Fisik (Lacak Stok via PO &amp; Stock Opname)</option>
                                <option value="0">🎟️ Layanan / Jasa / Tiket (Stok Unlimited ♾️)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">SATUAN STOK</label>
                            <input type="text" name="unit" placeholder="Pcs" value="Pcs" class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #facc15; text-transform: uppercase;">HPP MODAL (RP)</label>
                            <input type="number" name="cost_price" placeholder="e.g. 3000" class="form-control bg-dark text-white border-secondary fw-bold" style="color: #facc15 !important;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); text-transform: uppercase;">HARGA JUAL (RP) *</label>
                            <input type="number" name="price" placeholder="e.g. 5000" required class="form-control bg-dark text-white border-secondary fw-bold" style="color: var(--brand-lime, #84cc16) !important;">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">📁 UNGGAH FILE FOTO PRODUK (ATTACH FILE)</label>
                            <input type="file" name="image_file" accept="image/*" class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">🔗 ATAU PASTE LINK URL GAMBAR</label>
                            <input type="url" name="image" placeholder="https://images.unsplash.com/... (Opsional)" class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">DESKRIPSI / CATATAN BARANG</label>
                        <textarea name="description" rows="2" placeholder="Catatan rasa, ukuran, atau ketentuan sewa..." class="form-control bg-dark text-white border-secondary"></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" onclick="closeAddProductModal()" style="border-radius: 0.65rem; font-weight: 700;">Batal</button>
                    <button type="submit" class="btn btn-lime" style="border-radius: 0.65rem; font-weight: 900; padding: 0.5rem 1.25rem;">
                        <i class="fa-solid fa-plus-circle"></i> Simpan Produk POS Standar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk (Standard POS with Readonly SKU & Stock Type) -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(56, 189, 248, 0.4); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #ffffff; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-pen-to-square" style="color: #38bdf8;"></i> Edit Data Produk POS (Lengkap)
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeEditProductModal()"></button>
            </div>
            <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="stock" id="modalEditStock">
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #38bdf8; text-transform: uppercase;">KODE SKU PRODUK (LOCKED)</label>
                            <input type="text" name="code" id="modalEditCode" readonly class="form-control bg-dark text-white border-secondary fw-bold" style="background: #162026 !important; color: #38bdf8 !important; cursor: not-allowed;" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #38bdf8; text-transform: uppercase;">NOMOR BARCODE (EAN/UPC)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-secondary border-secondary"><i class="fa-solid fa-barcode"></i></span>
                                <input type="text" name="barcode" id="modalEditBarcode" placeholder="e.g. 8991234567890" class="form-control bg-dark text-white border-secondary fw-bold">
                                <button type="button" class="btn btn-outline-info" onclick="generateRandomBarcode('modalEditBarcode')" title="Generate Barcode Acak">Gen</button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">NAMA PRODUK *</label>
                            <input type="text" name="name" id="modalEditName" class="form-control bg-dark text-white border-secondary fw-bold" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">KATEGORI PRODUK *</label>
                            <select name="category" id="modalEditCategory" class="form-select bg-dark text-white border-secondary fw-bold" required>
                                <option value="Suplemen & Minuman">🥤 Suplemen &amp; Minuman</option>
                                <option value="Tiket Harian">🎟️ Tiket Harian (Jasa)</option>
                                <option value="Perlengkapan & Sewa">🧘 Perlengkapan &amp; Sewa</option>
                                <option value="Merchandise">👕 Merchandise</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">TIPE PENGELOLAAN STOK *</label>
                            <select name="is_track_stock" id="modalEditIsTrackStock" class="form-select bg-dark text-white border-secondary fw-bold" required>
                                <option value="1">🥤 Barang Fisik (Lacak Stok via PO &amp; Stock Opname)</option>
                                <option value="0">🎟️ Layanan / Jasa / Tiket (Stok Unlimited ♾️)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">SATUAN STOK</label>
                            <input type="text" name="unit" id="modalEditUnit" placeholder="Pcs" class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #facc15; text-transform: uppercase;">HPP MODAL (LOCKED 🔒)</label>
                            <input type="text" id="modalEditCostPriceText" readonly class="form-control bg-dark text-white border-secondary fw-bold" style="background: #18221b !important; color: #facc15 !important; cursor: not-allowed;" title="🔒 HPP Modal Terhitung Otomatis via Moving Average PO Supplier">
                            <input type="hidden" name="cost_price" id="modalEditCostPrice">
                            <span style="font-size: 0.7rem; color: #64748b;">🔒 Terhitung Otomatis via PO Supplier</span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: var(--brand-lime, #84cc16); text-transform: uppercase;">HARGA JUAL (RP) *</label>
                            <input type="number" name="price" id="modalEditPrice" class="form-control bg-dark text-white border-secondary fw-bold" required style="color: var(--brand-lime, #84cc16) !important;">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase;">📁 UNGGAH FILE FOTO BARU (ATTACH FILE)</label>
                            <input type="file" name="image_file" accept="image/*" class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">🔗 ATAU UPDATE LINK URL GAMBAR</label>
                            <input type="url" name="image" id="modalEditImage" placeholder="https://images.unsplash.com/photo-..." class="form-control bg-dark text-white border-secondary fw-bold">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label" style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; text-transform: uppercase;">DESKRIPSI / CATATAN BARANG</label>
                        <textarea name="description" id="modalEditDescription" rows="2" class="form-control bg-dark text-white border-secondary"></textarea>
                    </div>
                </div>

                <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" class="btn btn-secondary" onclick="closeEditProductModal()" style="border-radius: 0.65rem; font-weight: 700;">Batal</button>
                    <button type="submit" class="btn btn-lime" style="border-radius: 0.65rem; font-weight: 900; padding: 0.5rem 1.25rem;">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function generateRandomBarcode(targetInputId) {
    const random13Digit = '899' + Math.floor(100000000 + Math.random() * 900000000);
    document.getElementById(targetInputId).value = random13Digit;
}

function openStockOpnameModal(id, name, currentStock) {
    const form = document.getElementById('stockOpnameForm');
    if (form) {
        form.action = '/admin/products/' + id + '/opname';
    }
    document.getElementById('opnameProductName').value = name;
    document.getElementById('opnameCurrentStock').value = currentStock + ' Pcs';
    document.getElementById('opnameNewStock').value = currentStock;

    const modalEl = document.getElementById('stockOpnameModal');
    if (modalEl) {
        modalEl.classList.add('show');
        modalEl.style.display = 'block';
    }
}

function closeStockOpnameModal() {
    const modalEl = document.getElementById('stockOpnameModal');
    if (modalEl) {
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
    }
}

function openAddProductModal() {
    const autoSku = 'PRD-' + Math.floor(1000 + Math.random() * 9000);
    document.getElementById('addSkuField').value = autoSku;
    
    const modalEl = document.getElementById('addProductModal');
    if (modalEl) {
        modalEl.classList.add('show');
        modalEl.style.display = 'block';
    }
}

function closeAddProductModal() {
    const modalEl = document.getElementById('addProductModal');
    if (modalEl) {
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
    }
}

function openEditProductModal(id, code, barcode, name, category, price, costPrice, stock, unit, image, description, isTrackStock) {
    const form = document.getElementById('editProductForm');
    if (form) {
        form.action = '/admin/products/' + id;
    }
    document.getElementById('modalEditCode').value = code;
    document.getElementById('modalEditBarcode').value = barcode || code;
    document.getElementById('modalEditName').value = name;
    document.getElementById('modalEditCategory').value = category;
    document.getElementById('modalEditPrice').value = price;
    document.getElementById('modalEditCostPrice').value = costPrice || 0;
    if (document.getElementById('modalEditCostPriceText')) {
        document.getElementById('modalEditCostPriceText').value = 'Rp ' + parseInt(costPrice || 0).toLocaleString('id-ID');
    }
    if (document.getElementById('modalEditStock')) {
        document.getElementById('modalEditStock').value = stock || 0;
    }
    document.getElementById('modalEditUnit').value = unit || 'Pcs';
    document.getElementById('modalEditImage').value = image || '';
    document.getElementById('modalEditDescription').value = description || '';
    document.getElementById('modalEditIsTrackStock').value = isTrackStock !== undefined ? isTrackStock : '1';

    const modalEl = document.getElementById('editProductModal');
    if (modalEl) {
        modalEl.classList.add('show');
        modalEl.style.display = 'block';
    }
}

function closeEditProductModal() {
    const modalEl = document.getElementById('editProductModal');
    if (modalEl) {
        modalEl.classList.remove('show');
        modalEl.style.display = 'none';
    }
}
</script>
@endsection
