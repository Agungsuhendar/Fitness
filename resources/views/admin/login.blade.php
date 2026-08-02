<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Les Renang Jogja</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            border-radius: 1.75rem;
            padding: 2.75rem 2.25rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%); border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; color: white; font-size: 2rem; margin-bottom: 1rem; box-shadow: 0 10px 25px rgba(0, 119, 182, 0.35);">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h1 style="font-size: 1.8rem; margin-bottom: 0.25rem;">Admin Panel</h1>
            <p style="color: var(--text-muted); font-size: 0.925rem;">Kelola Konten & Data Pendaftaran Les Renang Jogja</p>
        </div>

        @if($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 700; font-size: 0.875rem; margin-bottom: 1.35rem;">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email Admin</label>
                <input type="email" name="email" class="form-control" placeholder="admin@lesrenangjogja.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group" style="margin-bottom: 1.75rem;">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 99px;">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk Ke Dashboard
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.75rem;">
            <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.875rem; font-weight: 700;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>
</body>
</html>
