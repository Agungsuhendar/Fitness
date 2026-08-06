@extends('layouts.app')

@section('title', 'Masuk Member | FitLife Center Jogja')
@section('meta_description', 'Halaman Login khusus member FitLife Center Jogja. Akses kuota sesi personal trainer, jadwal latihan, dan progres statistik Anda.')

@section('content')
<section style="min-height: 85vh; padding: 7rem 1rem 4rem; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; background: radial-gradient(circle at 50% 20%, rgba(132, 204, 22, 0.08) 0%, rgba(10, 15, 13, 0.98) 70%);">
    
    <!-- Decorative Ambient Glow -->
    <div style="position: absolute; top: -100px; left: 50%; transform: translateX(-50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(132, 204, 22, 0.15) 0%, rgba(0,0,0,0) 70%); filter: blur(60px); pointer-events: none;"></div>

    <div class="container" style="max-width: 480px; width: 100%; position: relative; z-index: 2;">
        
        <div style="background: rgba(13, 19, 16, 0.92); backdrop-filter: blur(20px); border: 1.5px solid rgba(132, 204, 22, 0.3); border-radius: 1.5rem; padding: 2.5rem 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9), 0 0 30px rgba(132, 204, 22, 0.15);">
            
            <!-- Card Header -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <div style="width: 64px; height: 64px; background: rgba(132, 204, 22, 0.15); border: 2px solid #84cc16; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem; box-shadow: 0 0 20px rgba(132, 204, 22, 0.3);">
                    <i class="fa-solid fa-user-lock" style="font-size: 1.75rem; color: #84cc16;"></i>
                </div>
                <h1 style="font-size: 1.75rem; font-weight: 900; color: #ffffff; margin: 0 0 0.5rem; letter-spacing: -0.02em;">Portal Member FitLife</h1>
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">Masukkan Email / No. WhatsApp dan Password Anda</p>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); border-radius: 0.85rem; padding: 0.85rem 1rem; margin-bottom: 1.5rem; color: #fca5a5; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; font-weight: 700; margin-bottom: 0.25rem;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Gagal Masuk:</span>
                    </div>
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div style="background: rgba(132, 204, 22, 0.15); border: 1px solid rgba(132, 204, 22, 0.4); border-radius: 0.85rem; padding: 0.85rem 1rem; margin-bottom: 1.5rem; color: #bef264; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                @csrf

                <!-- Input Login (Email or Phone) -->
                <div>
                    <label for="login" style="display: block; font-size: 0.85rem; font-weight: 700; color: #cbd5e1; margin-bottom: 0.5rem;">
                        Email atau Nomor WhatsApp
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus
                            placeholder="contoh: member@fitlife.com atau 08123456789"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label for="password" style="font-size: 0.85rem; font-weight: 700; color: #cbd5e1;">
                            Password
                        </label>
                        <a href="https://wa.me/{{ site_setting('whatsapp_number', '6281234567890') }}?text=Halo%20Admin,%20saya%20lupa%20password%20akun%20member%20FitLife" target="_blank" style="font-size: 0.8rem; color: #84cc16; text-decoration: none; font-weight: 600;">
                            Lupa Password?
                        </a>
                    </div>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #84cc16;">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                            placeholder="••••••••"
                            style="width: 100%; background: rgba(255, 255, 255, 0.05); border: 1.5px solid rgba(255, 255, 255, 0.15); border-radius: 0.85rem; padding: 0.85rem 1rem 0.85rem 2.75rem; color: #ffffff; font-size: 0.95rem; outline: none; transition: all 0.25s ease;"
                            onfocus="this.style.borderColor='#84cc16'; this.style.boxShadow='0 0 15px rgba(132,204,22,0.3)';"
                            onblur="this.style.borderColor='rgba(255, 255, 255, 0.15)'; this.style.boxShadow='none';">
                    </div>
                </div>

                <!-- Remember Me Checkbox -->
                <div style="display: flex; align-items: center; gap: 0.6rem;">
                    <input type="checkbox" id="remember" name="remember" style="accent-color: #84cc16; width: 18px; height: 18px; cursor: pointer;">
                    <label for="remember" style="font-size: 0.85rem; color: #94a3b8; cursor: pointer; user-select: none;">
                        Ingat Saya di Perangkat Ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" style="width: 100%; background: #84cc16; color: #090d0b; border: none; padding: 0.9rem; border-radius: 0.85rem; font-size: 1rem; font-weight: 900; cursor: pointer; transition: all 0.25s ease; box-shadow: 0 0 20px rgba(132, 204, 22, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 0.5rem;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 30px rgba(132, 204, 22, 0.6)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 20px rgba(132, 204, 22, 0.4)';">
                    <span style="color: #ffffff !important;">Masuk ke Dashboard</span>
                    <i class="fa-solid fa-arrow-right-to-bracket" style="color: #ffffff !important;"></i>
                </button>

            </form>

            <!-- Register Footer Link -->
            <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <p style="color: #94a3b8; font-size: 0.9rem; margin: 0;">
                    Belum punya akun member? 
                    <a href="{{ route('register') }}" style="color: #84cc16; font-weight: 800; text-decoration: none;">
                        Daftar Akun Baru
                    </a>
                </p>
            </div>

        </div>

    </div>
</section>
@endsection
