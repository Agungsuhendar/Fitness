<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Location;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Testimonial;

class LesRenangSeeder extends Seeder
{
    public function run(): void
    {
        // 0. ADMIN USER
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@lesrenangjogja.com'],
            [
                'name' => 'Admin Les Renang Jogja',
                'email' => 'admin@lesrenangjogja.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );
        // 1. PROGRAMS (Real Unsplash High-Res Aquatic Photos)
        $programs = [
            [
                'slug' => 'les-renang-anak',
                'title' => 'Les Renang Anak (Usia 3–15 Tahun)',
                'subtitle' => 'Metode ramah anak, menyenangkan, cepat bisa, & berstandar keselamatan tinggi.',
                'target_audience' => 'Orang tua yang ingin anaknya mahir renang & percaya diri',
                'description' => 'Program privat & semi privat khusus anak-anak usia 3 hingga 15 tahun. Pelatih kami sangat sabar, tersertifikasi PRSI, dan menggunakan metode fun learning tanpa rasa takut.',
                'features' => [
                    'Metode pelathan Water Confidence & Fun Learning',
                    'Rasio 1 Pelatih : 1–2 Anak (Privat Khusus)',
                    'Garansi anak berani air & bisa gaya dada/bebas',
                    'Jadwal fleksibel menyesuaikan sekolah anak',
                    'Sertifikat kelulusan & penilaian progress'
                ],
                'benefits' => [
                    'Melatih keberanian & kemandirian anak sejak dini',
                    'Meningkatkan metabolisme, tinggi badan & daya tahan tubuh',
                    'Mengurangi ketergantungan pada gadget',
                    'Keterampilan keselamatan diri (Water Safety)'
                ],
                'curriculum' => [
                    'Pertemuan 1-2: Adaptasi Air, Water Breathing & Floating',
                    'Pertemuan 3-5: Gliding, Kicking Technique & Gaya Dada (Katak)',
                    'Pertemuan 6-8: Gaya Bebas (Freestyle) & Pengambilan Napas',
                    'Pertemuan 9-10: Kombinasi Gaya, Water Treading (Mengapung) & Water Safety'
                ],
                'price_start' => 350000,
                'icon' => 'child',
                'image' => 'images/assets/program_anak.webp',
                'badge' => 'Paling Populer',
                'order' => 1,
            ],
            [
                'slug' => 'les-renang-dewasa',
                'title' => 'Les Renang Dewasa Pemula',
                'subtitle' => 'Hilangkan trauma air & kuasai teknik renang dengan cepat & nyaman.',
                'target_audience' => 'Dewasa (16+ tahun) yang trauma air atau ingin belajar dari nol',
                'description' => 'Program privat khusus dewasa yang belum pernah bisa renang atau memiliki trauma masa kecil. Bimbingan privat 1-on-1 dengan teknik efisien & suasana tenang.',
                'features' => [
                    'Privat 1-on-1 privasi terjamin',
                    'Pendekatan mengatasi Aquaphobia / Trauma Air',
                    'Penguasaan Gaya Dada, Gaya Bebas, & Injak Air',
                    'Pilihan kolam tenang & tidak terlalu ramai',
                    'Garansi 4-8 kali pertemuan pasti bisa mengapung & meluncur'
                ],
                'benefits' => [
                    'Olah raga low-impact aman untuk sendi & punggung',
                    'Meningkatkan kesehatan jantung & kapasitas paru-paru',
                    'Menghilangkan stres kerja & membakar kalori secara maksimal'
                ],
                'curriculum' => [
                    'Sesi 1: Penanganan Trauma & Teknik Bernapas Efisien',
                    'Sesi 2-4: Posisi Streamline Body & Gaya Dada',
                    'Sesi 5-7: Gaya Bebas & Rotasi Bahu',
                    'Sesi 8: Mengapung Diam (Treading Water) di Kolam Dalam'
                ],
                'price_start' => 400000,
                'icon' => 'user-check',
                'image' => 'images/assets/program_dewasa.webp',
                'badge' => 'Rekomendasi Pemula',
                'order' => 2,
            ],
            [
                'slug' => 'les-renang-wanita',
                'title' => 'Les Renang Khusus Wanita / Muslimah',
                'subtitle' => 'Pelatih wanita berpengalaman, kolam privat, & privasi 100% terjaga.',
                'target_audience' => 'Wanita / Muslimah yang menginginkan instruktur wanita & area privat',
                'description' => 'Program eksklusif untuk wanita yang ingin belajar renang dengan nyaman. Dilatih langsung oleh instruktur wanita profesional di lokasi kolam privat yang aman.',
                'features' => [
                    '100% Pelatih Wanita Berlisensi & Sabar',
                    'Pilihan kolam privat khusus wanita (Indoor / Semi-Indoor)',
                    'Waktu & tempat latihan fleksibel',
                    'Materi disesuaikan dengan kebutuhan fisik wanita'
                ],
                'benefits' => [
                    'Menjaga kebugaran & kelenturan tubuh',
                    'Privasi & rasa nyaman tanpa canggung',
                    'Membantu program penurunan berat badan & postur ideal'
                ],
                'curriculum' => [
                    'Tingkat Dasar: Penguasaan Pernapasan & Gaya Dada',
                    'Tingkat Menengah: Gaya Bebas & Gaya Punggung',
                    'Tingkat Lanjut: Stamina Swimming & Treading Water'
                ],
                'price_start' => 450000,
                'icon' => 'user-female',
                'image' => 'images/assets/program_wanita.webp',
                'badge' => '100% Instruktur Wanita',
                'order' => 3,
            ],
            [
                'slug' => 'persiapan-tni-polri',
                'title' => 'Program Persiapan Tes TNI, POLRI & Kedinasan',
                'subtitle' => 'Target waktu maksimal, teknik renang militer, & evaluasi skor standar tes.',
                'target_audience' => 'Calon Taruna/Akpol, Bintara, Tamtama, IPDN, STIN, Kemenhub',
                'description' => 'Program intesif untuk menghadapi tes renang seleksi TNI, POLRI, & Sekolah Kedinasan. Dipandu oleh instruktur spesialis fisik militer untuk mencapai jarak 50 meter dengan waktu tercepat.',
                'features' => [
                    'Simulasi tes resmi jarak 50 meter berwaktu',
                    'Pelatihan Gaya Dada Militer & Gaya Bebas Cepat',
                    'Teknik pernapasan daya tahan & efisiensi kayuhan',
                    'Analisis & koreksi video gerakan teknik',
                    'Modul latihan fisik pendukung (Core strength & lung capacity)'
                ],
                'benefits' => [
                    'Memastikan nilai tes renang memenuhi passing grade & nilai maksimal (100)',
                    'Meningkatkan rasa percaya diri saat menghadapi tim penguji',
                    'Penguasaan teknik renang yang efisien tanpa cepat lelah'
                ],
                'curriculum' => [
                    'Minggu 1: Diagnostic Test & Koreksi Teknik dasar 50m',
                    'Minggu 2-3: Penguatan Kayuhan Leg Power & Arm Push',
                    'Minggu 4-6: Drill Kecepatan (Sprint Interval 25m & 50m)',
                    'Minggu 7-8: Time Trial Simulation & Mental Readiness'
                ],
                'price_start' => 500000,
                'icon' => 'shield',
                'image' => 'images/assets/program_tni.webp',
                'badge' => 'Garansi Skor Target',
                'order' => 4,
            ],
            [
                'slug' => 'terapi-renang',
                'title' => 'Terapi Renang & Pemulihan Fisik',
                'subtitle' => 'Pemulihan skoliosis, sakit punggung, asma, & terapi pasca cedera.',
                'target_audience' => 'Individu dengan skoliosis, masalah HNP/saraf kejepit, asma, atau rehabilitasi',
                'description' => 'Program latihan air berorientasi kesehatan yang disesuaikan dengan kondisi medis peserta. Berfungsi mengurangi beban pada tulang belakang & melatih paru-paru.',
                'features' => [
                    'Bimbingan khusus berdasar saran medis / dokter',
                    'Gerakan gentle hydrotherapy & dekompresi tulang belakang',
                    'Latihan pernapasan terkontrol untuk penderita asma',
                    'Pendampingan erat selama di dalam air'
                ],
                'benefits' => [
                    'Meringankan nyeri punggung & memulihkan skoliosis',
                    'Mengurangi gejala sesak napas pada penderita asma',
                    'Mempercepat pemulihan otot & sendi'
                ],
                'curriculum' => [
                    'Fase 1: Water Decompression & Gentle Floating',
                    'Fase 2: Controlled Breathing & Spinal Alignment Drills',
                    'Fase 3: Low-Impact Stroke Swimming'
                ],
                'price_start' => 450000,
                'icon' => 'heart-pulse',
                'image' => 'images/assets/program_terapi.webp',
                'badge' => 'Rekomendasi Medis',
                'order' => 5,
            ],
            [
                'slug' => 'corporate-training',
                'title' => 'Corporate Training & Group Class',
                'subtitle' => 'Program kebugaran renang untuk instansi, perusahaan, & komunitas.',
                'target_audience' => 'Perusahaan, instansi pemerintah, sekolah, & komunitas',
                'description' => 'Paket pelatihan renang kelompok untuk perusahaan atau instansi yang ingin meningkatkan kebugaran tim, keselamatan air, & kegiatan kebersamaan.',
                'features' => [
                    'Instruktur tim profesional lengkap',
                    'Sertifikasi keselamatan air & First Aid',
                    'Jadwal & tempat dapat disesuaikan',
                    'Diskon khusus rombongan / grup'
                ],
                'benefits' => [
                    'Meningkatkan kesehatan karyawan & produktivitas kerja',
                    'Mempererat kebersamaan tim (Team Building)',
                    'Pembekalan tanggap darurat di air (Water Safety & Rescue)'
                ],
                'curriculum' => [
                    'Sesi 1: Basic Water Safety & Self Survival',
                    'Sesi 2-4: Stroke Swimming & Team Relay Challenge'
                ],
                'price_start' => 1200000,
                'icon' => 'users',
                'image' => 'images/assets/program_privat.webp',
                'badge' => 'Paket Hemat Rombongan',
                'order' => 6,
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 2. LOCATIONS
        $locations = [
            [
                'slug' => 'kolam-renang-fik-uny-sleman',
                'name' => 'Kolam Renang FIK UNY (Sleman, Jogja)',
                'city' => 'Yogyakarta (Sleman)',
                'address' => 'Jl. Colombo No.1, Karang Gayam, Caturtunggal, Kec. Depok, Kabupaten Sleman, D.I. Yogyakarta 55281',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.189569035177!2d110.3853112!3d-7.7702812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b20ab248bf%3A0xb3adacbfdf5d16e0!2sKolam%20Renang%20FIK%20UNY!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Standar Olahraga Internasional', 'Kolam Anak & Dewasa', 'Air Jernih Filter Berkala', 'Kantin & Parkir Luas'],
                'image' => 'images/assets/pool_uny.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'kolam-renang-depok-sport-center',
                'name' => 'Depok Sport Center (Seturan, Sleman)',
                'city' => 'Yogyakarta (Sleman)',
                'address' => 'Jl. Raya Seturan No.9, Kledokan, Caturtunggal, Depok, Sleman, DIY',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.076840788647!2d110.4074218!3d-7.7816828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5991c015b6cd%3A0xa193d56b02660144!2sDepok%20Sports%20Center!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Indoor Heated Pool', 'Ramah Wanita & Anak', 'Kamar Bilas Air Hangat', 'Lokasi Strategis Pusat Sleman'],
                'image' => 'images/assets/pool_depok.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'kolam-renang-umbulharjo-jogja',
                'name' => 'Kolam Renang Nabtir / Umbulharjo (Kota Jogja)',
                'city' => 'Yogyakarta (Kota)',
                'address' => 'Jl. Umbulharjo Raya No. 45, Kota Yogyakarta, DIY',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.923485747683!2d110.3888321!3d-7.8081298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a579bc4cb5443%3A0xbce5b93108c48a73!2sKota%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Akses Mudah Kota Jogja', 'Kolam Pendek Anak', 'Kedalaman Bertingkat', 'Buka Setiap Hari'],
                'image' => 'images/assets/pool_tirtasari.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'kolam-renang-hyatt-regency',
                'name' => 'Hyatt Regency Swimming Pool (Palagan, Sleman)',
                'city' => 'Yogyakarta (Privat)',
                'address' => 'Jl. Palagan Tentara Pelajar No.KM.7, Sariharjo, Ngaglik, Sleman, DIY',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.488349280963!2d110.3708491!3d-7.7378772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58e2fb8d0f1b%3A0x7d6f51950d856012!2sHyatt%20Regency%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Suasana Resort Bintang 5', 'Privasi Maksimal', 'Air Sangat Higienis', 'Cocok Privat Wanita & Anak'],
                'image' => 'images/assets/pool_ugm.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'area-semarang',
                'name' => 'Mitra Kolam Renang Semarang',
                'city' => 'Semarang',
                'address' => 'Jawa Tengah - Semarang Barat, Selatan & Tembalang',
                'map_embed_url' => '',
                'features' => ['Pelatih Privat Panggilan', 'Kolam Partner Semarang', 'Latihan Intensif'],
                'image' => 'images/assets/pool_uny.webp',
                'is_featured' => false,
            ],
            [
                'slug' => 'area-solo',
                'name' => 'Mitra Kolam Renang Solo / Surakarta',
                'city' => 'Solo',
                'address' => 'Jawa Tengah - Solo Kota, Manahan & Surakarta',
                'map_embed_url' => '',
                'features' => ['Instruktur Lokal Solo', 'Jadwal Fleksibel', 'Kolam Pendukung Manahan'],
                'image' => 'images/assets/pool_depok.webp',
                'is_featured' => false,
            ],
            [
                'slug' => 'area-magelang',
                'name' => 'Mitra Kolam Renang Magelang',
                'city' => 'Magelang',
                'address' => 'Jawa Tengah - Magelang Kota & Mertoyudan',
                'map_embed_url' => '',
                'features' => ['Persiapan Renang Taruna Akmil', 'Pelatih Teruji', 'Pendampingan Fisik'],
                'image' => 'images/assets/program_tni.webp',
                'is_featured' => false,
            ],
            [
                'slug' => 'area-klaten',
                'name' => 'Mitra Kolam Renang Klaten',
                'city' => 'Klaten',
                'address' => 'Jawa Tengah - Klaten Utara, Kota & Prambanan',
                'map_embed_url' => '',
                'features' => ['Kolam Rekreasi & Olahraga', 'Program Privat Anak & Dewasa'],
                'image' => 'images/assets/pool_tirtasari.webp',
                'is_featured' => false,
            ],
        ];

        foreach ($locations as $loc) {
            Location::updateOrCreate(['slug' => $loc['slug']], $loc);
        }

        // 3. FAQS (MINIMAL 20 ITEMS)
        $faqs = [
            [
                'category' => 'Umum',
                'question' => 'Mengapa harus memilih Les Renang Jogja?',
                'answer' => 'Les Renang Jogja didukung instruktur profesional tersertifikasi PRSI/POSSI dengan pengalaman lebih dari 10 tahun. Kami menawarkan metode ramah anak, garansi bisa renang, jadwal fleksibel, serta rasio privat 1 pelatih untuk 1-2 siswa.',
                'is_popular' => true,
                'order' => 1,
            ],
            [
                'category' => 'Umum',
                'question' => 'Berapa lama rata-rata waktu sampai peserta bisa berenang?',
                'answer' => 'Untuk anak-anak dan dewasa pemula tanpa trauma berat, biasanya sudah bisa mengapung dan meluncur dalam 3–4 kali pertemuan, serta menguasai 1 gaya renang (Gaya Dada) dalam 8–10 kali pertemuan.',
                'is_popular' => true,
                'order' => 2,
            ],
            [
                'category' => 'Umum',
                'question' => 'Apakah ada garansi sampai bisa renang?',
                'answer' => 'Ya! Kami memberikan garansi bimbingan tambahan bagi peserta privat yang mengambil paket reguler hingga mencapai kompetensi dasar (berani air, mengapung, meluncur, dan pernapasan dada).',
                'is_popular' => true,
                'order' => 3,
            ],
            [
                'category' => 'Umum',
                'question' => 'Berapa batasan usia peserta les renang?',
                'answer' => 'Kami melayani peserta mulai dari anak usia 3 tahun hingga dewasa usia 60+ tahun. Materi disesuaikan dengan tingkat usia dan kondisi fisik masing-masing.',
                'is_popular' => false,
                'order' => 4,
            ],
            [
                'category' => 'Umum',
                'question' => 'Apakah tempat latihan bisa ditentukan oleh peserta?',
                'answer' => 'Bisa. Peserta dapat memilih lokasi kolam renang partner kami di Jogja (UNY, Depok Sport Center, Umbulharjo, Hyatt, dll) atau kolam privat/perumahan milik peserta.',
                'is_popular' => false,
                'order' => 5,
            ],
            [
                'category' => 'Pendaftaran',
                'question' => 'Bagaimana cara mendaftar les renang?',
                'answer' => 'Pendaftaran sangat mudah! Anda cukup mengisi form online di website kami atau klik tombol WhatsApp untuk terhubung dengan Admin. Admin akan membantu memilihkan paket & jadwal terbaik.',
                'is_popular' => true,
                'order' => 6,
            ],
            [
                'category' => 'Pendaftaran',
                'question' => 'Apakah ada sesi Trial / Uji Coba Gratis?',
                'answer' => 'Ya, kami menyediakan sesi Trial Booking gratis selama 30 menit agar calon siswa dan orang tua dapat merasakan secara langsung kecocokan metode mengajar pelatih kami.',
                'is_popular' => true,
                'order' => 7,
            ],
            [
                'category' => 'Pendaftaran',
                'question' => 'Bagaimana jika saya harus ijin / ganti jadwal karena sakit atau keperluan lain?',
                'answer' => 'Jadwal latihan sangat fleksibel. Apabila berhalangan hadir, cukup beri tahu pelatih atau admin maksimal 6 jam sebelum sesi dimulai untuk dijadwalkan ulang (Reschedule) tanpa hangus.',
                'is_popular' => false,
                'order' => 8,
            ],
            [
                'category' => 'Pendaftaran',
                'question' => 'Jam berapa saja sesi les renang yang tersedia?',
                'answer' => 'Sesi tersedia setiap hari (Senin–Minggu) mulai jam 06.00 WIB pagi hingga jam 20.00 WIB malam.',
                'is_popular' => false,
                'order' => 9,
            ],
            [
                'category' => 'Pelatih',
                'question' => 'Apakah ada pelatih renang wanita khusus?',
                'answer' => 'Tentu ada. Kami memiliki tim instruktur wanita profesional khusus untuk siswa perempuan, anak-anak, atau muslimah yang menginginkan privasi penuh.',
                'is_popular' => true,
                'order' => 10,
            ],
            [
                'category' => 'Pelatih',
                'question' => 'Bagaimana kualifikasi dan latar belakang pelatih Les Renang Jogja?',
                'answer' => 'Semua pelatih kami merupakan lulusan Ilmu Keolahragaan/PJKR, memiliki lisensi PRSI/POSSI, sertifikat First Aid & Water Safety Lifeguard, serta ramah dan sabar.',
                'is_popular' => false,
                'order' => 11,
            ],
            [
                'category' => 'Pelatih',
                'question' => 'Apakah pelatih turun langsung ke dalam air saat mengajar?',
                'answer' => 'Ya, 100%! Pelatih selalu berada di dalam air mendampingi peserta secara intensif dari awal hingga akhir sesi demi keamanan dan efektivitas pembelajaran.',
                'is_popular' => false,
                'order' => 12,
            ],
            [
                'category' => 'Kolam & Safety',
                'question' => 'Bagaimana dengan tiket masuk kolam renang?',
                'answer' => 'Tiket masuk kolam untuk pelatih sudah ditanggung oleh lembaga. Tiket masuk peserta dibeli secara mandiri atau dapat dimasukkan ke dalam paket bundling khusus.',
                'is_popular' => false,
                'order' => 13,
            ],
            [
                'category' => 'Kolam & Safety',
                'question' => 'Bagaimana jika peserta memiliki rasa takut / trauma mendalam pada air?',
                'answer' => 'Kami berpengalaman menangani trauma air (aquaphobia). Metode kami diawali dengan relaksasi pernapasan, adaptasi kedalaman dangkal, dan pendekatan psikologis bertahap tanpa paksaan.',
                'is_popular' => true,
                'order' => 14,
            ],
            [
                'category' => 'Kolam & Safety',
                'question' => 'Peralatan apa saja yang perlu dibawa saat latihan?',
                'answer' => 'Peserta cukup membawa baju renang yang nyaman, kacamata renang, dan papan pelampung (jika ada). Kami juga menyediakan pelampung bantu selama sesi latihan.',
                'is_popular' => false,
                'order' => 15,
            ],
            [
                'category' => 'TNI/POLRI & Terapi',
                'question' => 'Bagaimana metode program khusus tes TNI / POLRI / Kedinasan?',
                'answer' => 'Fokus pada pencapaian target waktu tercepat 50m (Gaya Dada Militer & Gaya Bebas), ketahanan napas, serta simulasi penilaian riil sesuai petunjuk teknis seleksi tes kesamaptaan.',
                'is_popular' => true,
                'order' => 16,
            ],
            [
                'category' => 'TNI/POLRI & Terapi',
                'question' => 'Apakah program Terapi Renang aman untuk penderita Skoliosis & Saraf Kejepit (HNP)?',
                'answer' => 'Sangat aman dan sangat direkomendasikan dokter spesialis ortopedi karena olahraga air mengurangi beban gravitasi pada tulang belakang. Gerakan akan disesuaikan dengan kurikulum terapi medis.',
                'is_popular' => false,
                'order' => 17,
            ],
            [
                'category' => 'Pembayaran',
                'question' => 'Bagaimana sistem pembayaran les renang?',
                'answer' => 'Pembayaran dapat dilakukan secara tunai atau transfer bank / QRIS setelah sesi pertama atau saat konfirmasi pendaftaran paket.',
                'is_popular' => false,
                'order' => 18,
            ],
            [
                'category' => 'Pembayaran',
                'question' => 'Apakah ada potongan harga / promo untuk pendaftaran kakak-adik atau grup?',
                'answer' => 'Ada! Kami memberikan diskon khusus 10-20% untuk pendaftaran 2 peserta sekaligus (Kakak-Adik / Suami-Istri) atau paket grup keluarga.',
                'is_popular' => true,
                'order' => 19,
            ],
            [
                'category' => 'Pembayaran',
                'question' => 'Apakah paket pertemuan memiliki batas kadaluarsa waktu?',
                'answer' => 'Paket 8 kali pertemuan memiliki masa aktif fleksibel hingga 2 bulan, sehingga sangat aman jika Anda memiliki kesibukan atau liburan.',
                'is_popular' => false,
                'order' => 20,
            ],
            [
                'category' => 'Umum',
                'question' => 'Apakah Les Renang Jogja juga melayani luar area kota Yogyakarta?',
                'answer' => 'Ya, kami melayani seluruh wilayah DIY (Sleman, Bantul, Kota, Kulon Progo) serta kota sekitarnya seperti Semarang, Solo, Magelang, dan Klaten untuk sistem privat panggilan.',
                'is_popular' => false,
                'order' => 21,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        // 4. TESTIMONIALS
        $testimonials = [
            [
                'name' => 'Ibu Ratna Dewi & Kenzo (7 th)',
                'role' => 'Orang Tua Murid (Sleman)',
                'program' => 'Les Renang Anak Privat',
                'rating' => 5,
                'review' => 'Alhamdulillah Kenzo yang tadinya panik kalau kena air dalam, sekarang di pertemuan ke-4 sudah bisa gaya dada dan meluncur dengan ceria! Pelatihnya sabar sekali & komunikatif.',
                'avatar' => 'images/assets/coach_hendra.webp',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'is_featured' => true,
            ],
            [
                'name' => 'Bagas Prasetyo',
                'role' => 'Peserta Seleksi Bintara POLRI 2026',
                'program' => 'Persiapan Tes TNI/POLRI',
                'rating' => 5,
                'review' => 'Sebelum latihan di sini renang 50m saya memakan waktu 1 menit 15 detik. Setelah dirombak tekniknya oleh Coach Les Renang Jogja, waktu saya tembus 42 detik dan lulus tes renang angka 100!',
                'avatar' => 'images/assets/coach_danu.webp',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'is_featured' => true,
            ],
            [
                'name' => 'Siti Nurhaliza, S.E.',
                'role' => 'Dewasa Pemula (Muslimah)',
                'program' => 'Les Renang Wanita Privat',
                'rating' => 5,
                'review' => 'Sebagai wanita karir dan muslimah, saya merasa sangat nyaman karena dilatih oleh mba pelatih wanita. Kolamnya privat, suasananya tenang, dan dalam 5 kali latihan sudah berani mengapung di kolam dalam!',
                'avatar' => 'images/assets/coach_rina.webp',
                'video_url' => null,
                'is_featured' => true,
            ],
            [
                'name' => 'Dr. H. Hendra Wijaya',
                'role' => 'Pasien Terapi Skoliosis (45 th)',
                'program' => 'Terapi Renang Medis',
                'rating' => 5,
                'review' => 'Sakit punggung karena HNP berkurang drastis setelah rutin terapi air di Les Renang Jogja. Pelatih benar-benar paham teknik hydrotherapy yang aman sesuai arahan dokter saya.',
                'avatar' => 'images/assets/coach_bima.webp',
                'video_url' => null,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testi) {
            Testimonial::create($testi);
        }

        // 5. POSTS (BLOG ARTICLES)
        $posts = [
            [
                'slug' => '5-tips-mengatasi-anak-takut-air-saat-belajar-renang',
                'title' => '5 Tips Efektif Mengatasi Anak Takut Air Saat Pertama Kali Belajar Renang',
                'category' => 'Parenting',
                'excerpt' => 'Anak panik atau menangis saat berada di kolam renang? Ketahui trik psikologis dan metode fun learning agar anak berani dan antusias belajar renang.',
                'content' => '<p>Rasa takut terhadap air (Aquaphobia) adalah hal yang sangat alami terjadi pada anak-anak usia 3 hingga 7 tahun. Sebagai orang tua, pemaksaan atau melempar anak ke dalam air justru bisa menimbulkan trauma jangka panjang.</p><h3>1. Mulai dengan Bermain Air di Rumah</h3><p>Kenalkan sensasi air yang menyenangkan lewat mainan saat mandi di bathtub atau kolam tiup di halaman rumah.</p><h3>2. Gunakan Alat Bantu Warna-Warni</h3><p>Kacamata renang bermotif lucu dan pelampung karakter favorit akan menambah rasa aman anak.</p><h3>3. Pilih Pelatih Renang Privat Berpengalaman</h3><p>Pelatih renang anak profesional memiliki pendekatan khusus untuk membangun kepercayaan (Water Confidence) sebelum mengajarkan teknik gerakan.</p>',
                'image' => 'images/assets/program_anak.webp',
                'author' => 'Coach Hendra (Senior Instructor)',
                'reading_time' => 4,
                'published_at' => now(),
            ],
            [
                'slug' => 'panduan-lengkap-tes-renang-tni-polri-target-waktu-dan-teknik',
                'title' => 'Panduan Lengkap Tes Renang TNI & POLRI: Target Waktu, Teknik Dada Militer & Kesalahan Fatal',
                'category' => 'Persiapan TNI',
                'excerpt' => 'Ingin meraih nilai 100 pada tes renang kesamaptaan TNI/POLRI? Simak rahasia kayuhan efisien, posisi tubuh streamline, dan pernapasan 50 meter tanpa henti.',
                'content' => '<p>Tes renang merupakan salah satu item penting dalam Ujian Kesamaptaan Jasmani seleksi TNI AD, AL, AU, Akpol, maupun Bintara POLRI. Jarak yang diujikan adalah 50 meter gaya dada (militer) atau gaya bebas.</p><h3>Target Waktu Nilai Maksimal (100)</h3><p>Untuk Bintara dan Akpol, waktu di bawah 45 detik untuk 50 meter akan memberikan nilai sempurna. Kuncinya ada pada dorongan kaki (leg kick push) yang kuat dan gliding jarak jauh.</p><h3>Kesalahan Fatal Peserta Tes</h3><ul><li>Kaki tidak dibuka sempurna saat dorongan gaya dada</li><li>Pengambilan napas yang terlalu tinggi hingga merusak hidrodinamika tubuh</li><li>Panik dan kehabisan tenaga di pertengahan lintasan (25 meter)</li></ul>',
                'image' => 'images/assets/program_tni.webp',
                'author' => 'Coach Serka (Purn) Danu',
                'reading_time' => 6,
                'published_at' => now(),
            ],
            [
                'slug' => 'manfaat-luar-biasa-renang-untuk-penderita-asma-dan-skoliosis',
                'title' => 'Manfaat Luar Biasa Olahraga Renang untuk Penderita Asma dan Tulang Belakang Skoliosis',
                'category' => 'Kesehatan',
                'excerpt' => 'Mengapa dokter Ortopedi dan Paru sangat merekomendasikan renang? Baca penjelasan medis mengenai efek gaya apung air terhadap struktur tubuh.',
                'content' => '<p>Renang adalah satu-satunya jenis olahraga yang melatih seluruh kelompok otot utama tanpa memberikan tekanan benturan (impact zero) pada persendian dan tulang belakang.</p><h3>Manfaat untuk Skoliosis & Saraf Kejepit</h3><p>Saat tubuh mengapung di air, gravitasi yang menekan tulang belakang berkurang hingga 80%. Ini memberikan ruang bagi diskus intervertebralis untuk kembali ke posisi rileks.</p>',
                'image' => 'images/assets/program_terapi.webp',
                'author' => 'Dr. Fitriana, Sp.KO & Coach Team',
                'reading_time' => 5,
                'published_at' => now(),
            ],
            [
                'slug' => 'rekomendasi-kolam-renang-terbaik-di-jogja-untuk-belajar-privat',
                'title' => 'Rekomendasi 7 Kolam Renang Terbaik di Jogja yang Bersih, Nyaman, & Cocok untuk Belajar Privat',
                'category' => 'Tips Renang',
                'excerpt' => 'Mencari tempat latihan renang di Yogyakarta dengan air jernih dan fasilitas lengkap? Ini daftar kolam renang partner terbaik di Sleman, Bantul, dan Kota Jogja.',
                'content' => '<p>Kenyamanan dan kebersihan air kolam renang sangat mempengaruhi kecepatan proses belajar peserta. Berikut adalah daftar kolam renang rekomendasi dari tim Les Renang Jogja.</p>',
                'image' => 'images/assets/pool_uny.webp',
                'author' => 'Tim Redaksi Les Renang Jogja',
                'reading_time' => 5,
                'published_at' => now(),
            ]
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
