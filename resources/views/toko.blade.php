@extends('layouts.app')

@section('title', 'FitLife Official Store & Supplement Shop Yogyakarta | FitLife Center')
@section('meta_description', 'Toko suplemen gym & gear fitness resmi FitLife Center Yogyakarta. Whey Isolate, Creatine Monohydrate, Pre-Workout, Straps, & Jersey Official.')

@section('content')
<!-- Hero Section -->
<section style="padding: 4rem 0 3rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.4rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-store"></i>
                <span>FITLIFE OFFICIAL STORE &amp; GEAR SHOP</span>
            </div>

            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 0.75rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
                Suplemen &amp; <span style="color: #84cc16;">Gear Fitness Resmi</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
                Suplemen teruji BPOM, gear angkatan berat berkualitas, &amp; merchandise resmi FitLife Center dengan harga spesial member!
            </p>
        </div>
    </div>
</section>

<!-- SUPPLEMENT DOSAGE CALCULATOR WIDGET SECTION -->
<section style="background: #090d0b; padding: 2.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container" style="max-width: 900px;">
        <div style="background: #0d1310; border: 1.5px solid rgba(132,204,22,0.4); border-radius: 1.5rem; padding: 2rem; box-shadow: 0 15px 35px rgba(0,0,0,0.6);">
            
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.2rem;">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.35rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0;">
                        Kalkulator Takaran Dosis Suplemen Harian
                    </h3>
                    <span style="font-size: 0.8rem; color: #94a3b8;">Hitung takaran ideal Whey Protein &amp; Creatine sesuai berat badan Anda</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1.2fr; gap: 1.25rem; align-items: center;" class="grid-2">
                <div>
                    <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">BERAT BADAN (KG)</label>
                    <input type="number" id="suppCalcWeight" value="70" min="40" max="150" oninput="calcSupplementDosage()" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem; border-radius: 0.75rem; color: white; font-weight: 800; font-size: 0.95rem; outline: none;">
                </div>

                <div>
                    <label style="font-size: 0.75rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem;">TARGET FITNESS</label>
                    <select id="suppCalcGoal" onchange="calcSupplementDosage()" style="width: 100%; background: #16201a; border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem; border-radius: 0.75rem; color: white; font-weight: 800; font-size: 0.9rem; outline: none;">
                        <option value="muscle">Pembentukan Otot (Bulk)</option>
                        <option value="fatloss">Fat Loss / Cutting</option>
                        <option value="stamina">Stamina &amp; Daya Tahan</option>
                    </select>
                </div>

                <div style="background: rgba(132,204,22,0.1); border: 1.5px solid #84cc16; border-radius: 1rem; padding: 1rem; text-align: center;">
                    <span style="font-size: 0.725rem; color: #84cc16; font-weight: 800; text-transform: uppercase;">REKOMENDASI DOSIS HARIAN</span>
                    <div style="font-size: 1.15rem; font-weight: 900; color: white; margin-top: 0.25rem;" id="suppCalcResult">
                        🥤 2 Scoop Whey (50g Protein) <br>
                        ⚡ 5 Gram Creatine
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Category Filter Pills Bar -->
<section style="padding: 1.5rem 0; background: #060907; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center;" id="storeCategoryPillNav">
            <button onclick="filterCategory('all', this)" class="btn btn-sm store-filter-btn active" style="background: #84cc16; color: #090d0b; border: 1.5px solid #84cc16; padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                🛒 Semua Produk
            </button>
            <button onclick="filterCategory('Whey & Protein', this)" class="btn btn-sm store-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                🥤 Whey &amp; Protein
            </button>
            <button onclick="filterCategory('Creatine & Energy', this)" class="btn btn-sm store-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                ⚡ Creatine &amp; Energy
            </button>
            <button onclick="filterCategory('Aksesori & Gear', this)" class="btn btn-sm store-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                🏋️ Aksesori &amp; Gear
            </button>
            <button onclick="filterCategory('Apparel / Jersey', this)" class="btn btn-sm store-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                👕 Apparel / Jersey
            </button>
        </div>
    </div>
</section>

<!-- Products Cards Section -->
<section style="background: #060907; padding: 4.5rem 0 6rem; color: white;">
    <div class="container">
        
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            @foreach($products as $p)
            <div class="product-card-item" data-category="{{ $p->category }}" style="overflow: hidden; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='#84cc16';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                
                <div style="height: 220px; overflow: hidden; background: #1e293b; position: relative;">
                    <img src="{{ $p->image }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <div style="position: absolute; top: 1rem; left: 1rem; background: rgba(9, 13, 11, 0.85); backdrop-filter: blur(8px); border: 1px solid #84cc16; color: #84cc16; font-size: 0.7rem; font-weight: 900; padding: 0.35rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                        {{ $p->badge }}
                    </div>
                </div>

                <div style="padding: 1.65rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.775rem; font-weight: 800; color: #84cc16; text-transform: uppercase; margin-bottom: 0.35rem;">
                        {{ $p->category }}
                    </div>

                    <h2 style="font-size: 1.2rem; margin-bottom: 0.5rem; line-height: 1.4; color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif;">
                        {{ $p->name }}
                    </h2>

                    <p style="font-size: 0.825rem; color: #94a3b8; line-height: 1.5; margin-bottom: 1.25rem;">
                        {{ $p->description }}
                    </p>

                    <!-- Price Bar -->
                    <div style="display: flex; align-items: baseline; gap: 0.65rem; margin-bottom: 1.25rem;">
                        <span style="font-size: 1.4rem; font-weight: 900; color: #84cc16; font-family: monospace;">
                            Rp {{ number_format($p->promo_price, 0, ',', '.') }}
                        </span>
                        <span style="font-size: 0.85rem; color: #64748b; text-decoration: line-through; font-family: monospace;">
                            Rp {{ number_format($p->original_price, 0, ',', '.') }}
                        </span>
                    </div>

                    <div style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: auto;">
                        <button type="button" onclick="openProductOrderModal('{{ $p->name }}', 'Rp {{ number_format($p->promo_price, 0, ',', '.') }}')" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.875rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 15px rgba(132,204,22,0.4);">
                            <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem;"></i>
                            <span>PESAN VIA WHATSAPP KASIR</span>
                        </button>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- PRODUCT ORDER MODAL -->
<div id="productOrderModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1310; border: 2px solid #84cc16; border-radius: 1.75rem; padding: 2.25rem; max-width: 440px; width: 100%; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.3); position: relative; color: white;">
        <button onclick="closeProductOrderModal()" style="position: absolute; top: 1rem; right: 1.25rem; background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer;">&times;</button>

        <div style="font-size: 0.8rem; color: #84cc16; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.35rem;">
            <i class="fa-solid fa-cart-shopping"></i> ORDER PRODUK FITLIFE STORE
        </div>
        <h3 style="font-size: 1.3rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 0.25rem;" id="modalProductName">
            FitLife Whey Isolate Protein
        </h3>
        <div style="font-size: 1.2rem; font-weight: 900; color: #84cc16; font-family: monospace; margin-bottom: 1.25rem;" id="modalProductPrice">
            Rp 385.000
        </div>

        <form onsubmit="handleProductOrderSubmit(event)">
            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">NAMA PEMBELI <span style="color: #ef4444;">*</span></label>
                <input type="text" id="orderCustomerName" required placeholder="Nama Anda..." value="Bima Prasetya" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">METODE PENGAMBILAN / PENGIRIMAN</label>
                <select id="orderDeliveryMethod" style="width: 100%; background: #16201a; border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
                    <option value="Ambil di Studio Sleman HQ (Jl. Kaliurang)">Ambil di Studio Sleman HQ (Jl. Kaliurang)</option>
                    <option value="Ambil di Studio Seturan Branch (UGM)">Ambil di Studio Seturan Branch (UGM)</option>
                    <option value="Ambil di Studio Sewon Branch (Bantul)">Ambil di Studio Sewon Branch (Bantul)</option>
                    <option value="Kirim Kurir GoSend / GrabExpress Instant">Kirim Kurir GoSend / GrabExpress Instant</option>
                </select>
            </div>

            <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.9rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                <i class="fa-brands fa-whatsapp" style="font-size: 1.15rem;"></i>
                <span>PROSES ORDERS VIA KASIR STUDIO</span>
            </button>
        </form>
    </div>
</div>

<script>
    let activeProdName = '', activeProdPrice = '';

    function calcSupplementDosage() {
        const weight = parseFloat(document.getElementById('suppCalcWeight').value) || 70;
        const goal = document.getElementById('suppCalcGoal').value;
        const resEl = document.getElementById('suppCalcResult');

        let wheyGrams = Math.round(weight * 0.8); // 0.8g per kg
        let wheyScoops = Math.round(wheyGrams / 25);
        if (wheyScoops < 1) wheyScoops = 1;

        let creatine = '5 Gram Creatine';
        if (goal === 'fatloss') {
            wheyGrams = Math.round(weight * 1.0);
            wheyScoops = Math.round(wheyGrams / 25);
        }

        resEl.innerHTML = `🥤 ${wheyScoops} Scoop Whey (${wheyGrams}g Protein) <br> ⚡ ${creatine}`;
    }

    function filterCategory(cat, btnEl) {
        document.querySelectorAll('.store-filter-btn').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.color = '#cbd5e1';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
        });
        btnEl.style.background = '#84cc16';
        btnEl.style.color = '#090d0b';
        btnEl.style.borderColor = '#84cc16';

        const cards = document.querySelectorAll('.product-card-item');
        cards.forEach(card => {
            if (cat === 'all' || card.getAttribute('data-category') === cat) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function openProductOrderModal(name, price) {
        activeProdName = name;
        activeProdPrice = price;

        document.getElementById('modalProductName').innerText = name;
        document.getElementById('modalProductPrice').innerText = price;
        document.getElementById('productOrderModal').style.display = 'flex';
    }

    function closeProductOrderModal() {
        document.getElementById('productOrderModal').style.display = 'none';
    }

    function handleProductOrderSubmit(e) {
        e.preventDefault();
        const custName = document.getElementById('orderCustomerName').value.trim();
        const delivery = document.getElementById('orderDeliveryMethod').value;

        fetch('{{ route("toko.order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_name: activeProdName,
                price: activeProdPrice,
                quantity: 1,
                customer_name: custName,
                delivery_method: delivery
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.wa_url) {
                window.open(data.wa_url, '_blank');
                closeProductOrderModal();
            }
        });
    }
</script>
@endsection
