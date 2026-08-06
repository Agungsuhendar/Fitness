@extends('layouts.app')

@section('title', 'Jadwal Mingguan Kelas Group Fitness & Booking | FitLife Center Yogyakarta')
@section('meta_description', 'Jadwal mingguan kelas kebugaran kelompok Zumba, Body Combat, Pilates Core, Spin Class, & Crossfit di studio FitLife Center Jogja.')

@section('content')
<!-- Hero Section -->
<section style="padding: 4rem 0 3rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid rgba(132, 204, 22, 0.4); color: #84cc16; padding: 0.4rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-people-group"></i>
                <span>GROUP FITNESS STUDIO CLASSES</span>
            </div>

            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 0.75rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em; color: #ffffff;">
                Jadwal &amp; <span style="color: var(--brand-primary, #84cc16);">Kelas Group Fitness</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
                Tingkatkan semangat latihan Anda bersama komunitas &amp; instruktur berpengalaman. Pilih kelas favorit Anda &amp; amankan slot tempat sekarang!
            </p>
        </div>
    </div>
</section>

<!-- Day Selector Pills Bar -->
<section style="padding: 1.5rem 0; background: #090d0b; border-bottom: 1px solid rgba(255,255,255,0.08); sticky: top; z-index: 10;">
    <div class="container">
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center;" id="dayPillNav">
            <button onclick="filterDay('all', this)" class="btn btn-sm day-filter-btn active" style="background: #84cc16; color: #090d0b; border: 1.5px solid #84cc16; padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                🌟 Semua Hari
            </button>
            <button onclick="filterDay('Senin', this)" class="btn btn-sm day-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                Senin
            </button>
            <button onclick="filterDay('Rabu', this)" class="btn btn-sm day-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                Rabu
            </button>
            <button onclick="filterDay('Kamis', this)" class="btn btn-sm day-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                Kamis
            </button>
            <button onclick="filterDay('Jumat', this)" class="btn btn-sm day-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                Jumat
            </button>
            <button onclick="filterDay('Sabtu', this)" class="btn btn-sm day-filter-btn" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1.5px solid rgba(255,255,255,0.12); padding: 0.55rem 1.35rem; border-radius: 99px; font-weight: 800; cursor: pointer; transition: all 0.2s;">
                Sabtu
            </button>
        </div>
    </div>
</section>

<!-- Class Cards Section -->
<section style="background: #060907; padding: 4.5rem 0 6rem; color: white;">
    <div class="container">
        
        <div class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @foreach($classes as $c)
            <div class="class-card-item" data-day="{{ $c->day }}" style="overflow: hidden; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='#84cc16';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                
                <div style="height: 190px; overflow: hidden; background: #1e293b; position: relative;">
                    <img src="{{ $c->image }}" alt="{{ $c->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <div style="position: absolute; top: 1rem; left: 1rem; background: rgba(9, 13, 11, 0.85); backdrop-filter: blur(8px); border: 1px solid #84cc16; color: #84cc16; font-size: 0.7rem; font-weight: 900; padding: 0.35rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                        {{ $c->badge }}
                    </div>
                </div>

                <div style="padding: 1.65rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.8rem; font-weight: 800; color: #84cc16; margin-bottom: 0.35rem;">
                        📅 {{ $c->day }} • 🕒 {{ $c->time }}
                    </div>

                    <h2 style="font-size: 1.3rem; margin-bottom: 0.65rem; line-height: 1.4; color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif;">
                        {{ $c->title }}
                    </h2>

                    <div style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 1.25rem;">
                        👤 {{ $c->instructor }} <br>
                        📍 {{ $c->branch }}
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: auto;">
                        <span style="background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.3); font-size: 0.75rem; font-weight: 900; padding: 0.25rem 0.65rem; border-radius: 99px;">
                            Sisa {{ $c->remaining_slots }} Slot Tempat
                        </span>

                        <button type="button" onclick="openClassBookingModal('{{ $c->title }}', '{{ $c->day }}', '{{ $c->time }}', '{{ $c->branch }}')" class="btn glow-btn" style="background: #84cc16; color: #090d0b; border: none; padding: 0.55rem 1.15rem; border-radius: 99px; font-weight: 900; font-size: 0.825rem; cursor: pointer; box-shadow: 0 0 15px rgba(132,204,22,0.4);">
                            ⚡ Reservasi Slot
                        </button>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- CLASS BOOKING MODAL -->
<div id="classBookingModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 1.5rem;">
    <div style="background: #0d1310; border: 2px solid #84cc16; border-radius: 1.75rem; padding: 2.25rem; max-width: 440px; width: 100%; box-shadow: 0 25px 60px rgba(0,0,0,0.9), 0 0 35px rgba(132, 204, 22, 0.3); position: relative; color: white;">
        <button onclick="closeClassBookingModal()" style="position: absolute; top: 1rem; right: 1.25rem; background: none; border: none; color: white; font-size: 1.8rem; cursor: pointer;">&times;</button>

        <div style="font-size: 0.8rem; color: #84cc16; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.35rem;">
            <i class="fa-solid fa-ticket"></i> RESERVASI SLOT KELAS
        </div>
        <h3 style="font-size: 1.4rem; font-weight: 900; color: #ffffff; font-family: 'Outfit', sans-serif; margin-bottom: 1rem;" id="modalClassTitle">
            Zumba Fitness Party
        </h3>

        <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; padding: 1rem; font-size: 0.85rem; color: #cbd5e1; margin-bottom: 1.25rem;">
            📅 <strong style="color: white;" id="modalClassSchedule">Senin • 17:00 - 18:00 WIB</strong> <br>
            📍 <span id="modalClassBranch">Sleman HQ (Jl. Kaliurang)</span>
        </div>

        <form onsubmit="handleClassBookingSubmit(event)">
            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">NAMA LENGKAP <span style="color: #ef4444;">*</span></label>
                <input type="text" id="classMemberName" required placeholder="Masukkan nama Anda..." value="Bima Prasetya" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label style="font-size: 0.8rem; font-weight: 800; color: #cbd5e1; display: block; margin-bottom: 0.4rem;">NO. WHATSAPP <span style="color: #ef4444;">*</span></label>
                <input type="text" id="classMemberPhone" required placeholder="Contoh: 081234567890" value="081234567890" style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); padding: 0.75rem 1rem; border-radius: 0.75rem; color: white; font-size: 0.9rem; outline: none;">
            </div>

            <button type="submit" class="btn glow-btn" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.9rem; border-radius: 99px; font-weight: 900; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; box-shadow: 0 0 20px rgba(132,204,22,0.4);">
                <i class="fa-solid fa-paper-plane"></i>
                <span>KONFIRMASI RESERVASI VIA WHATSAPP</span>
            </button>
        </form>
    </div>
</div>

<script>
    let activeClassName = '', activeClassDay = '', activeClassTime = '', activeClassBranch = '';

    function filterDay(day, btnEl) {
        document.querySelectorAll('.day-filter-btn').forEach(btn => {
            btn.style.background = 'rgba(255,255,255,0.05)';
            btn.style.color = '#cbd5e1';
            btn.style.borderColor = 'rgba(255,255,255,0.12)';
        });
        btnEl.style.background = '#84cc16';
        btnEl.style.color = '#090d0b';
        btnEl.style.borderColor = '#84cc16';

        const cards = document.querySelectorAll('.class-card-item');
        cards.forEach(card => {
            if (day === 'all' || card.getAttribute('data-day') === day) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function openClassBookingModal(title, day, time, branch) {
        activeClassName = title;
        activeClassDay = day;
        activeClassTime = time;
        activeClassBranch = branch;

        document.getElementById('modalClassTitle').innerText = title;
        document.getElementById('modalClassSchedule').innerText = day + ' • ' + time;
        document.getElementById('modalClassBranch').innerText = branch;

        document.getElementById('classBookingModal').style.display = 'flex';
    }

    function closeClassBookingModal() {
        document.getElementById('classBookingModal').style.display = 'none';
    }

    function handleClassBookingSubmit(e) {
        e.preventDefault();
        const name = document.getElementById('classMemberName').value.trim();
        const phone = document.getElementById('classMemberPhone').value.trim();

        fetch('{{ route("kelas.booking") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                class_name: activeClassName,
                class_day: activeClassDay,
                class_time: activeClassTime,
                branch: activeClassBranch,
                member_name: name,
                member_id: 'FL-MBR-7782'
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.wa_url) {
                window.open(data.wa_url, '_blank');
                closeClassBookingModal();
            }
        });
    }
</script>
@endsection
