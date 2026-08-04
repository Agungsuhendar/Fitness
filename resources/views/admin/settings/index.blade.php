@extends('admin.layout')

@section('title', 'Pengaturan Website - Admin Panel Les Renang Jogja')
@section('header_title', 'Pengaturan Website & Kontak')

@section('admin_content')
<div style="max-width: 960px;">
    @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 0.85rem; font-weight: 700; margin-bottom: 1.75rem; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card" style="padding: 2.25rem 2rem;">
        <div style="margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.15rem;">
            <h3 style="font-size: 1.35rem; color: #0f172a; margin-bottom: 0.35rem;">
                <i class="fa-solid fa-sliders" style="color: #0284c7; margin-right: 0.45rem;"></i> Pengaturan Kontak & Informasi Resmi
            </h3>
            <p style="color: #64748b; font-size: 0.925rem;">
                Kelola nomor WhatsApp admin, email, alamat kantor, dan tautan sosial media resmi secara terpusat.
            </p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <!-- Section 1: Kontak Utama -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-brands fa-whatsapp" style="color: #25d366;"></i> WhatsApp & Kontak Telepon
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Nomor WhatsApp Admin (Format 62...):
                        </label>
                        <input type="text" name="whatsapp_number" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="Contoh: 6281234567890" required>
                        <small style="color: #64748b; font-size: 0.78rem; display: block; margin-top: 0.35rem;">
                            Format internasional tanpa tanda + (contoh: 6281234567890)
                        </small>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Telepon Display (Teks Tampilan):
                        </label>
                        <input type="text" name="site_phone" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('site_phone', $settings['site_phone']) }}" placeholder="Contoh: +62 812-3456-7890">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Pesan Default WhatsApp Chat:
                    </label>
                    <input type="text" name="whatsapp_message" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('whatsapp_message', $settings['whatsapp_message']) }}" placeholder="Contoh: Halo Admin Les Renang Jogja...">
                </div>
            </div>

            <!-- Section 2: Alamat & Jam Operasional -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-building-user" style="color: #0284c7;"></i> Email, Alamat & Jam Operasional
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Email Resmi Website:
                        </label>
                        <input type="email" name="site_email" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('site_email', $settings['site_email']) }}" required>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            Jam Operasional:
                        </label>
                        <input type="text" name="office_hours" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('office_hours', $settings['office_hours']) }}">
                    </div>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                        Alamat Kantor Head Office:
                    </label>
                    <input type="text" name="office_address" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('office_address', $settings['office_address']) }}">
                </div>
            </div>

            <!-- Section 3: Link Sosial Media -->
            <div style="margin-bottom: 2.25rem;">
                <h4 style="font-size: 1.1rem; color: #03045e; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-share-nodes" style="color: #f59e0b;"></i> Link Akun Sosial Media Resmi
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem;">
                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-instagram" style="color: #e1306c;"></i> Link Instagram:
                        </label>
                        <input type="url" name="instagram_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('instagram_url', $settings['instagram_url']) }}" placeholder="https://instagram.com/lesrenangjogja">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-tiktok" style="color: #000000;"></i> Link TikTok:
                        </label>
                        <input type="url" name="tiktok_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('tiktok_url', $settings['tiktok_url']) }}" placeholder="https://tiktok.com/@lesrenangjogja">
                    </div>

                    <div>
                        <label style="display: block; font-weight: 800; font-size: 0.875rem; color: #334155; margin-bottom: 0.45rem;">
                            <i class="fa-brands fa-youtube" style="color: #ff0000;"></i> Link YouTube:
                        </label>
                        <input type="url" name="youtube_url" class="search-input" style="width: 100%; border: 1px solid #cbd5e1;" value="{{ old('youtube_url', $settings['youtube_url']) }}" placeholder="https://youtube.com/@lesrenangjogja">
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan Website
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
