@extends('admin.layout')

@section('title', 'POS Kasir Studio & Toko Suplemen | Admin FitLife Center')
@section('header_title', 'POS Kasir Studio & Toko Suplemen')

@section('admin_content')
<div style="width: 100%;">
    <div class="container-fluid" style="padding: 0 1rem;">
        
        <!-- Top Bar Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); padding: 1rem 1.35rem; border-radius: 1.25rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <h1 style="font-size: 1.6rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-cash-register" style="color: #84cc16;"></i> FITLIFE POS KASIR
                    </h1>
                    <span style="background: rgba(132, 204, 22, 0.15); color: #84cc16; border: 1px solid #84cc16; font-size: 0.725rem; font-weight: 900; padding: 0.2rem 0.65rem; border-radius: 99px;">
                        🟢 KASIR ONLINE
                    </span>
                </div>
                <p style="color: #94a3b8; font-size: 0.8rem; margin: 0.2rem 0 0;">
                    Kasir Penjualan Air Mineral, Suplemen Shake, Tiket Drop-In Harian &amp; Sewa Alat Gym.
                </p>
            </div>

            <div style="display: flex; gap: 0.65rem; align-items: center; flex-wrap: wrap;">
                <!-- Shortcut Hints -->
                <div style="display: flex; gap: 0.35rem; font-size: 0.725rem; color: #94a3b8; font-family: monospace;">
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F2 / /: Cari</span>
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F4: Member</span>
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F8: Bayar</span>
                </div>

                <button type="button" onclick="openRecentTransactionsModal()" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                    <i class="fa-solid fa-clock-rotate-left" style="color: #38bdf8;"></i> Riwayat Transaksi
                </button>

                <a href="{{ route('admin.pos.products') }}" style="background: rgba(56,189,248,0.15); border: 1px solid #38bdf8; color: #38bdf8; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="fa-solid fa-boxes-stacked"></i> Kelola Stok
                </a>

                <button type="button" onclick="togglePosFullscreen()" id="fullscreenPosBtn" style="background: rgba(132, 204, 22, 0.2); border: 1px solid #84cc16; color: #84cc16; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                    <i class="fa-solid fa-expand" id="posFsIcon"></i> <span id="posFsText">Fullscreen</span>
                </button>
            </div>
        </div>

        <!-- Main Dual-Column POS Layout -->
        <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 1.5rem; align-items: start;" class="grid-2">
            
            <!-- Left Side: Product Catalog Grid -->
            <div>
                <!-- Category Filter & Search Bar Card -->
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.15rem; margin-bottom: 1.25rem;">
                    <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.85rem; flex-wrap: wrap;">
                        <button type="button" onclick="filterPosCategory('all', this)" class="btn pos-cat-btn active-cat" data-cat="all" style="background: #84cc16; color: #090d0b; border: 1px solid rgba(255,255,255,0.12); padding: 0.45rem 1rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; cursor: pointer;">
                            Semua Produk
                        </button>
                        @foreach($categories as $cat)
                            <button type="button" onclick="filterPosCategory('{{ $cat }}', this)" class="btn pos-cat-btn" data-cat="{{ $cat }}" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.12); padding: 0.45rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; cursor: pointer;">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Instant Search Bar with Barcode Scanner Icon -->
                    <div style="position: relative;">
                        <input type="text" id="posSearchInput" oninput="filterPosSearch(this.value)" placeholder="🔍 Ketik kode SKU / nama produk / scan barcode (Tekan /)..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 0.75rem; padding: 0.7rem 1rem 0.7rem 2.5rem; color: white; outline: none; font-size: 0.875rem; font-weight: 700;">
                        <i class="fa-solid fa-barcode" style="position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: #84cc16; font-size: 1rem;"></i>
                    </div>
                </div>

                <!-- Product Grid Catalog Cards -->
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 1.15rem;">
                    @forelse($products as $p)
                    @php
                        $isTracked = isset($p->is_track_stock) ? $p->is_track_stock : ($p->category !== 'Tiket Harian');
                    @endphp
                    <div onclick="addToCart({{ json_encode($p) }})" 
                         data-category="{{ $p->category }}" 
                         data-search="{{ strtolower($p->code . ' ' . ($p->barcode ?? '') . ' ' . $p->name . ' ' . $p->category) }}"
                         style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.15rem; padding: 0.85rem; cursor: pointer; transition: all 0.2s; position: relative; overflow: hidden;" class="pos-item-card">
                        
                        <!-- Thumbnail Image -->
                        <div style="width: 100%; height: 105px; border-radius: 0.75rem; background: #16221a; border: 1px solid rgba(255,255,255,0.1); overflow: hidden; margin-bottom: 0.65rem; display: flex; align-items: center; justify-content: center; position: relative;">
                            @if($p->image)
                                <img src="{{ $p->image }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1546483875-ad9014c88eba?w=400';">
                            @else
                                <div style="text-align: center; color: #64748b;">
                                    <i class="fa-solid fa-box-open" style="font-size: 1.8rem; color: #84cc16; opacity: 0.5; display: block; margin-bottom: 0.2rem;"></i>
                                </div>
                            @endif
                            <span style="position: absolute; top: 0.4rem; left: 0.4rem; background: rgba(0,0,0,0.8); color: #84cc16; font-size: 0.65rem; font-weight: 900; padding: 0.15rem 0.45rem; border-radius: 5px; font-family: monospace; backdrop-filter: blur(4px); border: 1px solid rgba(132, 204, 22, 0.4);">
                                {{ $p->code }}
                            </span>
                        </div>

                        <h4 style="font-size: 0.9rem; font-weight: 900; color: white; margin: 0 0 0.35rem; font-family: 'Outfit', sans-serif; line-height: 1.25; height: 2.4rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            {{ $p->name }}
                        </h4>

                        <div style="font-size: 0.725rem; color: #94a3b8; margin-bottom: 0.65rem;">
                            @if(!$isTracked)
                                Status: <strong style="color: #38bdf8;">♾️ Unlimited (Jasa)</strong>
                            @else
                                Stok: <strong style="color: {{ $p->stock > 5 ? '#84cc16' : '#ef4444' }};">{{ $p->stock }} {{ $p->unit ?: 'Pcs' }}</strong>
                            @endif
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="font-size: 1.05rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </div>
                            <div style="width: 30px; height: 30px; background: rgba(132,204,22,0.15); border: 1px solid rgba(132,204,22,0.4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 0.75rem;">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: #94a3b8; background: #0d1310; border-radius: 1.25rem;">
                        Tidak ada produk yang tersedia.
                    </div>
                    @endforelse

                    <div id="posEmptyProducts" style="display: none; grid-column: 1 / -1; padding: 3rem; text-align: center; color: #94a3b8; background: #0d1310; border-radius: 1.25rem;">
                        Tidak ada produk yang cocok dengan pencarian atau kategori ini.
                    </div>
                </div>
            </div>

            <!-- Right Side: POS Register Active Order Panel -->
            <div style="background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 25px 50px rgba(0,0,0,0.8); position: sticky; top: 1rem;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px dashed rgba(255,255,255,0.15); padding-bottom: 0.85rem; margin-bottom: 1rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-receipt" style="color: #84cc16;"></i> Keranjang Kasir POS
                    </h3>
                    <button type="button" onclick="clearCart()" style="background: none; border: none; color: #ef4444; font-size: 0.775rem; font-weight: 800; cursor: pointer;">
                        <i class="fa-solid fa-trash-can"></i> Kosongkan
                    </button>
                </div>

                <!-- Customer / Member Selector with Auto-Suggest -->
                <div style="margin-bottom: 1rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem; position: relative;">
                    <div style="position: relative;">
                        <label style="font-size: 0.725rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.25rem;">
                            👤 NAMA PELANGGAN / MEMBER (F4)
                        </label>
                        <input type="text" id="posMemberName" oninput="searchMemberPos(this.value)" placeholder="Ketik Member / Umum..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid #84cc16; border-radius: 0.6rem; padding: 0.5rem 0.65rem; color: white; outline: none; font-size: 0.825rem; font-weight: 800;">
                        
                        <!-- Member Dropdown -->
                        <div id="memberSearchDropdown" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 100; background: #0d1310; border: 1.5px solid #84cc16; border-radius: 0.75rem; max-height: 180px; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.9); margin-top: 0.25rem;">
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 0.725rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.25rem;">NO. WHATSAPP MEMBER</label>
                        <input type="text" id="posMemberPhone" placeholder="081234567890" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 0.6rem; padding: 0.5rem 0.65rem; color: white; outline: none; font-size: 0.825rem;">
                    </div>
                </div>

                <!-- Cart Items Table List -->
                <div style="max-height: 240px; overflow-y: auto; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.08); border-radius: 0.75rem; padding: 0.35rem;" id="cartListWrapper">
                    <div id="cartEmptyState" style="padding: 2.25rem 1rem; text-align: center; color: #94a3b8; font-size: 0.825rem;">
                        <i class="fa-solid fa-cart-shopping" style="font-size: 1.75rem; color: #64748b; margin-bottom: 0.5rem; display: block;"></i>
                        Belum ada item di keranjang. Klik produk di sebelah kiri untuk memilih.
                    </div>
                    <table style="width: 100%; border-collapse: collapse; display: none;" id="cartTable">
                        <tbody id="cartTbody"></tbody>
                    </table>
                </div>

                <!-- Payment Calculations -->
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 0.85rem; padding: 1rem; margin-bottom: 1rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.825rem; color: #cbd5e1;">
                        <span>Subtotal Produk:</span>
                        <strong id="cartSubtotalText">Rp 0</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.825rem; color: #cbd5e1;">
                        <span>Diskon Nota (Rp):</span>
                        <input type="number" id="cartDiscountInput" value="0" min="0" oninput="renderCartSummary()" style="width: 110px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 0.4rem; padding: 0.3rem 0.5rem; color: #ef4444; font-weight: 800; text-align: right; outline: none; font-size: 0.825rem;">
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: 900; color: #84cc16; border-top: 1px dashed rgba(255,255,255,0.15); padding-top: 0.5rem; margin-top: 0.25rem; font-family: 'Outfit', sans-serif;">
                        <span>TOTAL BAYAR:</span>
                        <span id="cartTotalText">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Method & Pay Input -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                        <div>
                            <label style="font-size: 0.725rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.25rem;">METODE BAYAR</label>
                            <select id="posPaymentMethod" onchange="togglePaymentNumpad(this.value)" style="width: 100%; background: #060907; border: 1.5px solid rgba(255,255,255,0.2); border-radius: 0.6rem; padding: 0.55rem; color: white; font-weight: 800; outline: none; font-size: 0.825rem;">
                                <option value="Tunai (Cash)">💵 Tunai / Cash Kasir</option>
                                <option value="QRIS iPaymu">📱 QRIS Instan (GoPay/ShopeePay/iPaymu)</option>
                                <option value="Transfer BCA">💳 Transfer Bank BCA</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.725rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.25rem;">UANG DITERIMA (RP)</label>
                            <input type="number" id="posPayAmount" placeholder="e.g. 50000" oninput="renderCartSummary()" style="width: 100%; background: #060907; border: 1.5px solid #84cc16; border-radius: 0.6rem; padding: 0.55rem; color: #84cc16; font-weight: 900; outline: none; font-size: 0.875rem;">
                        </div>
                    </div>

                    <!-- Fast-Cash Quick Nominal Buttons -->
                    <div id="quickMoneyPills" style="display: flex; gap: 0.3rem; flex-wrap: wrap;">
                        <button type="button" onclick="setQuickCash('exact')" style="background: rgba(132,204,22,0.2); border: 1px solid #84cc16; color: #84cc16; padding: 0.25rem 0.55rem; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 900; cursor: pointer;">⚡ Uang Pas</button>
                        <button type="button" onclick="setQuickCash(10000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.25rem 0.55rem; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 800; cursor: pointer;">10rb</button>
                        <button type="button" onclick="setQuickCash(20000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.25rem 0.55rem; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 800; cursor: pointer;">20rb</button>
                        <button type="button" onclick="setQuickCash(50000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.25rem 0.55rem; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 800; cursor: pointer;">50rb</button>
                        <button type="button" onclick="setQuickCash(100000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.25rem 0.55rem; border-radius: 0.4rem; font-size: 0.7rem; font-weight: 800; cursor: pointer;">100rb</button>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: #38bdf8; font-weight: 900; padding: 0 0.2rem;">
                        <span>KEMBALIAN:</span>
                        <span id="cartChangeText" style="color: #84cc16;">Rp 0</span>
                    </div>

                    <button type="button" onclick="processPosCheckout()" id="checkoutBtn" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #090d0b !important; border: none; padding: 0.85rem; border-radius: 0.85rem; font-weight: 900; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.4);">
                        <i class="fa-solid fa-print" style="color: #090d0b !important;"></i>
                        <span style="color: #090d0b !important;">PROSES BAYAR &amp; STRUK (F8)</span>
                    </button>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Modal In-App Struk Thermal Print Success (#posSuccessReceiptModal) -->
<div class="modal fade" id="posSuccessReceiptModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85); backdrop-filter: blur(12px);">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 540px; height: 92vh; margin: 4vh auto;">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid #84cc16; border-radius: 1.5rem; color: white; box-shadow: 0 25px 60px rgba(0,0,0,0.85); height: 100%; display: flex; flex-direction: column; overflow: hidden;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1); background: linear-gradient(135deg, rgba(132, 204, 22, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%); padding: 0.85rem 1.25rem; flex-shrink: 0;">
                <h5 class="modal-title" style="font-size: 1.05rem; font-weight: 900; color: #84cc16; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;" id="modalHeaderTitleText">
                    <i class="fa-solid fa-circle-check"></i> TRANSAKSI KASIR BERHASIL!
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeReceiptModal()" title="Tutup Nota (Esc / F2)"></button>
            </div>
            <div class="modal-body" style="padding: 0.85rem; flex: 1; display: flex; flex-direction: column; gap: 0.75rem; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.04); padding: 0.6rem 0.9rem; border-radius: 0.85rem; border: 1px solid rgba(255,255,255,0.08); flex-shrink: 0;">
                    <div style="font-size: 0.825rem; font-weight: 800; color: #94a3b8;" id="modalInvoiceNo">
                        Invoice: POS-FL-20260809-0012
                    </div>
                    <div style="font-size: 1.1rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;" id="modalChangeAmountText">
                        Kembalian: Rp 0
                    </div>
                </div>

                <!-- Full-Height Sleek Thermal Receipt Preview Container (Zero Buttons) -->
                <div style="flex: 1; width: 100%; background: #ffffff; border-radius: 1rem; overflow: hidden; border: 1.5px solid rgba(255,255,255,0.2); box-shadow: inset 0 0 15px rgba(0,0,0,0.1);">
                    <iframe id="receiptIframe" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Recent Transactions Audit (#recentTransactionsModal) -->
<div class="modal fade" id="recentTransactionsModal" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.85);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: #0d1410; border: 1.5px solid rgba(56, 189, 248, 0.4); border-radius: 1.25rem; color: white;">
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <h5 class="modal-title" style="font-size: 1.15rem; font-weight: 900; color: #38bdf8; margin: 0; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat 10 Transaksi POS Terakhir
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeRecentTransactionsModal()"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: #94a3b8; font-size: 0.75rem; text-transform: uppercase;">
                            <th style="padding: 0.65rem;">No Invoice</th>
                            <th style="padding: 0.65rem;">Waktu</th>
                            <th style="padding: 0.65rem;">Pelanggan</th>
                            <th style="padding: 0.65rem;">Total</th>
                            <th style="padding: 0.65rem;">Metode</th>
                            <th style="padding: 0.65rem; text-align: right;">Struk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTransactions as $tx)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 0.65rem; font-family: monospace; font-weight: 900; color: #38bdf8;">{{ $tx->invoice_number }}</td>
                            <td style="padding: 0.65rem; color: #94a3b8; font-size: 0.75rem;">{{ $tx->transacted_at ? $tx->transacted_at->format('d/m H:i') : $tx->created_at->format('d/m H:i') }}</td>
                            <td style="padding: 0.65rem; font-weight: 800; color: white;">{{ $tx->member_name }}</td>
                            <td style="padding: 0.65rem; font-weight: 900; color: #84cc16;">Rp {{ number_format($tx->total, 0, ',', '.') }}</td>
                            <td style="padding: 0.65rem; color: #cbd5e1;">{{ $tx->payment_method }}</td>
                            <td style="padding: 0.65rem; text-align: right;">
                                <a href="{{ route('admin.pos.receipt', $tx->id) }}" target="_blank" class="btn btn-sm btn-outline-info" style="font-size: 0.725rem; font-weight: 800;">
                                    🖨️ Struk
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <button type="button" class="btn btn-secondary" onclick="closeRecentTransactionsModal()" style="border-radius: 0.65rem; font-weight: 700;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];
    let currentReceiptUrl = '';

    function addToCart(product) {
        const isTracked = product.is_track_stock !== undefined ? product.is_track_stock : (product.category !== 'Tiket Harian');
        const existing = cart.find(i => i.product_id === product.id);

        if (existing) {
            if (isTracked && (existing.qty + 1 > product.stock)) {
                alert('Stok fisik produk "' + product.name + '" tersisa ' + product.stock + ' ' + (product.unit || 'Pcs') + '!');
                return;
            }
            existing.qty += 1;
            existing.subtotal = existing.qty * existing.price;
        } else {
            if (isTracked && product.stock < 1) {
                alert('Stok fisik produk "' + product.name + '" sedang habis! Silakan lakukan PO Suplier.');
                return;
            }
            cart.push({
                product_id: product.id,
                product_name: product.name,
                price: parseFloat(product.price),
                qty: 1,
                subtotal: parseFloat(product.price),
                is_track_stock: isTracked,
                stock: product.stock
            });
        }
        renderCartSummary();
        speakAnnouncement('Item ' + product.name + ' masuk.');
    }

    function updateCartQty(index, delta) {
        const item = cart[index];
        if (delta > 0 && item.is_track_stock && (item.qty + delta > item.stock)) {
            alert('Stok fisik produk "' + item.product_name + '" tersisa ' + item.stock + ' Pcs!');
            return;
        }
        item.qty += delta;
        if (item.qty <= 0) {
            cart.splice(index, 1);
        } else {
            item.subtotal = item.qty * item.price;
        }
        renderCartSummary();
    }

    function clearCart() {
        cart = [];
        renderCartSummary();
    }

    function renderCartSummary() {
        const tbody = document.getElementById('cartTbody');
        const emptyState = document.getElementById('cartEmptyState');
        const cartTable = document.getElementById('cartTable');

        if (cart.length === 0) {
            emptyState.style.display = 'block';
            cartTable.style.display = 'none';
        } else {
            emptyState.style.display = 'none';
            cartTable.style.display = 'table';
            
            let html = '';
            cart.forEach((item, idx) => {
                html += `<tr style="border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <td style="padding: 0.55rem 0.2rem;">
                        <div style="font-weight: 800; color: white; font-size: 0.825rem;">${item.product_name}</div>
                        <div style="font-size: 0.7rem; color: #84cc16;">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</div>
                    </td>
                    <td style="padding: 0.55rem 0.2rem; text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 0.3rem; background: rgba(255,255,255,0.08); padding: 0.15rem 0.35rem; border-radius: 0.4rem;">
                            <button type="button" onclick="updateCartQty(${idx}, -1)" style="background: none; border: none; color: #ef4444; font-weight: 900; cursor: pointer; font-size: 0.85rem;">-</button>
                            <span style="font-size: 0.775rem; font-weight: 900; color: white;">${item.qty}</span>
                            <button type="button" onclick="updateCartQty(${idx}, 1)" style="background: none; border: none; color: #84cc16; font-weight: 900; cursor: pointer; font-size: 0.85rem;">+</button>
                        </div>
                    </td>
                    <td style="padding: 0.55rem 0.2rem; text-align: right; font-weight: 900; color: #84cc16; font-size: 0.825rem;">
                        Rp ${item.subtotal.toLocaleString('id-ID')}
                    </td>
                </tr>`;
            });
            tbody.innerHTML = html;
        }

        const subtotal = cart.reduce((acc, item) => acc + item.subtotal, 0);
        const discount = parseFloat(document.getElementById('cartDiscountInput').value) || 0;
        const total = Math.max(0, subtotal - discount);
        const payAmountInput = document.getElementById('posPayAmount');
        const payAmount = parseFloat(payAmountInput.value) || total;
        const changeAmount = Math.max(0, payAmount - total);

        document.getElementById('cartSubtotalText').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('cartTotalText').innerText = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('cartChangeText').innerText = 'Rp ' + changeAmount.toLocaleString('id-ID');
    }

    function togglePaymentNumpad(method) {
        const pills = document.getElementById('quickMoneyPills');
        const payInput = document.getElementById('posPayAmount');

        const subtotal = cart.reduce((acc, item) => acc + item.subtotal, 0);
        const discount = parseFloat(document.getElementById('cartDiscountInput').value) || 0;
        const total = Math.max(0, subtotal - discount);

        if (method.includes('Tunai')) {
            if (pills) pills.style.display = 'flex';
            if (payInput) {
                payInput.readOnly = false;
                payInput.style.background = '#060907';
                payInput.style.borderColor = '#84cc16';
                if (!payInput.value || parseFloat(payInput.value) === 0) {
                    payInput.value = total;
                }
            }
        } else {
            if (pills) pills.style.display = 'none';
            if (payInput) {
                payInput.value = total;
                payInput.readOnly = true;
                payInput.style.background = 'rgba(255,255,255,0.05)';
                payInput.style.borderColor = 'rgba(255,255,255,0.2)';
            }
        }
        renderCartSummary();
    }

    function setQuickCash(val) {
        const subtotal = cart.reduce((acc, item) => acc + item.subtotal, 0);
        const discount = parseFloat(document.getElementById('cartDiscountInput').value) || 0;
        const total = Math.max(0, subtotal - discount);

        if (val === 'exact') {
            document.getElementById('posPayAmount').value = total;
        } else {
            document.getElementById('posPayAmount').value = val;
        }
        renderCartSummary();
    }

    function processPosCheckout() {
        if (cart.length === 0) {
            alert('Keranjang kasir masih kosong!');
            return;
        }

        const subtotal = cart.reduce((acc, item) => acc + item.subtotal, 0);
        const discount = parseFloat(document.getElementById('cartDiscountInput').value) || 0;
        const total = Math.max(0, subtotal - discount);
        const payAmount = parseFloat(document.getElementById('posPayAmount').value) || total;

        const btn = document.getElementById('checkoutBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Memproses...</span>';

        fetch('{{ route("admin.pos.checkout") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                member_name: document.getElementById('posMemberName').value || 'Pelanggan UMUM',
                member_phone: document.getElementById('posMemberPhone').value || '-',
                items: cart,
                payment_method: document.getElementById('posPaymentMethod').value,
                pay_amount: payAmount,
                discount: discount
            })
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-print"></i> <span>PROSES BAYAR &amp; STRUK (F8)</span>';

            if (data.success) {
                speakAnnouncement('Transaksi kasir berhasil.');
                openReceiptModal(data.receipt_url, data.invoice_number, data.change_amount, data.payment_method, data.qris_data, data.transaction_id);
                clearCart();
            } else {
                alert(data.message || 'Gagal memproses transaksi kasir.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-print"></i> <span>PROSES BAYAR &amp; STRUK (F8)</span>';
            alert('Terjadi kesalahan koneksi.');
        });
    }

    let qrisStatusTimer = null;

    function openReceiptModal(url, invNo, change, paymentMethod, qrisData, txId) {
        currentReceiptUrl = url;
        document.getElementById('modalInvoiceNo').innerText = 'Invoice: ' + invNo;
        clearInterval(qrisStatusTimer);

        const isQris = paymentMethod && (paymentMethod.toLowerCase().includes('qris') || paymentMethod.toLowerCase().includes('ipaymu'));
        const linkBtn = document.getElementById('modalQrisPayLinkBtn');

        if (isQris) {
            document.getElementById('modalHeaderTitleText').innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="color: #fbbf24;"></i> <span style="color: #fbbf24;">⏳ MENUNGGU SCAN &amp; PELUNASAN QRIS...</span>';
            document.getElementById('modalChangeAmountText').innerHTML = '<span style="color: #fbbf24; font-weight: 800;">Status: ⏳ PENDING</span>';

            // Real-Time Polling for iPaymu Callback Verification
            if (txId) {
                qrisStatusTimer = setInterval(() => {
                    fetch('/admin/pos/check-status/' + txId)
                        .then(res => res.json())
                        .then(res => {
                            if (res.is_paid) {
                                clearInterval(qrisStatusTimer);
                                document.getElementById('modalHeaderTitleText').innerHTML = '<i class="fa-solid fa-circle-check" style="color: #84cc16;"></i> <span style="color: #84cc16;">✅ TRANSAKSI QRIS IPAYMU LUNAS!</span>';
                                document.getElementById('modalChangeAmountText').innerHTML = '<span style="color: #84cc16; font-weight: 900;">Status: ✅ LUNAS</span>';
                                speakAnnouncement('Pembayaran QRIS iPaymu berhasil dilunasi.');
                                const iframe = document.getElementById('receiptIframe');
                                iframe.src = url;
                                setTimeout(() => {
                                    printReceiptIframe();
                                }, 1200);
                            }
                        })
                        .catch(err => {});
                }, 3000);
            }

        } else {
            document.getElementById('modalHeaderTitleText').innerHTML = '<i class="fa-solid fa-circle-check" style="color: #84cc16;"></i> <span style="color: #84cc16;">TRANSAKSI KASIR BERHASIL!</span>';
            document.getElementById('modalChangeAmountText').innerText = 'Kembali: Rp ' + parseInt(change || 0).toLocaleString('id-ID');
        }

        document.getElementById('receiptIframe').src = url;

        const modalEl = document.getElementById('posSuccessReceiptModal');
        if (modalEl) {
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
        }
    }

    function closeReceiptModal() {
        clearInterval(qrisStatusTimer);
        const modalEl = document.getElementById('posSuccessReceiptModal');
        if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
        }
        document.getElementById('posSearchInput').focus();
    }

    function printReceiptIframe() {
        const iframe = document.getElementById('receiptIframe');
        if (iframe && iframe.contentWindow) {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }
    }

    function openRecentTransactionsModal() {
        const modalEl = document.getElementById('recentTransactionsModal');
        if (modalEl) {
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
        }
    }

    function closeRecentTransactionsModal() {
        const modalEl = document.getElementById('recentTransactionsModal');
        if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
        }
    }

    function speakAnnouncement(text) {
        if (!('speechSynthesis' in window)) return;
        try {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'id-ID';
            utterance.rate = 1.0;
            const voices = window.speechSynthesis.getVoices();
            const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID'));
            if (idVoice) utterance.voice = idVoice;
            window.speechSynthesis.speak(utterance);
        } catch(e) {}
    }

    let searchTimer = null;
    function searchMemberPos(val) {
        clearTimeout(searchTimer);
        const dropdown = document.getElementById('memberSearchDropdown');
        if (!val || val.length < 2) {
            dropdown.style.display = 'none';
            return;
        }

        searchTimer = setTimeout(() => {
            fetch(`{{ route('admin.pos.search-members') }}?q=` + encodeURIComponent(val))
                .then(res => res.json())
                .then(members => {
                    if (members.length === 0) {
                        dropdown.style.display = 'none';
                        return;
                    }

                    let html = '';
                    members.forEach(m => {
                        html += `<div onclick="selectMemberPos('${m.name.replace(/'/g, "\\'")}', '${m.phone || ''}')" style="padding: 0.65rem 0.85rem; border-bottom: 1px solid rgba(255,255,255,0.06); cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='rgba(132,204,22,0.15)'" onmouseout="this.style.background='transparent'">
                            <div style="font-weight: 900; color: white; font-size: 0.85rem;">${m.name} <span style="font-size: 0.725rem; color: #84cc16; font-family: monospace;">[${m.member_card_id || 'MEMBER'}]</span></div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">WA: ${m.phone || '-'}</div>
                        </div>`;
                    });

                    dropdown.innerHTML = html;
                    dropdown.style.display = 'block';
                })
                .catch(err => dropdown.style.display = 'none');
        }, 200);
    }

    function selectMemberPos(name, phone) {
        document.getElementById('posMemberName').value = name;
        document.getElementById('posMemberPhone').value = phone;
        document.getElementById('memberSearchDropdown').style.display = 'none';
        speakAnnouncement('Data member ' + name + ' terpilih.');
    }

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('memberSearchDropdown');
        const input = document.getElementById('posMemberName');
        if (dropdown && input && !dropdown.contains(e.target) && e.target !== input) {
            dropdown.style.display = 'none';
        }
    });

    function filterPosCategory(catName, btnEl) {
        document.querySelectorAll('.pos-cat-btn').forEach(b => {
            b.style.background = 'rgba(255,255,255,0.05)';
            b.style.color = '#cbd5e1';
            b.classList.remove('active-cat');
        });
        
        if (btnEl) {
            btnEl.style.background = '#84cc16';
            btnEl.style.color = '#090d0b';
            btnEl.classList.add('active-cat');
        }

        const query = (document.getElementById('posSearchInput')?.value || '').toLowerCase().trim();
        let visibleCount = 0;

        document.querySelectorAll('.pos-item-card').forEach(card => {
            const itemCat = card.dataset.category || '';
            const itemSearch = card.dataset.search || '';

            const matchesCategory = (catName === 'all' || itemCat === catName);
            const matchesQuery = (!query || itemSearch.includes(query));

            if (matchesCategory && matchesQuery) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const emptyMsg = document.getElementById('posEmptyProducts');
        if (emptyMsg) {
            emptyMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
        }
    }

    function filterPosSearch(val) {
        const activeBtn = document.querySelector('.pos-cat-btn.active-cat');
        const activeCat = activeBtn ? activeBtn.dataset.cat : 'all';
        filterPosCategory(activeCat, activeBtn);
    }

    // Keyboard Shortcuts (F2: Search, F4: Member, F8: Checkout, Esc: Clear/Close)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F2' || (e.key === '/' && document.activeElement.tagName !== 'INPUT')) {
            e.preventDefault();
            document.getElementById('posSearchInput').focus();
        } else if (e.key === 'F4') {
            e.preventDefault();
            document.getElementById('posMemberName').focus();
        } else if (e.key === 'F8') {
            e.preventDefault();
            processPosCheckout();
        } else if (e.key === 'Escape') {
            closeReceiptModal();
            closeRecentTransactionsModal();
        }
    });

    function togglePosFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {});
            document.getElementById('posFsIcon').className = 'fa-solid fa-compress';
            document.getElementById('posFsText').innerText = 'Exit Fullscreen';
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
                document.getElementById('posFsIcon').className = 'fa-solid fa-expand';
                document.getElementById('posFsText').innerText = 'Fullscreen';
            }
        }
    }
</script>
@endsection
