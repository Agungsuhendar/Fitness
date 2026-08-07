<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin &amp; Staff - FitLife Gym Jogja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * { box-sizing: border-box; }
        body {
            background-color: #060907;
            background-image: radial-gradient(circle at 10% 20%, rgba(132, 204, 22, 0.12) 0%, transparent 50%),
                              radial-gradient(circle at 90% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                              linear-gradient(180deg, #060907 0%, #0c140f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        .login-card {
            background: rgba(13, 20, 16, 0.9);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            width: 100%;
            max-width: 450px;
            border-radius: 1.75rem;
            padding: 3rem 2.5rem;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.8), 0 0 40px rgba(132, 204, 22, 0.15);
            border: 1px solid rgba(132, 204, 22, 0.25);
            position: relative;
        }
        .form-control-dark {
            width: 100%;
            background: #080d0a !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            padding: 0.85rem 1.15rem !important;
            border-radius: 0.85rem !important;
            font-weight: 700 !important;
            font-size: 0.95rem !important;
            transition: all 0.25s ease !important;
        }
        .form-control-dark:focus {
            border-color: #84cc16 !important;
            box-shadow: 0 0 20px rgba(132, 204, 22, 0.3) !important;
            outline: none !important;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 2.25rem;">
            <div style="margin-bottom: 1.25rem; display: flex; justify-content: center; align-items: center;">
                @php $loginLogoUrl = site_setting('site_logo', 'images/logo.png'); @endphp
                <img src="{{ Str::startsWith($loginLogoUrl, 'http') ? $loginLogoUrl : asset($loginLogoUrl) }}" alt="FitLife Admin Logo" style="height: 64px; width: auto; object-fit: contain; filter: drop-shadow(0 0 15px rgba(132, 204, 22, 0.4));">
            </div>
            <div style="display: inline-flex; align-items: center; gap: 0.4rem; background: rgba(132, 204, 22, 0.15); padding: 0.25rem 0.85rem; border-radius: 99px; border: 1px solid rgba(132, 204, 22, 0.3); color: #84cc16; font-size: 0.75rem; font-weight: 800; margin-bottom: 0.65rem;">
                <i class="fa-solid fa-user-shield"></i> OFFICIAL OPERATIONAL PORTAL
            </div>
            <h1 style="font-family: 'Outfit', sans-serif; font-size: 1.85rem; color: #ffffff; margin: 0 0 0.35rem 0; font-weight: 900; letter-spacing: -0.02em;">Admin &amp; Staff Login</h1>
            <p style="color: #94a3b8; font-size: 0.875rem; margin: 0;">Panel Akses Terbuka untuk Owner, Resepsionis &amp; Trainer</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(244, 63, 94, 0.15); border: 1.5px solid #f43f5e; color: #f43f5e; padding: 0.85rem 1rem; border-radius: 0.85rem; font-weight: 800; font-size: 0.85rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.25rem;">
                <label style="color: #cbd5e1; font-weight: 800; font-size: 0.85rem; display: block; margin-bottom: 0.45rem;">Email Staf / Admin</label>
                <input type="email" name="email" class="form-control-dark" placeholder="admin@lesrenangjogja.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div style="margin-bottom: 1.85rem;">
                <label style="color: #cbd5e1; font-weight: 800; font-size: 0.85rem; display: block; margin-bottom: 0.45rem;">Password</label>
                <input type="password" name="password" class="form-control-dark" placeholder="••••••••" required>
            </div>

            <button type="submit" style="width: 100%; border-radius: 0.85rem; background: linear-gradient(135deg, #84cc16 0%, #10b981 100%); padding: 0.95rem; font-weight: 900; font-size: 1rem; color: #060907; border: none; cursor: pointer; box-shadow: 0 0 25px rgba(132, 204, 22, 0.4); display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-family: 'Outfit', sans-serif;">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk Ke Dashboard Operations
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.35rem; border-top: 1px solid rgba(255, 255, 255, 0.08);">
            <a href="{{ route('home') }}" style="color: #84cc16; text-decoration: none; font-size: 0.875rem; font-weight: 800; display: inline-flex; align-items: center; gap: 0.4rem;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>
</body>
</html>
