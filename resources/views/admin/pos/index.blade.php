@extends('admin.layout')

@section('title', 'POS Kasir Studio & Toko Suplemen | Admin FitLife Center')
@section('header_title', 'POS Kasir Studio & Toko Suplemen')

@section('admin_content')
<style>
    body.is-fullscreen-mode .admin-sidebar,
    body.is-fullscreen-mode .admin-header,
    body.is-fullscreen-mode .sidebar-backdrop,
    html.is-fullscreen-mode .admin-sidebar,
    html.is-fullscreen-mode .admin-header,
    html.is-fullscreen-mode .sidebar-backdrop,
    :fullscreen .admin-sidebar,
    :fullscreen .admin-header,
    :-webkit-full-screen .admin-sidebar,
    :-webkit-full-screen .admin-header {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        pointer-events: none !important;
    }

    body.is-fullscreen-mode .admin-wrapper,
    html.is-fullscreen-mode .admin-wrapper {
        display: block !important;
        grid-template-columns: 1fr !important;
        padding: 0 !important;
        margin: 0 !important;
        width: 100vw !important;
    }

    body.is-fullscreen-mode .admin-main,
    html.is-fullscreen-mode .admin-main {
        padding: 0.5rem 0.85rem !important;
        margin: 0 !important;
        width: 100vw !important;
        max-width: 100vw !important;
    }
</style>

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
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F2: Cari</span>
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F8: Bayar</span>
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F9: Shift</span>
                    <span style="background: rgba(255,255,255,0.06); padding: 0.2rem 0.45rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.1);">F12: Lock</span>
                </div>

                @if(isset($activeShift) && $activeShift)
                <button type="button" onclick="openShiftManagerModal()" id="shiftStatusBtn" style="background: rgba(132, 204, 22, 0.18); border: 1px solid #84cc16; color: #84cc16; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                    <i class="fa-solid fa-cash-register"></i> Shift Aktif (Modal: Rp {{ number_format($activeShift->initial_cash, 0, ',', '.') }})
                </button>
                @else
                <button type="button" onclick="openOpenShiftModal()" id="shiftStatusBtn" style="background: rgba(234, 179, 8, 0.2); border: 1px solid #eab308; color: #facc15; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 900; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer;">
                    <i class="fa-solid fa-door-open"></i> Buka Kasir (Start Shift)
                </button>
                @endif

                <button type="button" onclick="lockPosScreen()" style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; padding: 0.5rem 1rem; border-radius: 99px; font-weight: 800; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; cursor: pointer;" title="Kunci Layar Kasir">
                    <i class="fa-solid fa-lock"></i> Kunci Kasir
                </button>

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
        @if(!isset($activeShift) || !$activeShift)
        <!-- Fullscreen Shift Lockdown Overlay (Blocking 100% clicks until shift is opened) -->
        <div id="posShiftLockOverlay" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; background: rgba(6, 9, 7, 0.95); backdrop-filter: blur(25px); display: flex; align-items: center; justify-content: center; padding: 1.5rem;">
            <div style="background: #0d1410; border: 1.5px solid rgba(234, 179, 8, 0.5); border-radius: 2rem; padding: 2.5rem 2rem; width: 100%; max-width: 440px; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 50px rgba(234, 179, 8, 0.15); position: relative;">
                
                <!-- Lock Warning Icon & Header -->
                <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(234, 179, 8, 0.15); border: 2px solid #eab308; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; box-shadow: 0 0 25px rgba(234, 179, 8, 0.3);">
                    <i class="fa-solid fa-door-open" style="font-size: 2rem; color: #facc15;"></i>
                </div>

                <h3 style="color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif; font-size: 1.5rem; margin: 0 0 0.35rem;">
                    SHIFT KASIR BELUM DIBUKA
                </h3>
                <p style="color: #cbd5e1; font-size: 0.85rem; margin: 0 0 1.5rem; line-height: 1.5;">
                    Petugas: <strong style="color: #84cc16;">{{ auth()->user()->name ?? 'Kasir Studio' }}</strong><br>
                    Seluruh transaksi POS dikunci. Masukkan <strong>Modal Uang Kembalian di Laci Kasir</strong> untuk membuka shift baru.
                </p>

                <!-- Initial Cash Input Form -->
                <div style="text-align: left; margin-bottom: 1.25rem;">
                    <label style="font-size: 0.775rem; font-weight: 900; color: #94a3b8; margin-bottom: 0.35rem; display: block; text-transform: uppercase;">MODAL AWAL UANG LACI (RP)</label>
                    <input type="number" id="inputInitialCash" value="200000" style="width: 100%; background: rgba(255,255,255,0.06); border: 1.5px solid rgba(234, 179, 8, 0.5); border-radius: 0.85rem; padding: 0.75rem 1rem; color: #ffffff; font-size: 1.3rem; font-weight: 900; outline: none; text-align: center; box-shadow: inset 0 2px 4px rgba(0,0,0,0.5);">
                </div>

                <!-- Quick Cash Select Buttons -->
                <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <button type="button" onclick="document.getElementById('inputInitialCash').value='100000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.5rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.8rem; cursor: pointer;">100 Ribu</button>
                    <button type="button" onclick="document.getElementById('inputInitialCash').value='200000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.5rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.8rem; cursor: pointer;">200 Ribu</button>
                    <button type="button" onclick="document.getElementById('inputInitialCash').value='500000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.5rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.8rem; cursor: pointer;">500 Ribu</button>
                </div>

                <button type="button" onclick="submitOpenShift()" style="width: 100%; background: linear-gradient(135deg, #facc15 0%, #eab308 100%); border: none; color: #060907; font-weight: 900; padding: 0.9rem; border-radius: 1rem; font-size: 1.05rem; cursor: pointer; box-shadow: 0 10px 25px rgba(234, 179, 8, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <i class="fa-solid fa-bolt"></i> 🚀 BUKA SHIFT KASIR NOW (F9)
                </button>

                <a href="{{ route('admin.dashboard') }}" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%; margin-top: 0.85rem; background: rgba(255,255,255,0.06); border: 1.5px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 800; padding: 0.75rem; border-radius: 0.85rem; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.12)'; this.style.borderColor='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(255,255,255,0.15)'">
                    <i class="fa-solid fa-house"></i> 🏠 Kembali ke Dashboard Admin
                </a>

                <div style="font-size: 0.75rem; color: #64748b; margin-top: 1.25rem;">
                    🔒 Proteksi Laci Shift • FitLife POS System Guard
                </div>
            </div>
        </div>
        @endif

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
        const isShiftActive = {{ (isset($activeShift) && $activeShift) ? 'true' : 'false' }};
        if (!isShiftActive && !currentShiftData) {
            alert('⚠️ SHIFT KASIR BELUM DIBUKA!\n\nAnda harus membuka shift kasir & menginput modal uang kembalian di laci kasir terlebih dahulu sebelum melakukan transaksi.');
            openOpenShiftModal();
            return;
        }

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

    // Capture Keyboard Shortcuts (F2: Search, F4: Member, F8: Checkout, F9: Shift, F12: Lock, Esc: Clear/Close)
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
        } else if (e.key === 'F9') {
            e.preventDefault();
            @if(isset($activeShift) && $activeShift)
                openShiftManagerModal();
            @else
                openOpenShiftModal();
            @endif
        } else if (e.key === 'Escape') {
            closeReceiptModal();
            closeRecentTransactionsModal();
        }
    });

    // POS Shift Controller Logic (Zero-Dependency Custom Modals)
    let currentShiftData = null;

    document.addEventListener('DOMContentLoaded', function() {
        // posShiftLockOverlay is already displayed by Blade HTML if shift is inactive!
    });

    function showCustomModal(id) {
        const modalEl = document.getElementById(id);
        if (modalEl) {
            modalEl.classList.add('show');
            modalEl.style.display = 'flex';
            modalEl.style.position = 'fixed';
            modalEl.style.top = '0';
            modalEl.style.left = '0';
            modalEl.style.width = '100vw';
            modalEl.style.height = '100vh';
            modalEl.style.zIndex = '999999';
            modalEl.style.backgroundColor = 'rgba(0, 0, 0, 0.88)';
            modalEl.style.backdropFilter = 'blur(15px)';
            modalEl.style.alignItems = 'center';
            modalEl.style.justifyContent = 'center';
        }
    }

    function hideCustomModal(id) {
        const modalEl = document.getElementById(id);
        if (modalEl) {
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
        }
    }

    function openOpenShiftModal() {
        const lockOverlay = document.getElementById('posShiftLockOverlay');
        if (lockOverlay) {
            lockOverlay.style.display = 'flex';
        } else {
            showCustomModal('openShiftModal');
        }
    }

    function closeOpenShiftModal() {
        const lockOverlay = document.getElementById('posShiftLockOverlay');
        if (lockOverlay) {
            lockOverlay.style.display = 'none';
        }
        hideCustomModal('openShiftModal');
    }

    function submitOpenShift() {
        const initialCash = parseFloat(document.getElementById('inputInitialCash').value) || 0;

        fetch("{{ route('admin.pos.open-shift') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ initial_cash: initialCash })
        })
        .then(res => res.text())
        .then(text => {
            let data;
            try {
                data = JSON.parse(text);
            } catch(e) {
                console.error('Non-JSON response:', text);
                alert('Shift berhasil diproses! Memuat ulang layar POS...');
                location.reload();
                return;
            }

            if (data.success) {
                const overlay = document.getElementById('posShiftLockOverlay');
                if (overlay) overlay.style.display = 'none';
                hideCustomModal('openShiftModal');
                location.reload();
            } else {
                alert(data.message || 'Gagal membuka shift kasir.');
            }
        })
        .catch(err => {
            location.reload();
        });
    }

    function openShiftManagerModal() {
        showCustomModal('shiftManagerModal');

        fetch("{{ route('admin.pos.active-shift') }}", {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data && data.active) {
                currentShiftData = data;
                if (document.getElementById('shiftCashierName')) document.getElementById('shiftCashierName').innerText = data.cashier_name || 'Kasir Studio';
                if (document.getElementById('shiftOpenedTime')) document.getElementById('shiftOpenedTime').innerText = 'Buka: ' + (data.opened_at_formatted || '');
                if (document.getElementById('shiftInitialCashText')) document.getElementById('shiftInitialCashText').innerText = 'Rp ' + (data.initial_cash || 0).toLocaleString('id-ID');
                if (document.getElementById('shiftCashSalesText')) document.getElementById('shiftCashSalesText').innerText = 'Rp ' + (data.cash_sales || 0).toLocaleString('id-ID');
                if (document.getElementById('shiftNonCashSalesText')) document.getElementById('shiftNonCashSalesText').innerText = 'Rp ' + (data.non_cash_sales || 0).toLocaleString('id-ID');
                if (document.getElementById('shiftCashInText')) document.getElementById('shiftCashInText').innerText = 'Rp ' + (data.cash_in || 0).toLocaleString('id-ID');
                if (document.getElementById('shiftCashOutText')) document.getElementById('shiftCashOutText').innerText = 'Rp ' + (data.cash_out || 0).toLocaleString('id-ID');
                if (document.getElementById('shiftExpectedCashText')) document.getElementById('shiftExpectedCashText').innerText = 'Rp ' + (data.expected_cash || 0).toLocaleString('id-ID');
                if (document.getElementById('inputActualCash')) document.getElementById('inputActualCash').value = data.expected_cash || 0;
                calculateShiftDifference();
            }
        })
        .catch(err => {
            console.log('Opened shift manager modal.');
        });
    }

    function closeShiftManagerModal() {
        hideCustomModal('shiftManagerModal');
    }

    function calculateShiftDifference() {
        if (!currentShiftData) return;
        const actual = parseFloat(document.getElementById('inputActualCash').value) || 0;
        const expected = currentShiftData.expected_cash;
        const diff = actual - expected;

        const diffEl = document.getElementById('shiftDiffStatusText');
        if (diff === 0) {
            diffEl.style.color = '#84cc16';
            diffEl.innerText = 'Rp 0 (PAS - AKURAT)';
        } else if (diff < 0) {
            diffEl.style.color = '#ef4444';
            diffEl.innerText = '-Rp ' + Math.abs(diff).toLocaleString('id-ID') + ' (SELISIH KURANG)';
        } else {
            diffEl.style.color = '#38bdf8';
            diffEl.innerText = '+Rp ' + diff.toLocaleString('id-ID') + ' (SELISIH LEBIH)';
        }
    }

    function openCashMovementModal(type) {
        document.getElementById('cashMovementType').value = type;
        document.getElementById('cashMovementModalTitle').innerText = type === 'in' ? '📥 Catat Kas Masuk (+)' : '📤 Catat Kas Keluar (-)';
        document.getElementById('inputMovementAmount').value = '';
        document.getElementById('inputMovementNotes').value = '';
        showCustomModal('cashMovementModal');
    }

    function closeCashMovementModal() {
        hideCustomModal('cashMovementModal');
    }

    function submitCashMovement() {
        const type = document.getElementById('cashMovementType').value;
        const amount = parseFloat(document.getElementById('inputMovementAmount').value) || 0;
        const notes = document.getElementById('inputMovementNotes').value.trim();

        if (amount <= 0 || !notes) {
            alert('Nominal dan keterangan kas harus diisi!');
            return;
        }

        fetch("{{ route('admin.pos.cash-movement') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ type, amount, notes })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                hideCustomModal('cashMovementModal');
                openShiftManagerModal();
            } else {
                alert(data.message || 'Gagal mencatat movement kas.');
            }
        });
    }

    function submitCloseShift() {
        const actualCash = parseFloat(document.getElementById('inputActualCash').value) || 0;

        if (document.getElementById('confirmCashierName')) {
            document.getElementById('confirmCashierName').innerText = (currentShiftData ? currentShiftData.cashier_name : 'Kasir Studio');
        }
        if (document.getElementById('confirmActualCashText')) {
            document.getElementById('confirmActualCashText').innerText = 'Rp ' + actualCash.toLocaleString('id-ID');
        }
        if (document.getElementById('confirmDiffStatusText') && document.getElementById('shiftDiffStatusText')) {
            document.getElementById('confirmDiffStatusText').innerText = document.getElementById('shiftDiffStatusText').innerText;
        }

        showCustomModal('confirmCloseShiftModal');
    }

    function executeCloseShiftFinal() {
        const actualCash = parseFloat(document.getElementById('inputActualCash').value) || 0;
        const notes = (document.getElementById('inputShiftNotes').value || '').trim();

        const btn = document.getElementById('btnFinalCloseShift');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menutup Shift...';
        }

        fetch("{{ route('admin.pos.close-shift') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ actual_cash: actualCash, notes: notes })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                hideCustomModal('confirmCloseShiftModal');
                hideCustomModal('shiftManagerModal');
                alert('🏁 Shift Kasir Berhasil Ditutup!\nUang Setor Laci: Rp ' + actualCash.toLocaleString('id-ID'));
                location.reload();
            } else {
                alert(data.message || 'Gagal menutup shift kasir.');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '🏁 Ya, Tutup Shift';
                }
            }
        })
        .catch(err => {
            location.reload();
        });
    }

    function togglePosFullscreen() {
        const isFsNow = !document.body.classList.contains('is-fullscreen-mode');
        document.body.classList.toggle('is-fullscreen-mode', isFsNow);
        document.documentElement.classList.toggle('is-fullscreen-mode', isFsNow);

        const fsIcon = document.getElementById('posFsIcon');
        const fsText = document.getElementById('posFsText');

        if (fsIcon) fsIcon.className = isFsNow ? 'fa-solid fa-compress' : 'fa-solid fa-expand';
        if (fsText) fsText.innerText = isFsNow ? 'Exit Fullscreen' : 'Fullscreen';

        if (isFsNow) {
            if (!document.fullscreenElement && document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch(err => {});
            }
        } else {
            if (document.fullscreenElement && document.exitFullscreen) {
                document.exitFullscreen().catch(err => {});
            }
        }
    }

    document.addEventListener('fullscreenchange', function() {
        const isNativeFs = !!document.fullscreenElement;
        document.body.classList.toggle('is-fullscreen-mode', isNativeFs);
        document.documentElement.classList.toggle('is-fullscreen-mode', isNativeFs);

        const fsIcon = document.getElementById('posFsIcon');
        const fsText = document.getElementById('posFsText');

        if (fsIcon) fsIcon.className = isNativeFs ? 'fa-solid fa-compress' : 'fa-solid fa-expand';
        if (fsText) fsText.innerText = isNativeFs ? 'Exit Fullscreen' : 'Fullscreen';
    });

    // POS PIN Lock Screen Controller Logic
    let currentEnteredPin = '';
    let isPosLocked = false;

    function lockPosScreen() {
        isPosLocked = true;
        currentEnteredPin = '';
        updatePinDotsDisplay();
        document.getElementById('pinErrorAlert').style.display = 'none';
        document.getElementById('posLockOverlay').style.display = 'flex';
    }

    function pressPinNum(num) {
        if (!isPosLocked) return;
        if (currentEnteredPin.length < 10) {
            currentEnteredPin += num;
            updatePinDotsDisplay();
            if (currentEnteredPin.length === 4) {
                submitPinUnlock();
            }
        }
    }

    function clearPinInput() {
        currentEnteredPin = '';
        updatePinDotsDisplay();
        document.getElementById('pinErrorAlert').style.display = 'none';
    }

    function updatePinDotsDisplay() {
        for (let i = 0; i < 4; i++) {
            const dot = document.getElementById('pinDot' + i);
            if (dot) {
                if (i < currentEnteredPin.length) {
                    dot.style.background = '#84cc16';
                    dot.style.borderColor = '#84cc16';
                    dot.style.boxShadow = '0 0 10px #84cc16';
                } else {
                    dot.style.background = 'transparent';
                    dot.style.borderColor = 'rgba(255,255,255,0.3)';
                    dot.style.boxShadow = 'none';
                }
            }
        }
    }

    function submitPinUnlock() {
        if (!currentEnteredPin) return;

        fetch("{{ route('admin.pos.verify-pin') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ pin: currentEnteredPin })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                isPosLocked = false;
                document.getElementById('posLockOverlay').style.display = 'none';
                currentEnteredPin = '';
            } else {
                document.getElementById('pinErrorAlert').innerText = '⚠️ ' + (data.message || 'PIN / Password Kasir Salah!');
                document.getElementById('pinErrorAlert').style.display = 'block';
                const card = document.getElementById('posLockCard');
                if (card) {
                    card.style.transform = 'scale(0.98)';
                    setTimeout(() => card.style.transform = 'none', 200);
                }
                currentEnteredPin = '';
                updatePinDotsDisplay();
            }
        })
        .catch(err => {
            document.getElementById('pinErrorAlert').innerText = '⚠️ PIN / Password Kasir Salah!';
            document.getElementById('pinErrorAlert').style.display = 'block';
            currentEnteredPin = '';
            updatePinDotsDisplay();
        });
    }

    // Capture Keyboard F12 or Physical Keypad typing while locked
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12') {
            e.preventDefault();
            if (!isPosLocked) {
                lockPosScreen();
            }
            return;
        }

        if (isPosLocked) {
            if (e.key >= '0' && e.key <= '9') {
                pressPinNum(e.key);
            } else if (e.key === 'Backspace') {
                clearPinInput();
            } else if (e.key === 'Enter') {
                submitPinUnlock();
            }
        }
    });
</script>

<!-- Fullscreen PIN Lock Screen Overlay -->
<div id="posLockOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; background: rgba(6, 9, 7, 0.96); backdrop-filter: blur(25px); align-items: center; justify-content: center;">
    <div style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 2rem; padding: 2.25rem 2rem; width: 90%; max-width: 380px; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 50px rgba(132, 204, 22, 0.15); transition: transform 0.2s ease;" id="posLockCard">
        
        <!-- Lock Icon & Header -->
        <div style="width: 65px; height: 65px; border-radius: 50%; background: rgba(132, 204, 22, 0.15); border: 2px solid #84cc16; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.15rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.3);">
            <i class="fa-solid fa-lock" style="font-size: 1.8rem; color: #84cc16;"></i>
        </div>

        <h3 style="color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin: 0 0 0.35rem;">
            SESI KASIR TERKUNCI
        </h3>
        <p style="color: #94a3b8; font-size: 0.825rem; margin: 0 0 1.25rem; line-height: 1.4;">
            Petugas: <strong style="color: #84cc16;">{{ auth()->user()->name ?? 'Kasir Studio' }}</strong><br>
            Ketik 4-digit PIN Kasir (Default: <code style="color: #38bdf8;">1234</code>) atau Password untuk Membuka.
        </p>

        <!-- PIN Mask Dots Display -->
        <div style="display: flex; justify-content: center; gap: 0.85rem; margin-bottom: 1.25rem;" id="pinDotsContainer">
            <span class="pin-dot" id="pinDot0" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3); background: transparent; transition: all 0.2s;"></span>
            <span class="pin-dot" id="pinDot1" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3); background: transparent; transition: all 0.2s;"></span>
            <span class="pin-dot" id="pinDot2" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3); background: transparent; transition: all 0.2s;"></span>
            <span class="pin-dot" id="pinDot3" style="width: 16px; height: 16px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.3); background: transparent; transition: all 0.2s;"></span>
        </div>

        <div id="pinErrorAlert" style="display: none; background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; font-size: 0.8rem; font-weight: 800; padding: 0.5rem; border-radius: 0.65rem; margin-bottom: 1rem;">
            ⚠️ PIN / Password Kasir Salah!
        </div>

        <!-- Touch Numpad Grid -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.65rem; margin-bottom: 1.25rem;">
            @foreach([1,2,3,4,5,6,7,8,9] as $num)
                <button type="button" onclick="pressPinNum('{{ $num }}')" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: white; border-radius: 0.85rem; font-size: 1.3rem; font-weight: 900; padding: 0.75rem 0; cursor: pointer; transition: all 0.15s;" onmouseover="this.style.background='rgba(132,204,22,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                    {{ $num }}
                </button>
            @endforeach
            <button type="button" onclick="clearPinInput()" style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); color: #f87171; border-radius: 0.85rem; font-size: 0.85rem; font-weight: 800; padding: 0.75rem 0; cursor: pointer;">
                Clear
            </button>
            <button type="button" onclick="pressPinNum('0')" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: white; border-radius: 0.85rem; font-size: 1.3rem; font-weight: 900; padding: 0.75rem 0; cursor: pointer;">
                0
            </button>
            <button type="button" onclick="submitPinUnlock()" style="background: #84cc16; border: 1px solid #84cc16; color: #060907; border-radius: 0.85rem; font-size: 1.1rem; font-weight: 900; padding: 0.75rem 0; cursor: pointer;">
                <i class="fa-solid fa-key"></i>
            </button>
        </div>

        <div style="font-size: 0.75rem; color: #64748b;">
            🔒 Sesi Terproteksi • FitLife Cashier Guard
        </div>
    </div>
</div>

<!-- Modal Buka Shift Kasir (Start Shift) -->
<div id="openShiftModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; background: rgba(6, 9, 7, 0.94); backdrop-filter: blur(25px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1410; border: 1.5px solid rgba(234, 179, 8, 0.5); border-radius: 2rem; padding: 2.25rem 2rem; width: 100%; max-width: 420px; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 50px rgba(234, 179, 8, 0.15); position: relative;">
        <button type="button" onclick="closeOpenShiftModal()" style="position: absolute; top: 1.25rem; right: 1.25rem; background: transparent; border: none; color: #94a3b8; font-size: 1.25rem; cursor: pointer;">✕</button>
        
        <div style="width: 65px; height: 65px; border-radius: 50%; background: rgba(234, 179, 8, 0.15); border: 2px solid #eab308; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.15rem; box-shadow: 0 0 25px rgba(234, 179, 8, 0.3);">
            <i class="fa-solid fa-door-open" style="font-size: 1.8rem; color: #facc15;"></i>
        </div>

        <h3 style="color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin: 0 0 0.35rem;">
            BUKA SHIFT KASIR STUDIO
        </h3>
        <p style="color: #cbd5e1; font-size: 0.825rem; margin: 0 0 1.25rem; line-height: 1.4;">
            Petugas: <strong style="color: #84cc16;">{{ auth()->user()->name ?? 'Kasir Studio' }}</strong><br>
            Masukkan nominal <strong>Modal Uang Kembalian di Laci Kasir</strong> untuk membuka shift baru.
        </p>

        <div style="text-align: left; margin-bottom: 1.15rem;">
            <label style="font-size: 0.775rem; font-weight: 900; color: #94a3b8; margin-bottom: 0.35rem; display: block; text-transform: uppercase;">MODAL AWAL UANG LACI (RP)</label>
            <input type="number" id="inputInitialCash" value="200000" style="width: 100%; background: rgba(255,255,255,0.06); border: 1.5px solid rgba(234, 179, 8, 0.5); border-radius: 0.85rem; padding: 0.75rem 1rem; color: #ffffff; font-size: 1.25rem; font-weight: 900; outline: none; text-align: center;">
        </div>

        <div style="display: flex; gap: 0.5rem; margin-bottom: 1.35rem;">
            <button type="button" onclick="document.getElementById('inputInitialCash').value='100000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.45rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.775rem; cursor: pointer;">100 Ribu</button>
            <button type="button" onclick="document.getElementById('inputInitialCash').value='200000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.45rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.775rem; cursor: pointer;">200 Ribu</button>
            <button type="button" onclick="document.getElementById('inputInitialCash').value='500000'" style="flex: 1; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); color: #cbd5e1; padding: 0.45rem; border-radius: 0.6rem; font-weight: 800; font-size: 0.775rem; cursor: pointer;">500 Ribu</button>
        </div>

        <button type="button" onclick="submitOpenShift()" style="width: 100%; background: linear-gradient(135deg, #facc15 0%, #eab308 100%); border: none; color: #060907; font-weight: 900; padding: 0.85rem; border-radius: 0.85rem; font-size: 1rem; cursor: pointer; box-shadow: 0 10px 25px rgba(234, 179, 8, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
            <i class="fa-solid fa-bolt"></i> 🚀 BUKA SHIFT KASIR NOW (F9)
        </button>
    </div>
</div>

<!-- Modal Kelola & Tutup Shift Kasir (Closing Cash Audit) -->
<div id="shiftManagerModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; background: rgba(6, 9, 7, 0.94); backdrop-filter: blur(25px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1410; border: 1.5px solid rgba(132, 204, 22, 0.4); border-radius: 1.75rem; padding: 2rem; width: 100%; max-width: 650px; color: white; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 50px rgba(132, 204, 22, 0.15); position: relative; max-height: 90vh; overflow-y: auto;">
        <button type="button" onclick="closeShiftManagerModal()" style="position: absolute; top: 1.25rem; right: 1.25rem; background: transparent; border: none; color: #94a3b8; font-size: 1.25rem; cursor: pointer;">✕</button>

        <h4 style="font-weight: 900; font-family: 'Outfit', sans-serif; color: #ffffff; display: flex; align-items: center; gap: 0.5rem; margin: 0 0 1.25rem;">
            <i class="fa-solid fa-cash-register" style="color: #84cc16;"></i> Audit Shift &amp; Closing Kas Laci Kasir
        </h4>

        <!-- Info Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.15rem;">
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.85rem; padding: 0.85rem;">
                <span style="font-size: 0.725rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">PETUGAS KASIR</span>
                <div style="font-size: 1.1rem; font-weight: 900; color: white; margin-top: 0.15rem;" id="shiftCashierName">{{ auth()->user()->name ?? 'Kasir Studio' }}</div>
                <div style="font-size: 0.725rem; color: #84cc16; margin-top: 0.15rem;" id="shiftOpenedTime">Shift Aktif</div>
            </div>
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.85rem; padding: 0.85rem;">
                <span style="font-size: 0.725rem; color: #94a3b8; font-weight: 800; text-transform: uppercase;">MODAL AWAL LACI</span>
                <div style="font-size: 1.1rem; font-weight: 900; color: #facc15; margin-top: 0.15rem;" id="shiftInitialCashText">Rp {{ isset($activeShift) ? number_format((float)$activeShift->initial_cash, 0, ',', '.') : '0' }}</div>
                <div style="font-size: 0.725rem; color: #cbd5e1; margin-top: 0.15rem;">Uang Kembalian Awal</div>
            </div>
        </div>

        <!-- Financial Breakdown Grid -->
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.85rem; padding: 1rem; margin-bottom: 1.15rem;">
            <h6 style="font-size: 0.775rem; color: #94a3b8; font-weight: 800; margin-bottom: 0.75rem; text-transform: uppercase;">RINGKASAN ARUS KAS SHIFT THIS SHIFT</h6>
            
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.65rem; text-align: center;">
                <div style="background: rgba(132, 204, 22, 0.1); border: 1px solid rgba(132, 204, 22, 0.2); padding: 0.6rem; border-radius: 0.65rem;">
                    <span style="font-size: 0.675rem; color: #94a3b8;">Penjualan Tunai</span>
                    <div style="font-weight: 900; color: #84cc16; font-size: 0.9rem; margin-top: 0.15rem;" id="shiftCashSalesText">Rp 0</div>
                </div>
                <div style="background: rgba(6, 182, 212, 0.1); border: 1px solid rgba(6, 182, 212, 0.2); padding: 0.6rem; border-radius: 0.65rem;">
                    <span style="font-size: 0.675rem; color: #94a3b8;">Penjualan Non-Tunai</span>
                    <div style="font-weight: 900; color: #06b6d4; font-size: 0.9rem; margin-top: 0.15rem;" id="shiftNonCashSalesText">Rp 0</div>
                </div>
                <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); padding: 0.6rem; border-radius: 0.65rem;">
                    <span style="font-size: 0.675rem; color: #94a3b8;">Kas Masuk (+)</span>
                    <div style="font-weight: 900; color: #10b981; font-size: 0.9rem; margin-top: 0.15rem;" id="shiftCashInText">Rp 0</div>
                </div>
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 0.6rem; border-radius: 0.65rem;">
                    <span style="font-size: 0.675rem; color: #94a3b8;">Kas Keluar (-)</span>
                    <div style="font-weight: 900; color: #ef4444; font-size: 0.9rem; margin-top: 0.15rem;" id="shiftCashOutText">Rp 0</div>
                </div>
            </div>

            <div style="margin-top: 0.85rem; display: flex; gap: 0.5rem; justify-content: flex-end;">
                <button type="button" onclick="openCashMovementModal('in')" style="background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; font-weight: 800; font-size: 0.775rem; padding: 0.35rem 0.75rem; border-radius: 0.5rem; cursor: pointer;">
                    <i class="fa-solid fa-plus"></i> Catat Kas Masuk
                </button>
                <button type="button" onclick="openCashMovementModal('out')" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #f87171; font-weight: 800; font-size: 0.775rem; padding: 0.35rem 0.75rem; border-radius: 0.5rem; cursor: pointer;">
                    <i class="fa-solid fa-minus"></i> Catat Kas Keluar
                </button>
            </div>
        </div>

        <!-- Expected Cash & Actual Cash Count Form -->
        <div style="background: linear-gradient(135deg, #112218 0%, #09130d 100%); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1.15rem; margin-bottom: 1.15rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                <span style="font-weight: 800; color: #cbd5e1; font-size: 0.85rem;">TOTAL UANG LACI SEHARUSNYA (EXPECTED):</span>
                <span style="font-size: 1.3rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;" id="shiftExpectedCashText">Rp 0</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; margin-bottom: 0.3rem; display: block;">HITUNGAN UANG FISIK DI LACI (ACTUAL CASH)</label>
                <input type="number" id="inputActualCash" oninput="calculateShiftDifference()" placeholder="Ketik nominal uang fisik hasil hitungan laci..." style="width: 100%; background: #060907; border: 1.5px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.6rem 0.85rem; color: white; font-size: 1.1rem; font-weight: 900; outline: none;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.3); padding: 0.55rem 0.75rem; border-radius: 0.5rem;">
                <span style="font-size: 0.8rem; font-weight: 800; color: #94a3b8;">STATUS SELISIH LACI:</span>
                <span style="font-weight: 900; font-size: 0.95rem;" id="shiftDiffStatusText">Rp 0 (PAS)</span>
            </div>
        </div>

        <div style="margin-bottom: 1.15rem;">
            <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; margin-bottom: 0.3rem; display: block;">CATATAN CLOSING SHIFT (OPSIONAL)</label>
            <input type="text" id="inputShiftNotes" placeholder="Misal: Uang pas, pecahan 50rb 4 lembar..." style="width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 0.6rem; padding: 0.5rem 0.75rem; color: white; font-size: 0.825rem;">
        </div>

        <button type="button" onclick="submitCloseShift()" style="width: 100%; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; color: white; font-weight: 900; padding: 0.85rem; border-radius: 0.85rem; font-size: 1rem; cursor: pointer; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);">
            🏁 TUTUP SHIFT &amp; AUDIT SETOR KASIR
        </button>
    </div>
</div>

<!-- Modal Record Cash Movement -->
<div id="cashMovementModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; background: rgba(6, 9, 7, 0.94); backdrop-filter: blur(25px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1410; border: 1.5px solid rgba(255,255,255,0.2); border-radius: 1.25rem; color: white; width: 100%; max-width: 360px; padding: 1.5rem; position: relative;">
        <button type="button" onclick="closeCashMovementModal()" style="position: absolute; top: 1rem; right: 1rem; background: transparent; border: none; color: #94a3b8; font-size: 1.1rem; cursor: pointer;">✕</button>
        
        <h5 style="font-weight: 900; font-size: 1.1rem; margin: 0 0 1rem;" id="cashMovementModalTitle">Catat Kas Movement</h5>

        <input type="hidden" id="cashMovementType" value="in">
        <div style="margin-bottom: 1rem;">
            <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; margin-bottom: 0.25rem; display: block;">NOMINAL (RP)</label>
            <input type="number" id="inputMovementAmount" placeholder="0" style="width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 0.65rem; padding: 0.55rem 0.75rem; color: white; font-size: 1rem; font-weight: 800; outline: none;">
        </div>
        <div style="margin-bottom: 1.25rem;">
            <label style="font-size: 0.775rem; font-weight: 800; color: #94a3b8; margin-bottom: 0.25rem; display: block;">KETERANGAN / ALASAN</label>
            <input type="text" id="inputMovementNotes" placeholder="Misal: Beli galon air / Setor modal..." style="width: 100%; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 0.65rem; padding: 0.55rem 0.75rem; color: white; font-size: 0.825rem; outline: none;">
        </div>
        <button type="button" onclick="submitCashMovement()" style="width: 100%; background: #84cc16; border: none; color: #060907; font-weight: 900; padding: 0.75rem; border-radius: 0.65rem; font-size: 0.95rem; cursor: pointer;">
            Simpan Catatan Kas
        </button>
    </div>
</div>

<!-- Modal Konfirmasi Tutup Shift (#confirmCloseShiftModal) -->
<div id="confirmCloseShiftModal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9999999; background: rgba(0, 0, 0, 0.9); backdrop-filter: blur(25px); align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1410; border: 1.5px solid rgba(239, 68, 68, 0.5); border-radius: 2rem; padding: 2.25rem 2rem; width: 100%; max-width: 440px; text-align: center; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 50px rgba(239, 68, 68, 0.2); position: relative;">
        <button type="button" onclick="hideCustomModal('confirmCloseShiftModal')" style="position: absolute; top: 1.25rem; right: 1.25rem; background: transparent; border: none; color: #94a3b8; font-size: 1.25rem; cursor: pointer;">✕</button>

        <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(239, 68, 68, 0.15); border: 2px solid #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; box-shadow: 0 0 25px rgba(239, 68, 68, 0.3);">
            <i class="fa-solid fa-flag-checkered" style="font-size: 2rem; color: #ef4444;"></i>
        </div>

        <h3 style="color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif; font-size: 1.4rem; margin: 0 0 0.35rem;">
            KONFIRMASI TUTUP SHIFT
        </h3>
        <p style="color: #cbd5e1; font-size: 0.85rem; margin: 0 0 1.25rem; line-height: 1.4;">
            Apakah Anda yakin ingin <strong>MENUTUP SHIFT Kasir</strong> dan melakukan Setor Uang Laci sekarang?
        </p>

        <!-- Summary Preview Box -->
        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1rem; text-align: left; margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: space-between; font-size: 0.825rem; margin-bottom: 0.4rem;">
                <span style="color: #94a3b8;">Petugas Kasir:</span>
                <strong style="color: white;" id="confirmCashierName">-</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.825rem; margin-bottom: 0.4rem;">
                <span style="color: #94a3b8;">Uang Fisik Laci:</span>
                <strong style="color: #84cc16;" id="confirmActualCashText">Rp 0</strong>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.825rem;">
                <span style="color: #94a3b8;">Status Selisih:</span>
                <strong style="color: #38bdf8;" id="confirmDiffStatusText">Rp 0 (PAS)</strong>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem;">
            <button type="button" onclick="hideCustomModal('confirmCloseShiftModal')" style="flex: 1; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: white; font-weight: 800; padding: 0.8rem; border-radius: 0.85rem; font-size: 0.9rem; cursor: pointer;">
                Batal
            </button>
            <button type="button" onclick="executeCloseShiftFinal()" id="btnFinalCloseShift" style="flex: 1.4; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; color: white; font-weight: 900; padding: 0.8rem; border-radius: 0.85rem; font-size: 0.9rem; cursor: pointer; box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);">
                🏁 Ya, Tutup Shift
            </button>
        </div>
    </div>
</div>
@endsection
