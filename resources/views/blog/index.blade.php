@extends('layouts.app')

@section('title', 'Blog & Tips Fitness, Nutrisi & Fat Loss | FitLife Center Yogyakarta')
@section('meta_description', 'Artikel edukasi sains fitness dari Personal Trainer profesional seputar fat loss, pembentukan otot, manajemen nutrisi, & persiapan tes fisik di FitLife Center Jogja.')

@section('content')
<!-- Blog Hero Banner -->
<section style="padding: 4rem 0 3rem; background: linear-gradient(180deg, #060907 0%, #0d1310 100%); color: white; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(132, 204, 22, 0.12); border: 1px solid var(--brand-primary, #84cc16); color: var(--brand-primary, #84cc16); padding: 0.4rem 1.1rem; border-radius: 99px; font-weight: 800; font-size: 0.85rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-newspaper"></i>
                <span>Edukasi &amp; Sains Fitness Terbaru</span>
            </div>

            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 0.75rem; font-family: 'Outfit', sans-serif; letter-spacing: -0.02em; color: #ffffff;">
                Blog &amp; <span style="color: var(--brand-primary, #84cc16);">Tips Fitness</span>
            </h1>
            <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2rem;">
                Panduan praktis dari Personal Trainer terlisensi APKI seputar fat loss, hipertrofi otot, tips nutrisi lokal Jogja, &amp; persiapan tes fisik TNI-POLRI.
            </p>

            <!-- Real-time Search Bar -->
            <div style="max-width: 550px; margin: 0 auto; position: relative;">
                <input type="text" id="blogSearchInput" placeholder="Cari artikel (contoh: Fat Loss, Protein, Squat, TNI)..." value="{{ request('search') }}" style="width: 100%; background: #0d1310; border: 1.5px solid var(--brand-primary, #84cc16); padding: 0.95rem 1.25rem 0.95rem 3.1rem; border-radius: 99px; color: white; font-size: 0.95rem; outline: none; font-weight: 700; box-shadow: 0 10px 30px rgba(0,0,0,0.6);" onkeyup="filterBlogPostsLive()" onfocus="this.style.borderColor='var(--brand-primary, #84cc16)'" onblur="this.style.borderColor='var(--brand-primary, #84cc16)'">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: var(--brand-primary, #84cc16); font-size: 1.1rem;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Category Filter Pills Bar -->
<section style="padding: 1.5rem 0; background: #090d0b; border-bottom: 1px solid rgba(255,255,255,0.08); sticky: top; z-index: 10;">
    <div class="container">
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; align-items: center;">
            <a href="{{ route('blog.index') }}" class="btn btn-sm" style="background: {{ !request('category') ? 'var(--brand-primary, #84cc16)' : 'rgba(255,255,255,0.05)' }}; color: {{ !request('category') ? '#ffffff !important' : '#cbd5e1' }}; border: 1.5px solid {{ !request('category') ? 'var(--brand-primary, #84cc16)' : 'rgba(255,255,255,0.12)' }}; padding: 0.55rem 1.25rem; border-radius: 99px; font-weight: 800; text-decoration: none; transition: all 0.2s;">
                🌟 Semua Artikel
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat]) }}" class="btn btn-sm" style="background: {{ request('category') == $cat ? 'var(--brand-primary, #84cc16)' : 'rgba(255,255,255,0.05)' }}; color: {{ request('category') == $cat ? '#ffffff !important' : '#cbd5e1' }}; border: 1.5px solid {{ request('category') == $cat ? 'var(--brand-primary, #84cc16)' : 'rgba(255,255,255,0.12)' }}; padding: 0.55rem 1.25rem; border-radius: 99px; font-weight: 800; text-decoration: none; transition: all 0.2s;">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Blog Post Grid Section -->
<section style="background: #060907; padding: 4.5rem 0 6rem; color: white;">
    <div class="container">
        
        <div id="blogGridContainer" class="grid-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @foreach($posts as $post)
            <div class="blog-card-item" data-title="{{ strtolower($post->title) }}" data-category="{{ strtolower($post->category) }}" data-excerpt="{{ strtolower($post->excerpt) }}" style="overflow: hidden; background: #0d1310; border: 1.5px solid rgba(255,255,255,0.1); border-radius: 1.5rem; display: flex; flex-direction: column; transition: transform 0.3s ease, border-color 0.3s ease;" onmouseover="this.style.transform='translateY(-6px)'; this.style.borderColor='var(--brand-primary, #84cc16)';" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(255,255,255,0.1)';">
                
                <div style="height: 200px; overflow: hidden; background: #1e293b; position: relative;">
                    <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=800';">
                    <div style="position: absolute; top: 1rem; left: 1rem; background: rgba(9, 13, 11, 0.85); backdrop-filter: blur(8px); border: 1px solid var(--brand-primary, #84cc16); color: var(--brand-primary, #84cc16); font-size: 0.7rem; font-weight: 900; padding: 0.35rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                        {{ $post->category }}
                    </div>
                </div>

                <div style="padding: 1.65rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.775rem; font-weight: 700; color: #94a3b8; margin-bottom: 0.65rem; display: flex; align-items: center; justify-content: space-between;">
                        <span><i class="fa-solid fa-user-pen" style="color: var(--brand-primary, #84cc16);"></i> Coach FitLife</span>
                        <span><i class="fa-regular fa-clock" style="color: var(--brand-primary, #84cc16);"></i> {{ $post->reading_time }} Menit Baca</span>
                    </div>

                    <h2 style="font-size: 1.25rem; margin-bottom: 0.85rem; line-height: 1.4; color: #ffffff; font-weight: 900; font-family: 'Outfit', sans-serif;">
                        <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none; color: #ffffff; transition: color 0.2s;" onmouseover="this.style.color='var(--brand-primary, #84cc16)'" onmouseout="this.style.color='#ffffff'">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
                        {{ Str::limit($post->excerpt, 110) }}
                    </p>

                    <a href="{{ route('blog.show', $post->slug) }}" style="font-weight: 900; color: var(--brand-primary, #84cc16); text-decoration: none; font-size: 0.9rem; margin-top: auto; display: inline-flex; align-items: center; gap: 0.4rem;">
                        <span>Baca Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No Results Fallback -->
        <div id="noBlogResults" style="display: none; text-align: center; padding: 4rem 1rem; background: #0d1310; border: 1px dashed rgba(255,255,255,0.15); border-radius: 1.5rem;">
            <div style="font-size: 3rem; color: var(--brand-primary, #84cc16); margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.5rem; font-weight: 900; color: white; margin-bottom: 0.5rem;">Artikel Tidak Ditemukan</h3>
            <p style="color: #94a3b8; font-size: 0.95rem;">Coba gunakan kata kunci lain seperti <strong>Fat Loss</strong>, <strong>Protein</strong>, atau <strong>Squat</strong>.</p>
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    </div>
</section>

<script>
    function filterBlogPostsLive() {
        const query = document.getElementById('blogSearchInput').value.toLowerCase().trim();
        const items = document.querySelectorAll('.blog-card-item');
        let visibleCount = 0;

        items.forEach(item => {
            const title = item.getAttribute('data-title') || '';
            const category = item.getAttribute('data-category') || '';
            const excerpt = item.getAttribute('data-excerpt') || '';

            if (title.includes(query) || category.includes(query) || excerpt.includes(query)) {
                item.style.display = 'flex';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        const noRes = document.getElementById('noBlogResults');
        if (noRes) {
            noRes.style.display = (visibleCount === 0 && query !== '') ? 'block' : 'none';
        }
    }
</script>
@endsection
