@extends('layouts.app')

@section('title', 'Daftar Akun Member | FitLife Center Jogja')
@section('meta_description', 'Pendaftaran akun baru member FitLife Center Jogja. Dapatkan akses ke dashboard member, jadwal personal trainer, dan statistik kebugaran Anda.')

@section('content')
<section style="min-height: 85vh; padding: 7rem 1rem 4rem; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; background: radial-gradient(circle at 50% 20%, rgba(132, 204, 22, 0.08) 0%, rgba(10, 15, 13, 0.98) 70%);">
    
    <!-- Decorative Ambient Glow -->
    <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(132, 204, 22, 0.15) 0%, rgba(0,0,0,0) 70%); filter: blur(60px); pointer-events: none;"></div>

    <div class="container" style="max-width: 520px; width: 100%; position: relative; z-index: 2;">
        
        <div style="background: rgba(13, 19, 16, 0.92); backdrop-filter: blur(20px); border: 1.5px solid rgba(132, 204, 22, 0.3); border-radius: 1.5rem; padding: 2.5rem 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9), 0 0 30px rgba(132, 204, 22, 0.15);">
            
            <!-- Card Header -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 64px; height: 64px; background: rgba(132, 204, 22, 0.15); border: 2px solid #84cc16; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                    <i class="fa-solid fa-user-plus" style="font-size: 1.75rem; color: #84cc16;"></i>
                </div>
                <h1 style="font-size: 1.75rem; font-weight: 900; color: #ffffff; margin: 0 0 0.5rem; letter-spacing: -0.02em;">Buat Akun Member Baru</h1>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">Lengkapi data diri Anda untuk membuka akses Dashboard Member FitLife</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 0.85rem; padding: 0.85rem 1rem; margin-bottom: 1.5rem; color: #fca5a5; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 700; margin-bottom: 0.25rem;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Pendaftaran Belum Lengkap:</span>
                    </div>
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Nama Lengkap
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="contoh: Bima Perkasa"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Alamat Email
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Nomor WhatsApp -->
                <div>
                    <label for="phone" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Nomor WhatsApp Aktif
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </span>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                            placeholder="081234567890"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Program Target Pilihan -->
                <div>
                    <label for="program_name" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Program Fitness Pilihan
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-dumbbell"></i>
                        </span>
                        <select id="program_name" name="program_name"
                            style="width: 100%; background: rgba(13, 19, 16, 0.95); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)';">
                            <option value="VIP Personal Trainer Pass 1-on-1">VIP Personal Trainer Pass 1-on-1</option>
                            <option value="Weight Loss & Fat Burn Transformation">Weight Loss & Fat Burn Transformation</option>
                            <option value="Muscle Hypertrophy & Bodybuilding">Muscle Hypertrophy & Bodybuilding</option>
                            <option value="Les Renang Anak & Dewasa (Private)">Les Renang Anak & Dewasa (Private)</option>
                            <option value="Persiapan Tes TNI POLRI & Kedinasan">Persiapan Tes TNI POLRI & Kedinasan</option>
                        </select>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Password (Min 6 Karakter)
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                            placeholder="••••••••"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Ulangi Password
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            placeholder="••••••••"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.9rem; border-radius: 0.85rem; font-size: 1rem; font-weight: 900; cursor: pointer; transition: all 0.25s ease; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 30px rgba(132, 204, 22, 0.6)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 20px rgba(132, 204, 22, 0.4)';">
                    <span style="color: #ffffff !important;">Daftar Sekarang</span>
                    <i class="fa-solid fa-arrow-right" style="color: #ffffff !important;"></i>
                </button>

            </form>

            <!-- Login Footer Link -->
            <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Sudah memiliki akun member? 
                    <a href="{{ route('login') }}" style="color: #84cc16; font-weight: 800; text-decoration: none;">
                        Masuk ke Akun Anda
                    </a>
                </p>
            </div>

        </div>

    </div>
</section>
@endsection
