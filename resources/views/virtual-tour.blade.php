@extends('layouts.app')

@section('title', 'Tur Virtual 360° Studio & Fasilitas Gym | FitLife Center Yogyakarta')
@section('meta_description', 'Jelajahi tur virtual 360° studio FitLife Center Yogyakarta. Lihat area Free Weight, Power Rack, Sauna kayu cedar, & studio privat Personal Trainer 1-on-1.')

@section('content')
<style>
    .pulse-hotspot-pin {
        position: absolute;
        width: 38px;
        height: 38px;
        background: rgba(132, 204, 22, 0.9);
        border: 3px solid #ffffff;
        border-radius: 50%;
        color: #090d0b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        cursor: pointer;
        box-shadow: 0 0 25px rgba(132,204,22,0.8), 0 0 0 8px rgba(132,204,22,0.3);
        animation: pulsePinGlow 2s infinite;
        transform: translate(-50%, -50%);
        transition: transform 0.25s ease;
        z-index: 20;
    }
    .pulse-hotspot-pin:hover {
        transform: translate(-50%, -50%) scale(1.25);
        background: #ffffff;
        color: #84cc16;
    }
    @keyframes pulsePinGlow {
        0% { box-shadow: 0 0 0 0 rgba(132,204,22,0.7); }
        70% { box-shadow: 0 0 0 15px rgba(132,204,22,0); }
        100% { box-shadow: 0 0 0 0 rgba(132,204,22,0); }
    }
</style>

<!-- Hero Section -->
<section style="padding: 4rem 0 2.5rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="text-align: center; max-width: 820px; margin: 0 auto;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.4rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-vr-cardboard"></i>
                <span>360° IMMERSIVE STUDIO SHOWCASE</span>
            </div>

            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 0.75rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em;">
                Tur Virtual 360° <span style="color: #84cc16;">Studio &amp; Fasilitas</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-bottom: 1.5rem;">
                Jelajahi suasana kenyamanan studio privat, area angkatan beban komersial, &amp; fasilitas sauna FitLife Center secara 360° interaktif!
            </p>
        </div>
    </div>
</section>

<!-- Zone Selector Pills Bar -->
<section style="padding: 1.25rem 0; background: #090d0b; border-bottom: 1px solid rgba(255,255,255,0.08); position: sticky; top: 70px; z-index: 90;">
    <div class="container">
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center;" id="tourZonePillNav">
            @foreach($zones as $idx => $z)
            <button onclick="switchTourZone('{{ $z->id }}', this)" class="btn btn-sm zone-filter-btn {{ $idx === 0 ? 'active' : '' }}" style="background: {{ $idx === 0 ? '#84cc16' : 'rgba(255,255,255,0.05)' }}; color: {{ $idx === 0 ? '#090d0b' : '#cbd5e1' }}; border: 1.5px solid {{ $idx === 0 ? '#84cc16' : 'rgba(255,255,255,0.12)' }}; padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                {{ $z->name }}
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Main Virtual 360 Viewer Section -->
<section style="background: #060907; padding: 3.5rem 0 6rem; color: white;">
    <div class="container" style="max-width: 1050px;">
        
        <!-- Viewer Container Card -->
        <div style="background: #0d1310; border: 2px solid rgba(132,204,22,0.4); border-radius: 1.75rem; padding: 2rem; box-shadow: 0 25px 60px rgba(0,0,0,0.8), 0 0 35px rgba(132, 204, 22, 0.15); margin-bottom: 2.5rem;">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="background: rgba(132,204,22,0.15); color: #84cc16; font-weight: 900; font-size: 0.775rem; padding: 0.3rem 0.85rem; border-radius: 99px; display: inline-block; margin-bottom: 0.35rem;" id="activeZoneBadge">
                        {{ $zones[0]->badge }}
                    </span>
                    <h2 style="font-size: 1.6rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0;" id="activeZoneTitle">
                        {{ $zones[0]->name }}
                    </h2>
                    <p style="font-size: 0.875rem; color: #94a3b8; margin: 0.25rem 0 0;" id="activeZoneSubtitle">
                        {{ $zones[0]->subtitle }}
                    </p>
                </div>

                <div>
                    <span style="font-size: 0.8rem; color: #84cc16; font-weight: 800; display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.05); padding: 0.4rem 0.85rem; border-radius: 99px; border: 1px solid rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-hand-pointer" style="animation: bounce 1.5s infinite;"></i> Klik Pin Neon untuk Detail Alat
                    </span>
                </div>
            </div>

            <!-- Panoramic 360 Interactive Box -->
            <div id="tourPanoramicViewBox" style="position: relative; width: 100%; height: 480px; border-radius: 1.25rem; overflow: hidden; border: 1px solid rgba(255,255,255,0.15); background: #1e293b; box-shadow: inset 0 0 50px rgba(0,0,0,0.8);">
                
                <!-- Background Image -->
                <img id="tourBgImg" src="{{ $zones[0]->bg_image }}" alt="Virtual Tour Studio" style="width: 100%; height: 100%; object-fit: cover; transition: opacity 0.4s ease;">
                
                <!-- Hotspot Pins Container -->
                <div id="hotspotPinsContainer">
                    @foreach($zones[0]->hotspots as $h)
                    <div class="pulse-hotspot-pin" style="top: {{ $h->top }}; left: {{ $h->left }};" onclick="openHotspotOverlay('{{ $h->title }}', '{{ $h->desc }}')" title="{{ $h->title }}">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    @endforeach
                </div>

                <!-- Overlay Watermark Badge -->
                <div style="position: absolute; bottom: 1.25rem; left: 1.25rem; background: rgba(9, 13, 11, 0.85); backdrop-filter: blur(8px); border: 1px solid #84cc16; color: white; padding: 0.4rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800;">
                    📍 FitLife HQ Studio Yogyakarta
                </div>
            </div>

        </div>

        <!-- Bottom CTA Box -->
        <div style="background: linear-gradient(135deg, rgba(132, 204, 22, 0.15) 0%, rgba(9, 13, 11, 0.95) 100%); border: 1.5px solid #84cc16; border-radius: 1.5rem; padding: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 900; color: white; font-family: 'Outfit', sans-serif; margin: 0 0 0.35rem;">
                    Tertarik Mencoba Fasilitas Studio Kami?
                </h3>
                <p style="color: #cbd5e1; font-size: 0.9rem; margin: 0;">
                    Dapatkan E-Voucher Pass Trial Gratis 7 Hari &amp; Sesi Konsultasi Personal Trainer Privat 1-on-1 gratis.
                </p>
            </div>

            <button type="button" onclick="openTrialModal()" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.85rem 1.75rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.6rem; box-shadow: 0 0 25px rgba(132,204,22,0.4);">
                <i class="fa-solid fa-bolt"></i>
                <span>KLAIM VOUCHER TRIAL GRATIS 7 HARI</span>
            </button>
        </div>

    </div>
</section>

<!-- HOTSPOT DETAIL OVERLAY MODAL -->
<div id="hotspotOverlayModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1310; border: 2px solid #84cc16; border-radius: 1.75rem; padding: 2.25rem; max-width: 440px; width: 100%; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.3); position: relative; color: white;">
        <button onclick="closeHotspotOverlay()" style="position: absolute; top: 1rem; right: 1.25rem; background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer;">&times;</button>

        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <div style="width: 42px; height: 42px; background: rgba(132, 204, 22, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #84cc16; font-size: 1.2rem;">
                <i class="fa-solid fa-dumbbell"></i>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: #84cc16; font-weight: 900; text-transform: uppercase;">SPESIFIKASI ALAT GYM</span>
                <h4 style="font-size: 1.2rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin: 0;" id="hotspotTitle">
                    Hammer Strength Power Rack
                </h4>
            </div>
        </div>

        <p style="font-size: 0.9rem; color: #cbd5e1; line-height: 1.6; margin-bottom: 1.5rem;" id="hotspotDesc">
            Deskripsi rincian alat gym...
        </p>

        <button type="button" onclick="closeHotspotOverlay()" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.8rem; border-radius: 99px; font-weight: 900; font-size: 0.9rem; cursor: pointer;">
            TUTUP DETAIL
        </button>
    </div>
</div>

<script>
    const tourData = @json($zones);

    function switchTourZone(zoneId, btnEl) {
        document.querySelectorAll('.zone-filter-btn').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.color = '#cbd5e1';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
        });
        btnEl.style.background = '#84cc16';
        btnEl.style.color = '#090d0b';
        btnEl.style.borderColor = '#84cc16';

        const zone = tourData.find(z => z.id === zoneId);
        if (!zone) return;

        document.getElementById('activeZoneBadge').innerText = zone.badge;
        document.getElementById('activeZoneTitle').innerText = zone.name;
        document.getElementById('activeZoneSubtitle').innerText = zone.subtitle;
        
        const bgImg = document.getElementById('tourBgImg');
        bgImg.style.opacity = '0.3';
        setTimeout(() => {
            bgImg.src = zone.bg_image;
            bgImg.style.opacity = '1';
        }, 200);

        // Render Hotspots
        const container = document.getElementById('hotspotPinsContainer');
        container.innerHTML = '';
        zone.hotspots.forEach(h => {
            const pin = document.createElement('div');
            pin.className = 'pulse-hotspot-pin';
            pin.style.top = h.top;
            pin.style.left = h.left;
            pin.title = h.title;
            pin.innerHTML = '<i class="fa-solid fa-circle-info"></i>';
            pin.onclick = () => openHotspotOverlay(h.title, h.desc);
            container.appendChild(pin);
        });
    }

    function openHotspotOverlay(title, desc) {
        document.getElementById('hotspotTitle').innerText = title;
        document.getElementById('hotspotDesc').innerText = desc;
        document.getElementById('hotspotOverlayModal').style.display = 'flex';
    }

    function closeHotspotOverlay() {
        document.getElementById('hotspotOverlayModal').style.display = 'none';
    }
</script>
@endsection
