@extends('layouts.app')

@section('title', 'Testimoni & Video Galeri Alumni - Les Renang Jogja')
@section('meta_description', 'Kisah nyata, testimoni foto & galeri video perkembangan siswa les renang anak, dewasa, & TNI POLRI di Yogyakarta.')

@section('content')
<section class="hero-section" style="padding: 3rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <span class="section-subtitle">Bukti Nyata</span>
            <h1 class="hero-title">Galeri Testimoni & <span class="text-gradient">Video Alumni</span></h1>
            <p class="hero-description">
                Simak pengalaman asli para orang tua murid dan peserta les renang yang telah berhasil menguasai gaya renang bersama kami.
            </p>
        </div>
    </div>
</section>

@if(session('success'))
<section style="padding: 0;">
    <div class="container">
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 1rem 1.25rem; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1rem; text-align: center;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    </div>
</section>
@endif

<section class="section section-bg-alt">
    <div class="container">
        <div class="grid-2">
            @forelse($testimonials as $testi)
            <div class="testimonial-card">
                <div class="rating-stars">
                    @for($i = 0; $i < $testi->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p style="font-style: italic; color: var(--dark-surface); font-size: 1.05rem; line-height: 1.7; margin-bottom: 1rem;">
                    "{{ $testi->review }}"
                </p>
                <div class="testimonial-user" style="display: flex; align-items: center; gap: 0.85rem;">
                    <div class="testimonial-avatar" style="width: 52px; height: 52px; border-radius: 50%; overflow: hidden; border: 2px solid var(--primary-light); flex-shrink: 0;">
                        @if($testi->avatar)
                            <img src="{{ Str::startsWith($testi->avatar, 'http') ? $testi->avatar : asset($testi->avatar) }}" alt="{{ $testi->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.parentElement.innerHTML='<div style=\'width:100%;height:100%;background:var(--primary);color:white;display:flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:800;\'>{{ substr($testi->name, 0, 1) }}</div>';">
                        @else
                            <div style="width:100%;height:100%;background:var(--primary);color:white;display:flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:800;">
                                {{ strtoupper(substr($testi->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div style="font-weight: 800; color: var(--dark);">{{ $testi->name }}</div>
                        <div style="font-size: 0.85rem; color: var(--primary);">{{ $testi->role }} • {{ $testi->program }}</div>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: span 2; text-align: center; padding: 3rem; color: #94a3b8;">
                <i class="fa-solid fa-comment-dots" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                <p style="font-size: 1.1rem;">Belum ada testimoni. Jadilah yang pertama mengirim pengalaman Anda!</p>
            </div>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 3.5rem;">
            <button onclick="openTrialModal()" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-bolt"></i> Rasakan Pengalaman Berenang Sekarang!
            </button>
        </div>
    </div>
<!-- Interactive Before-After Video Gallery Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle"><i class="fa-solid fa-clapperboard"></i> Bukti Hasil Latihan Siswa</span>
            <h2 class="section-title">Galeri Video Before-After Alumni</h2>
            <p class="section-description">Lihat dokumentasi video nyata siswa kami: dari belum berani air hingga mahir berenang gaya dada & bebas!</p>
        </div>

        <div class="grid-3" style="gap: 1.5rem;">
            @forelse($videos as $vid)
            @php
                $vidThumb = $vid->thumbnail
                    ? (Str::startsWith($vid->thumbnail, 'http') ? $vid->thumbnail : asset($vid->thumbnail))
                    : asset('images/assets/video_thumb_daffa.png');
            @endphp
            <div class="reel-card" onclick="openReelModal('{{ $vid->title }}', '{{ $vid->subtitle }}', '{{ $vid->video_url }}')" style="position: relative; height: 420px; border-radius: 1.75rem; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.25); cursor: pointer; border: 3px solid rgba(255,255,255,0.9); transition: all 0.35s ease;">
                <img src="{{ $vidThumb }}" alt="{{ $vid->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(3,4,94,0.92) 0%, rgba(3,4,94,0.2) 50%, rgba(0,0,0,0.4) 100%);"></div>

                @if($vid->before_badge || $vid->after_badge)
                <div style="position: absolute; top: 15px; left: 15px; display: flex; gap: 0.4rem; flex-wrap: wrap;">
                    @if($vid->before_badge)<span style="background: #ef4444; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">{{ $vid->before_badge }}</span>@endif
                    @if($vid->after_badge)<span style="background: #10b981; color: white; font-weight: 800; font-size: 0.725rem; padding: 0.25rem 0.65rem; border-radius: 99px; text-transform: uppercase;">{{ $vid->after_badge }}</span>@endif
                </div>
                @endif

                <div style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 64px; height: 64px; background: rgba(255,255,255,0.92); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                    <i class="fa-solid fa-play" style="margin-left: 4px; color: var(--accent);"></i>
                </div>

                <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; color: white;">
                    <div style="font-weight: 900; font-size: 1.15rem; margin-bottom: 0.2rem; display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-circle-play" style="color: var(--accent);"></i> {{ $vid->title }}
                    </div>
                    @if($vid->description)
                    <div style="font-size: 0.85rem; color: #e0f2fe; line-height: 1.4;">
                        {{ $vid->description }}
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: span 3; text-align: center; color: var(--text-muted); padding: 3rem;">
                <p>Belum ada video galeri yang diaktifkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Form Kirim Testimoni Peserta -->
<section class="section">
    <div class="container">
        <div class="glass-card" style="padding: 3rem; background: #ffffff; max-width: 750px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <span class="section-subtitle">Bagikan Pengalaman Anda</span>
                <h2 style="font-size: 1.85rem; margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-pen-fancy" style="color: var(--primary);"></i> Kirim Testimoni
                </h2>
                <p style="color: var(--text-muted); font-size: 0.925rem;">
                    Ceritakan pengalaman Anda belajar renang bersama kami. Testimoni Anda akan ditampilkan setelah disetujui admin.
                </p>
            </div>

            @if($errors->any())
                <div style="padding: 1rem; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.85rem; margin-bottom: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                            Nama Lengkap <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Contoh: Ibu Dewi Sari" style="border-radius: 0.75rem; padding: 0.75rem 1rem;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                            Keterangan / Role <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="role" class="form-control" value="{{ old('role') }}" required placeholder="Contoh: Ibu dari Kenzo (7th)" style="border-radius: 0.75rem; padding: 0.75rem 1rem;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                            Program yang Diikuti <span style="color: #ef4444;">*</span>
                        </label>
                        <select name="program" class="form-control" required style="border-radius: 0.75rem; padding: 0.75rem 1rem;">
                            <option value="">-- Pilih Program --</option>
                            @foreach(\App\Models\Program::all() as $prog)
                                <option value="{{ $prog->title }}" {{ old('program') == $prog->title ? 'selected' : '' }}>{{ $prog->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                            Rating Kepuasan <span style="color: #ef4444;">*</span>
                        </label>
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.35rem;" id="starRating">
                            @for($s = 1; $s <= 5; $s++)
                            <label style="cursor: pointer; font-size: 1.75rem; color: {{ $s <= 5 ? '#f59e0b' : '#cbd5e1' }}; transition: color 0.2s;" onclick="setRating({{ $s }})">
                                <i class="fa-solid fa-star" id="star{{ $s }}"></i>
                            </label>
                            @endfor
                            <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                        Ceritakan Pengalaman Anda <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea name="review" class="form-control" required rows="4" placeholder="Ceritakan pengalaman Anda belajar renang bersama Les Renang Jogja..." style="border-radius: 0.75rem; padding: 0.75rem 1rem; resize: vertical;">{{ old('review') }}</textarea>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.4rem;">
                        Upload Foto Anda (opsional):
                    </label>
                    <input type="file" name="avatar_file" accept="image/*" style="font-size: 0.85rem;">
                    <small style="color: #94a3b8; display: block; margin-top: 0.3rem;">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                </div>

                <button type="submit" class="btn btn-accent btn-lg" style="width: 100%;">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Testimoni Saya
                </button>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function setRating(val) {
        document.getElementById('ratingInput').value = val;
        for (let i = 1; i <= 5; i++) {
            document.getElementById('star' + i).parentElement.style.color = i <= val ? '#f59e0b' : '#cbd5e1';
        }
    }
    // Init rating from old value
    document.addEventListener('DOMContentLoaded', function() {
        setRating(parseInt(document.getElementById('ratingInput').value) || 5);
    });
</script>
@endpush
@endsection
