@extends('admin.layout')

@section('title', 'Kelola FAQ - Admin Panel')
@section('header_title', 'Kelola 20+ Pertanyaan & Jawaban FAQ')

@section('admin_content')
<div class="admin-card" style="padding: 1.75rem 2rem; margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
        <div>
            <h2 style="font-size: 1.35rem; color: #ffffff; margin: 0; font-weight: 900; font-family: 'Outfit', sans-serif;">
                <i class="fa-solid fa-circle-question" style="color: var(--brand-lime, #84cc16); margin-right: 0.5rem;"></i>
                Daftar FAQ (Total {{ $faqs->count() }} Pertanyaan)
            </h2>
            <p style="color: #cbd5e1; font-size: 0.875rem; margin-top: 0.35rem;">Kelola daftar pertanyaan umum dan jawaban resmi yang tampil pada website.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm" style="border-radius: 0.75rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); padding: 0.65rem 1.35rem; font-weight: 700; border: none;">
            <i class="fa-solid fa-plus"></i> Tambah FAQ Baru
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width: 60px;">No</th>
                <th>Kategori</th>
                <th>Pertanyaan</th>
                <th>Jawaban (Preview)</th>
                <th>Populer?</th>
                <th style="text-align: right; padding-right: 1.5rem;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($faqs as $index => $faq)
            <tr>
                <td style="font-weight: 700; color: #64748b;">{{ $index + 1 }}</td>
                <td>
                    <span style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">
                        {{ $faq->category }}
                    </span>
                </td>
                <td style="font-weight: 800; color: #ffffff; max-width: 250px;">{{ $faq->question }}</td>
                <td style="font-size: 0.875rem; color: #64748b; max-width: 340px;">{{ Str::limit(strip_tags($faq->answer), 85) }}</td>
                <td>
                    @if($faq->is_popular)
                        <span style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 0.35rem 0.75rem; border-radius: 99px; font-weight: 800; font-size: 0.75rem;">
                            <i class="fa-solid fa-circle-check"></i> Populer
                        </span>
                    @else
                        <span style="color: #94a3b8;">-</span>
                    @endif
                </td>
                <td style="text-align: right; padding-right: 1.5rem;">
                    <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-outline btn-sm" style="padding: 0.45rem 0.85rem; border-radius: 0.65rem; border-color: #0284c7; color: #0284c7; font-weight: 700;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" style="padding: 0.45rem 0.85rem; border-radius: 0.65rem; border-color: #ef4444; color: #ef4444; background: #fff5f5; font-weight: 700;">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #64748b; padding: 3rem;">Belum ada pertanyaan FAQ.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
