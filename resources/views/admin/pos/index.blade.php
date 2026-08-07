@extends('layouts.app')

@section('title', 'POS Kasir Studio & Toko Suplemen | Admin FitLife Center')

@section('content')
<section style="background: #060907; padding: 2.5rem 0 5rem; color: white; min-height: 90vh;">
    <div class="container-fluid" style="padding: 0 2rem;">
        
        <!-- Header Bar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <a href="{{ route('admin.dashboard') }}" style="color: #94a3b8; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; margin-bottom: 0.35rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Admin Dashboard
                </a>
                <h1 style="font-size: 2.2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;">
                    🛒 POS Kasir Studio &amp; Toko Suplemen
                </h1>
                <p style="color: #94a3b8; font-size: 0.875rem; margin: 0.2rem 0 0;">
                    Kasir penjualan air mineral, whey protein shake, tiket masuk harian, &amp; sewa alat gym.
                </p>
            </div>

            <div style="display: flex; gap: 0.85rem; align-items: center; flex-wrap: wrap;">
                <button type="button" onclick="togglePosFullscreen()" id="fullscreenPosBtn" style="background: rgba(132, 204, 22, 0.15); border: 1.5px solid #84cc16; color: #84cc16; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 900; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: all 0.25s ease;" title="Tampilkan Layar Penuh POS Kasir">
                    <i class="fa-solid fa-expand" id="posFsIcon"></i> <span id="posFsText">Mode Fullscreen Kasir</span>
                </button>

                <a href="{{ route('admin.pos.products') }}" style="background: rgba(56,189,248,0.15); border: 1.5px solid #38bdf8; color: #38bdf8; padding: 0.65rem 1.25rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-boxes-stacked"></i> Kelola Stok Produk
                </a>
                <div style="background: rgba(132,204,22,0.12); border: 1.5px solid #84cc16; padding: 0.65rem 1.25rem; border-radius: 99px; color: #84cc16; font-weight: 900; font-size: 0.85rem;">
                    🟢 KASIR ONLINE
                </div>
            </div>
        </div>

        <!-- Main POS Grid: Product Catalog (Left) vs Cart Register (Right) -->
        <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 1.75rem; align-items: start;" class="grid-2">
            
            <!-- Left Side: Product Catalog Grid -->
            <div>
                <!-- Category Filter & Search Bar -->
                <div style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
                        <a href="{{ route('admin.pos.index', ['category' => 'all', 'q' => $q]) }}" class="btn" style="background: {{ $category === 'all' ? '#84cc16' : 'rgba(255,255,255,0.05)' }}; color: {{ $category === 'all' ? '#090d0b' : '#cbd5e1' }}; border: 1px solid rgba(255,255,255,0.12); padding: 0.55rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-decoration: none;">
                            Semua Produk
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('admin.pos.index', ['category' => $cat, 'q' => $q]) }}" class="btn" style="background: {{ $category === $cat ? '#84cc16' : 'rgba(255,255,255,0.05)' }}; color: {{ $category === $cat ? '#090d0b' : '#cbd5e1' }}; border: 1px solid rgba(255,255,255,0.12); padding: 0.55rem 1.15rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; text-decoration: none;">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Search Input -->
                    <form method="GET" action="{{ route('admin.pos.index') }}" style="position: relative;">
                        <input type="hidden" name="category" value="{{ $category }}">
                        <input type="text" name="q" value="{{ $q }}" placeholder="Ketik kode atau nama produk (e.g. Aqua, Whey Protein, Tiket)..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid rgba(255,255,255,0.15); border-radius: 0.85rem; padding: 0.75rem 1rem 0.75rem 2.6rem; color: white; outline: none;">
                        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;"></i>
                    </form>
                </div>

                <!-- Product Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.25rem;">
                    @forelse($products as $p)
                    <div onclick="addToCart({{ json_encode($p) }})" style="background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.25rem; padding: 1.25rem; cursor: pointer; transition: all 0.2s; position: relative; overflow: hidden;" class="pos-item-card">
                        <div style="font-size: 0.725rem; font-family: monospace; color: #84cc16; font-weight: 800; margin-bottom: 0.35rem;">
                            {{ $p->code }}
                        </div>
                        <h4 style="font-size: 1rem; font-weight: 900; color: white; margin: 0 0 0.5rem; font-family: 'Outfit', sans-serif; line-height: 1.3;">
                            {{ $p->name }}
                        </h4>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 0.85rem;">
                            Stok: <strong style="color: {{ $p->stock > 10 ? '#38bdf8' : '#ef4444' }};">{{ $p->stock }} Pcs</strong>
                        </div>
                        <div style="font-size: 1.15rem; font-weight: 900; color: #84cc16; font-family: 'Outfit', sans-serif;">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </div>

                        <div style="position: absolute; right: 1rem; bottom: 1rem; width: 36px; height: 36px; background: rgba(132,204,22,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16;">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; padding: 3rem; text-align: center; color: #94a3b8; background: #0d1310; border-radius: 1.25rem;">
                        Tidak ada produk yang cocok dengan pencarian.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Side: POS Register & Shopping Cart -->
            <div style="background: #0d1310; border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 1.75rem; box-shadow: 0 25px 50px rgba(0,0,0,0.8); position: sticky; top: 1.5rem;">
                
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1.5px dashed rgba(255,255,255,0.15); padding-bottom: 1rem; margin-bottom: 1.25rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-receipt" style="color: #84cc16;"></i> Keranjang Kasir
                    </h3>
                    <button type="button" onclick="clearCart()" style="background: none; border: none; color: #ef4444; font-size: 0.8rem; font-weight: 800; cursor: pointer;">
                        <i class="fa-solid fa-trash-can"></i> Kosongkan
                    </button>
                </div>

                <!-- Customer Details Input with Autocomplete & Scan Barcode -->
                <div style="margin-bottom: 1.25rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; position: relative;">
                    <div style="position: relative;">
                        <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">
                            🔍 CARI MEMBER / SCAN KARTU <span style="color: #84cc16;">(Auto-Fill)</span>
                        </label>
                        <input type="text" id="posMemberName" oninput="searchMemberPos(this.value)" placeholder="Ketik Nama / WA / Scan FL-MEM-004..." style="width: 100%; background: rgba(255,255,255,0.05); border: 1.5px solid #84cc16; border-radius: 0.65rem; padding: 0.55rem; color: white; outline: none; font-size: 0.85rem; font-weight: 800;">
                        
                        <!-- Autocomplete Suggestions List -->
                        <div id="memberSearchDropdown" style="display: none; position: absolute; left: 0; right: 0; top: 100%; z-index: 100; background: #0d1310; border: 1.5px solid #84cc16; border-radius: 0.75rem; max-height: 180px; overflow-y: auto; box-shadow: 0 10px 25px rgba(0,0,0,0.8); margin-top: 0.25rem;">
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">NOMOR WHATSAPP MEMBER</label>
                        <input type="text" id="posMemberPhone" placeholder="e.g. 081234567890" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 0.65rem; padding: 0.55rem; color: white; outline: none; font-size: 0.85rem;">
                    </div>
                </div>

                <!-- Cart Items Table List -->
                <div style="max-height: 260px; overflow-y: auto; margin-bottom: 1.25rem; border: 1px solid rgba(255,255,255,0.08); border-radius: 0.85rem; padding: 0.5rem;" id="cartListWrapper">
                    <div id="cartEmptyState" style="padding: 2.5rem; text-align: center; color: #94a3b8; font-size: 0.85rem;">
                        Belum ada item di keranjang kasir. Klik produk di sebelah kiri untuk memilih.
                    </div>
                    <table style="width: 100%; border-collapse: collapse; display: none;" id="cartTable">
                        <tbody id="cartTbody"></tbody>
                    </table>
                </div>

                <!-- Payment Calculations -->
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 1rem; padding: 1.25rem; margin-bottom: 1.25rem; display: flex; flex-direction: column; gap: 0.65rem;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.875rem; color: #cbd5e1;">
                        <span>Subtotal Produk:</span>
                        <strong id="cartSubtotalText">Rp 0</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; color: #cbd5e1;">
                        <span>Diskon (Rp):</span>
                        <input type="number" id="cartDiscountInput" value="0" min="0" oninput="renderCartSummary()" style="width: 110px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); border-radius: 0.5rem; padding: 0.35rem; color: #ef4444; font-weight: 800; text-align: right; outline: none;">
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 1.35rem; font-weight: 900; color: #84cc16; border-top: 1px dashed rgba(255,255,255,0.15); padding-top: 0.65rem; margin-top: 0.35rem; font-family: 'Outfit', sans-serif;">
                        <span>TOTAL BAYAR:</span>
                        <span id="cartTotalText">Rp 0</span>
                    </div>
                </div>

                <!-- Payment Method & Pay Button -->
                <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">METODE BAYAR</label>
                            <select id="posPaymentMethod" style="width: 100%; background: #060907; border: 1.5px solid rgba(255,255,255,0.2); border-radius: 0.65rem; padding: 0.65rem; color: white; font-weight: 800; outline: none;">
                                <option value="Tunai (Cash)">💵 Tunai / Cash Kasir</option>
                                <option value="QRIS Midtrans">📱 QRIS Instan (GoPay/ShopeePay)</option>
                                <option value="Transfer BCA">💳 Transfer Bank BCA</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">UANG DITERIMA (RP)</label>
                            <input type="number" id="posPayAmount" placeholder="e.g. 50000" oninput="renderCartSummary()" style="width: 100%; background: #060907; border: 1.5px solid #84cc16; border-radius: 0.65rem; padding: 0.65rem; color: #84cc16; font-weight: 900; outline: none;">
                        </div>
                    </div>

                    <!-- Fast-Cash Quick Nominal Buttons -->
                    <div style="display: flex; gap: 0.35rem; flex-wrap: wrap;">
                        <button type="button" onclick="setQuickCash('exact')" style="background: rgba(132,204,22,0.15); border: 1px solid #84cc16; color: #84cc16; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.725rem; font-weight: 900; cursor: pointer;">⚡ Uang Pas</button>
                        <button type="button" onclick="setQuickCash(10000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.725rem; font-weight: 800; cursor: pointer;">10rb</button>
                        <button type="button" onclick="setQuickCash(20000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.725rem; font-weight: 800; cursor: pointer;">20rb</button>
                        <button type="button" onclick="setQuickCash(50000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.725rem; font-weight: 800; cursor: pointer;">50rb</button>
                        <button type="button" onclick="setQuickCash(100000)" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; padding: 0.3rem 0.6rem; border-radius: 0.4rem; font-size: 0.725rem; font-weight: 800; cursor: pointer;">100rb</button>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: #38bdf8; font-weight: 800; padding: 0 0.25rem;">
                        <span>KEMBALIAN:</span>
                        <span id="cartChangeText">Rp 0</span>
                    </div>

                    <button type="button" onclick="processPosCheckout()" id="checkoutBtn" class="btn glow-btn" style="width: 100%; background: linear-gradient(135deg, #84cc16 0%, #22c55e 100%); color: #090d0b !important; border: none; padding: 1rem; border-radius: 0.85rem; font-weight: 900; font-size: 1.05rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.65rem; box-shadow: 0 0 25px rgba(132, 204, 22, 0.4);">
                        <i class="fa-solid fa-print" style="color: #090d0b !important;"></i>
                        <span style="color: #090d0b !important;">PROSES BAYAR &amp; CETAK STRUK</span>
                    </button>
                </div>

            </div>

        </div>

    </div>
</section>

<script>
    let cart = [];

    function addToCart(product) {
        const existing = cart.find(i => i.product_id === product.id);
        if (existing) {
            if (existing.qty + 1 > product.stock) {
                alert('Stok produk "' + product.name + '" telah mencapai batas sisa!');
                return;
            }
            existing.qty += 1;
            existing.subtotal = existing.qty * existing.price;
        } else {
            if (product.stock < 1) {
                alert('Stok produk habis!');
                return;
            }
            cart.push({
                product_id: product.id,
                product_name: product.name,
                price: parseFloat(product.price),
                qty: 1,
                subtotal: parseFloat(product.price)
            });
        }
        renderCartSummary();
        speakAnnouncement('Produk ' + product.name + ' ditambahkan.');
    }

    function updateCartQty(index, delta) {
        cart[index].qty += delta;
        if (cart[index].qty <= 0) {
            cart.splice(index, 1);
        } else {
            cart[index].subtotal = cart[index].qty * cart[index].price;
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
                    <td style="padding: 0.65rem 0.25rem;">
                        <div style="font-weight: 800; color: white; font-size: 0.85rem;">${item.product_name}</div>
                        <div style="font-size: 0.725rem; color: #84cc16;">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</div>
                    </td>
                    <td style="padding: 0.65rem 0.25rem; text-align: right;">
                        <div style="display: inline-flex; align-items: center; gap: 0.35rem; background: rgba(255,255,255,0.08); padding: 0.2rem 0.4rem; border-radius: 0.4rem;">
                            <button type="button" onclick="updateCartQty(${idx}, -1)" style="background: none; border: none; color: #ef4444; font-weight: 900; cursor: pointer;">-</button>
                            <span style="font-size: 0.8rem; font-weight: 900;">${item.qty}</span>
                            <button type="button" onclick="updateCartQty(${idx}, 1)" style="background: none; border: none; color: #84cc16; font-weight: 900; cursor: pointer;">+</button>
                        </div>
                    </td>
                    <td style="padding: 0.65rem 0.25rem; text-align: right; font-weight: 900; color: #84cc16; font-size: 0.85rem;">
                        Rp ${item.subtotal.toLocaleString('id-ID')}
                    </td>
                </tr>`;
            });
            tbody.innerHTML = html;
        }

        const subtotal = cart.reduce((acc, item) => acc + item.subtotal, 0);
        const discount = parseFloat(document.getElementById('cartDiscountInput').value) || 0;
        const total = Math.max(0, subtotal - discount);
        const payAmount = parseFloat(document.getElementById('posPayAmount').value) || total;
        const changeAmount = Math.max(0, payAmount - total);

        document.getElementById('cartSubtotalText').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('cartTotalText').innerText = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('cartChangeText').innerText = 'Rp ' + changeAmount.toLocaleString('id-ID');
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
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Memproses Transaksi Kasir...</span>';

        fetch('{{ route("admin.pos.checkout") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                member_name: document.getElementById('posMemberName').value,
                member_phone: document.getElementById('posMemberPhone').value,
                items: cart,
                payment_method: document.getElementById('posPaymentMethod').value,
                pay_amount: payAmount,
                discount: discount
            })
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-print"></i> <span>PROSES BAYAR &amp; CETAK STRUK</span>';

            if (data.success) {
                speakAnnouncement('Transaksi kasir berhasil. Struk kuitansi tercetak.');
                clearCart();
                window.open(data.receipt_url, '_blank', 'width=420,height=600');
            } else {
                alert(data.message || 'Gagal memproses transaksi kasir.');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-print"></i> <span>PROSES BAYAR &amp; CETAK STRUK</span>';
            alert('Transaksi Kasir Berhasil!');
            clearCart();
        });
    }

    function speakAnnouncement(text) {
        if (!('speechSynthesis' in window)) return;
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'id-ID';
        utterance.rate = 1.0;
        const voices = window.speechSynthesis.getVoices();
        const idVoice = voices.find(v => v.lang.includes('id') || v.lang.includes('ID'));
        if (idVoice) utterance.voice = idVoice;
        window.speechSynthesis.speak(utterance);
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
                            <div style="font-size: 0.75rem; color: #94a3b8;">WA: ${m.phone || '-'} • Sisa Sesi: ${m.remaining_sessions || 0} Sesi</div>
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

    function togglePosFullscreen() {
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {
                console.log("Fullscreen Error:", err);
            });
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    document.addEventListener('fullscreenchange', function() {
        const icon = document.getElementById('posFsIcon');
        const text = document.getElementById('posFsText');
        if (document.fullscreenElement) {
            if (icon) icon.className = 'fa-solid fa-compress';
            if (text) text.innerText = 'Keluar Fullscreen';
        } else {
            if (icon) icon.className = 'fa-solid fa-expand';
            if (text) text.innerText = 'Mode Fullscreen Kasir';
        }
    });
</script>
@endsection
