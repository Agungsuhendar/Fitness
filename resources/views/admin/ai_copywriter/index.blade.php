@extends('admin.layout')

@section('title', 'AI Marketing Copywriter Generator - Admin FitLife Center')
@section('header_title', 'AI Marketing Copywriter & Caption Generator')

@section('admin_content')
<div style="width: 100%;">

    <!-- Header Banner -->
    <div class="admin-card" style="background: linear-gradient(135deg, #09130d 0%, #112218 50%, #081510 100%); color: white; padding: 2.25rem 2.5rem; border-radius: 1.5rem; margin-bottom: 2rem; position: relative; overflow: hidden; border: 1px solid rgba(132, 204, 22, 0.3); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(132, 204, 22, 0.15);">
        <!-- Decorative Glow Effects -->
        <div style="position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(132, 204, 22, 0.2) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>
        <div style="position: absolute; bottom: -80px; left: -80px; width: 280px; height: 280px; background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%); pointer-events: none; filter: blur(50px);"></div>

        <div style="position: relative; z-index: 2;">
            <span style="background: rgba(132, 204, 22, 0.15); backdrop-filter: blur(10px); padding: 0.35rem 0.85rem; border-radius: 99px; font-size: 0.775rem; font-weight: 800; border: 1px solid rgba(132, 204, 22, 0.4); color: var(--brand-lime, #84cc16); margin-bottom: 0.75rem; display: inline-block;">
                🤖 AI GENERATIVE MARKETING COPYWRITER
            </span>
            <h2 style="font-size: 1.85rem; font-weight: 900; margin: 0 0 0.4rem; font-family: 'Outfit', sans-serif; color: #ffffff;">
                AI Copywriter &amp; Caption Campaign Generator
            </h2>
            <p style="color: #cbd5e1; margin: 0; font-size: 0.925rem;">
                Buat teks promosi WhatsApp Broadcast, Caption Instagram, dan Hook TikTok secara instan dalam 3 detik!
            </p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;" class="grid-2">
        
        <!-- Form Generator -->
        <div class="admin-card" style="padding: 1.75rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
            <h4 style="font-size: 1.1rem; color: #ffffff; margin-bottom: 1.25rem; font-weight: 900; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-pen-nib" style="color: var(--brand-lime, #84cc16);"></i> Input rincian Campaign Promo
            </h4>

            <form id="aiCopyForm" onsubmit="handleGenerateCopy(event)">
                @csrf
                
                <div style="margin-bottom: 1.25rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">NAMA CAMPAIGN / PROMO *</label>
                    <input type="text" name="promo_name" placeholder="e.g. Promo Kemerdekaan Jogja Sehat" value="Promo Kemerdekaan Jogja Sehat" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">TARGET AUDIENCE *</label>
                    <select name="target_audience" style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none; color-scheme: dark;">
                        <option value="Mahasiswa UGM, UNY & UPN Jogja">🎓 Mahasiswa UGM, UNY &amp; UPN Jogja</option>
                        <option value="Karyawan & Pekerja Kantor Jogja">💼 Karyawan &amp; Pekerja Kantor Jogja</option>
                        <option value="Wanita & Ibu Rumah Tangga">👩 Wanita &amp; Ibu Rumah Tangga</option>
                        <option value="Peserta Persiapan Tes TNI / POLRI">👮 Peserta Persiapan Tes TNI / POLRI</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="font-size: 0.775rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.35rem; letter-spacing: 0.05em;">NILAI DISKON / BONUS *</label>
                    <input type="text" name="discount_value" placeholder="e.g. Diskon Rp 50.000 + Gratis Handuk Gym" value="Diskon Rp 50.000 + Gratis Shaker" required style="width: 100%; background: #121c17; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 0.65rem; padding: 0.65rem; font-weight: 700; outline: none;">
                </div>

                <button type="submit" id="copyBtn" class="btn" style="width: 100%; border-radius: 0.65rem; font-weight: 900; padding: 0.85rem; background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); color: #060907 !important; border: none; box-shadow: 0 0 20px rgba(132, 204, 22, 0.35); cursor: pointer;">
                    🚀 Generate Teks Copywriting AI
                </button>
            </form>
        </div>

        <!-- Output Display -->
        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            
            <div id="copyPlaceholder" class="admin-card" style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
                <i class="fa-solid fa-robot" style="font-size: 2.5rem; color: var(--brand-lime, #84cc16); margin-bottom: 1rem;"></i>
                <h5 style="color: #ffffff; font-weight: 900; margin-bottom: 0.25rem;">Hasil Copywriting AI Akan Tampil Disini</h5>
                <p style="font-size: 0.825rem; margin: 0; color: #cbd5e1;">Isi rincian promo lalu klik tombol Generate.</p>
            </div>

            <div id="copyResults" style="display: none; flex-direction: column; gap: 1.25rem;">
                
                <!-- WA Broadcast Copy -->
                <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <h5 style="margin: 0; font-weight: 900; color: #10b981; font-size: 0.95rem;">📲 Teks WhatsApp Broadcast</h5>
                        <button type="button" onclick="copyToClipboard('outWaCopy')" class="btn" style="background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.12); padding: 0.35rem 0.75rem; border-radius: 0.4rem; font-size: 0.75rem; font-weight: 800; cursor: pointer;">📋 Salin Teks</button>
                    </div>
                    <textarea id="outWaCopy" rows="6" readonly style="width: 100%; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 0.65rem; padding: 0.75rem; font-size: 0.825rem; font-family: monospace; background: #121c17; color: #ffffff; outline: none;"></textarea>
                </div>

                <!-- IG Caption Copy -->
                <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <h5 style="margin: 0; font-weight: 900; color: #f43f5e; font-size: 0.95rem;">📸 Caption Instagram Marketing</h5>
                        <button type="button" onclick="copyToClipboard('outIgCopy')" class="btn" style="background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.12); padding: 0.35rem 0.75rem; border-radius: 0.4rem; font-size: 0.75rem; font-weight: 800; cursor: pointer;">📋 Salin Teks</button>
                    </div>
                    <textarea id="outIgCopy" rows="6" readonly style="width: 100%; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 0.65rem; padding: 0.75rem; font-size: 0.825rem; font-family: monospace; background: #121c17; color: #ffffff; outline: none;"></textarea>
                </div>

                <!-- TikTok Hook Copy -->
                <div class="admin-card" style="padding: 1.5rem; border-radius: 1.25rem; background: var(--admin-card-bg, #0d1410); border: 1px solid var(--admin-border, rgba(255, 255, 255, 0.08));">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <h5 style="margin: 0; font-weight: 900; color: #06b6d4; font-size: 0.95rem;">🎵 TikTok Video Script &amp; Hook</h5>
                        <button type="button" onclick="copyToClipboard('outTtCopy')" class="btn" style="background: rgba(255, 255, 255, 0.08); color: #cbd5e1; border: 1px solid rgba(255, 255, 255, 0.12); padding: 0.35rem 0.75rem; border-radius: 0.4rem; font-size: 0.75rem; font-weight: 800; cursor: pointer;">📋 Salin Teks</button>
                    </div>
                    <textarea id="outTtCopy" rows="4" readonly style="width: 100%; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 0.65rem; padding: 0.75rem; font-size: 0.825rem; font-family: monospace; background: #121c17; color: #ffffff; outline: none;"></textarea>
                </div>

            </div>

        </div>

    </div>

</div>

<script>
    function handleGenerateCopy(e) {
        e.preventDefault();
        const form = document.getElementById('aiCopyForm');
        const btn = document.getElementById('copyBtn');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> AI Sedang Menulis Copywriting...';

        fetch("{{ route('admin.ai-copywriter.generate') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            },
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            btn.disabled = false;
            btn.innerHTML = '🚀 Generate Teks Copywriting AI';

            if (res.success) {
                document.getElementById('copyPlaceholder').style.display = 'none';
                document.getElementById('copyResults').style.display = 'flex';

                document.getElementById('outWaCopy').value = res.copies.wa_broadcast;
                document.getElementById('outIgCopy').value = res.copies.ig_caption;
                document.getElementById('outTtCopy').value = res.copies.tiktok_hook;
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = '🚀 Generate Teks Copywriting AI';
            alert('Gagal memproses copywriting AI.');
        });
    }

    function copyToClipboard(id) {
        const el = document.getElementById(id);
        el.select();
        document.execCommand('copy');
        alert('Teks berhasil disalin ke clipboard!');
    }
</script>
@endsection
