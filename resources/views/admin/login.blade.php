<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Les Renang Jogja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #03045e 0%, #0077b6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 440px;
            border-radius: 1.75rem;
            padding: 2.75rem 2.25rem;
            box-shadow: 0 25px 50px -12px rgba(3, 4, 94, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="margin-bottom: 1.25rem;">
                <img src="{{ asset('images/logo.webp') }}" alt="Les Renang Jogja Logo" style="height: 64px; width: auto; object-fit: contain; border-radius: 10px;">
            </div>
            <h1 style="font-size: 1.65rem; color: #0f172a; margin-bottom: 0.25rem; font-weight: 900;">Admin Panel Login</h1>
            <p style="color: #64748b; font-size: 0.875rem;">Kelola Konten & Lead Pendaftaran Les Renang Jogja</p>
        </div>

        @if($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.85rem 1rem; border-radius: 0.75rem; font-weight: 700; font-size: 0.875rem; margin-bottom: 1.35rem;">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" style="color: #334155;">Email Admin</label>
                <input type="email" name="email" class="form-control" placeholder="admin@lesrenangjogja.com" value="{{ old('email') }}" required autofocus style="border-radius: 0.75rem; padding: 0.85rem 1.15rem;">
            </div>

            <div class="form-group" style="margin-bottom: 1.75rem;">
                <label class="form-label" style="color: #334155;">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required style="border-radius: 0.75rem; padding: 0.85rem 1.15rem;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 0.85rem; background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); padding: 0.9rem; font-weight: 800; font-size: 1rem; box-shadow: 0 4px 14px rgba(0, 180, 216, 0.35); border: none;">
                <i class="fa-solid fa-right-to-bracket" style="margin-right: 0.4rem;"></i> Masuk Ke Dashboard
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.75rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9;">
            <a href="{{ route('home') }}" style="color: #0284c7; text-decoration: none; font-size: 0.875rem; font-weight: 700;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>
</body>
</html>
