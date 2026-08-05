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
            ['email' => 'admin@apexfitness.id'],
            [
                'name' => 'Admin ApexFitness',
                'email' => 'admin@apexfitness.id',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );

        // 0.1 DEFAULT SITE SETTINGS
        $defaultSettings = [
            'whatsapp_number' => '6281234567890',
            'whatsapp_message' => 'Halo Admin ApexFitness, saya ingin klaim Free Sesi Trial Personal Trainer & konsultasi program fitness.',
            'site_name' => 'ApexFitness Center',
            'site_email' => 'info@apexfitness.id',
            'site_phone' => '+62 812-3456-7890',
            'office_address' => 'Jl. Kaliurang Km 5.5 No. 88, Sleman, D.I. Yogyakarta 55281',
            'instagram_url' => 'https://instagram.com/apexfitness.id',
            'tiktok_url' => 'https://tiktok.com/@apexfitness.id',
            'youtube_url' => 'https://youtube.com/@apexfitnessid',
            'office_hours' => 'Buka Setiap Hari: 06.00 - 22.00 WIB',
        ];
        foreach ($defaultSettings as $key => $val) {
            \App\Models\Setting::set($key, $val);
        }

        // 1. FITNESS PROGRAMS
        $programs = [
            [
                'slug' => 'weight-loss-fat-burn',
                'title' => 'Weight Loss & Body Transformation',
                'subtitle' => 'Program penurunan berat badan intensif, pemangkasan lemak, & pembentukan lekuk tubuh ideal.',
                'target_audience' => 'Pria & Wanita yang ingin turun berat badan 5–25 kg dengan aman tanpa efek rebound.',
                'description' => 'Program bimbingan privat 1-on-1 gabungan latihan HIIT, Strength Training, dan panduan kalori nutrition plan harian yang disesuaikan metabolisme tubuh Anda. Hasil terukur dengan InBody 3D Scan berkala.',
                'features' => [
                    'Personal Trainer Privat 1-on-1 tersertifikasi APKI',
                    'InBody 3D Scan Komposisi Tubuh Gratis Setiap 2 Minggu',
                    'Custom Meal Plan & Panduan Defisit Kalori Harian',
                    'Garansi Lingkar Pinggang & Lemak Tubuh Berkurang',
                    'Jadwal Fleksibel (Pagi 06.00 s/d Malam 21.00 WIB)'
                ],
                'benefits' => [
                    'Membakar lemak membandel di perut, paha, dan lengan',
                    'Meningkatkan metabolisme basal (BMR) agar tidak cepat gemuk',
                    'Meningkatkan energi harian & stamina tubuh',
                    'Membentuk postur tubuh lebih tegas & percaya diri'
                ],
                'curriculum' => [
                    'Fase 1 (Minggu 1-2): Body Composition Assessment, Adaptasi Kardio & Corrective Exercise',
                    'Fase 2 (Minggu 3-5): Fat Burn HIIT & Compound Movement Training (Squat, Deadlift, Bench)',
                    'Fase 3 (Minggu 6-8): Metabolic Conditioning & Hypertrophy Sculpting',
                    'Fase 4 (Minggu 9-12): Peak Transformation & Long-Term Maintenance System'
                ],
                'price_start' => 450000,
                'icon' => 'fire',
                'image' => 'images/assets/program_dewasa.webp',
                'badge' => 'Paling Populer',
                'order' => 1,
            ],
            [
                'slug' => 'muscle-building-hypertrophy',
                'title' => 'Muscle Building & Hypertrophy',
                'subtitle' => 'Program pembentukan otot dada, bahu, lengan, & dada bidang untuk postur atletis.',
                'target_audience' => 'Pria/Wanita yang ingin tambah massa otot, menaikkan berat badan bersih, & badan lebih berisi.',
                'description' => 'Dirancang untuk Anda yang ingin membangun otot secara proporsional dan efektif. Fokus pada Progressive Overload, form gerakan yang presisi, serta diet surplus nutrisi berprotein tinggi.',
                'features' => [
                    'Privat Training dengan Metode Progressive Overload',
                    'Evaluasi Form Gerakan & Biomekanika Otot',
                    'Panduan Asupan Protein & Surplus Kalori Bersih',
                    'Latihan Beban Free Weights & Machine Gym Modern',
                    'Jadwal & Target Massa Otot Terukur Setiap Bulan'
                ],
                'benefits' => [
                    'Menambah berat badan sehat melalui pembentukan otot',
                    'Menciptakan postur bahu lebar V-Taper & dada bidang',
                    'Memperkuat kepadatan tulang & sendi tubuh',
                    'Meningkatkan kadar testosterone alami & performa'
                ],
                'curriculum' => [
                    'Minggu 1-2: Form Mastery & Neuromuscular Mind-Muscle Connection',
                    'Minggu 3-6: Hypertrophy Split Routine (Push-Pull-Legs)',
                    'Minggu 7-10: Heavy Compound Strength & Progressive Load',
                    'Minggu 11-12: Muscle Peak & Symmetry Check'
                ],
                'price_start' => 500000,
                'icon' => 'dumbbell',
                'image' => 'images/assets/program_tni.webp',
                'badge' => 'Rekomendasi Bulking',
                'order' => 2,
            ],
            [
                'slug' => 'female-fitness-shaping',
                'title' => 'Female Fitness & Body Shaping',
                'subtitle' => 'Program gym privat khusus wanita: Kencangkan perut, bokong (Glutes), & membentuk lekuk tubuh.',
                'target_audience' => 'Wanita / Muslimah yang menginginkan instruktur wanita & area gym privat yang nyaman.',
                'description' => 'Program kebugaran wanita modern yang memadukan Strength Training ringan, Pilates Mat, dan Glute-Focused Workouts. Dilatih oleh Personal Trainer wanita profesional.',
                'features' => [
                    '100% Instruktur Trainer Wanita Berlisensi',
                    'Area Studio Gym Privat Khusus Wanita (Bebas Riba & Safe Space)',
                    'Latihan Glutes, Core, Lower Body & Toned Arms',
                    'Panduan Nutrisi Hormonal & Bebas Diet Ketat Menyiksa'
                ],
                'benefits' => [
                    'Membentuk lekuk tubuh hourglass & mengencangkan bagian perut',
                    'Menghilangkan gelambir lengan & paha dalam',
                    'Menjaga keseimbangan hormon & metabolisme wanita',
                    'Privasi 100% terjaga dengan suasana menyenangkan'
                ],
                'curriculum' => [
                    'Tingkat 1: Full Body Mobility, Core Stabilization & Glute Activation',
                    'Tingkat 2: Sculpting Lower Body & Tone Upper Body',
                    'Tingkat 3: High Intensity Body Shaping & Pilates Core Fusion'
                ],
                'price_start' => 480000,
                'icon' => 'sparkles',
                'image' => 'images/assets/program_wanita.webp',
                'badge' => '100% Trainer Wanita',
                'order' => 3,
            ],
            [
                'slug' => 'calisthenics-strength-conditioning',
                'title' => 'Strength & Conditioning / Persiapan Fisik TNI-POLRI',
                'subtitle' => 'Program ketahanan fisik militer, latihan kalistenik, lari stamina, & pull-up maksimal.',
                'target_audience' => 'Calon Taruna/Akpol, Bintara, POLRI, Kedinasan, & Atlet Performance.',
                'description' => 'Persiapan fisik komprehensif untuk mencapai standar tes Kesamaptaan Jasmani TNI-POLRI (Push-up, Sit-up, Pull-up, Shuttle Run, & Lari 12 Menit). Mentoring fisik ketat untuk nilai skor 100.',
                'features' => [
                    'Simulasi Tes Kesamaptaan Standar Mabes TNI/POLRI',
                    'Pelatihan Drill Pull-Up, Push-Up Presisi, & Shuttle Run',
                    'Peningkatan Kapasitas Paru (VO2 Max) & Stamina Lari',
                    'Evaluasi Video Biomekanika Gerakan Nilai Maksimal',
                    'Pendampingan Nutrisi & Fisik Harian'
                ],
                'benefits' => [
                    'Memastikan lulus passing grade tinggi dengan nilai 100',
                    'Meningkatkan daya tahan kardiovaskular & kekuatan otot',
                    'Membentuk mental disiplin & pantang menyerah'
                ],
                'curriculum' => [
                    'Minggu 1: Baseline Physical Diagnostic & Form Correction',
                    'Minggu 2-4: Core Power, Calisthenics Progression & Pull-up Mastery',
                    'Minggu 5-7: Speed & VO2 Max Interval Running Training',
                    'Minggu 8: Trial Test Simulation & Peak Performance Readiness'
                ],
                'price_start' => 550000,
                'icon' => 'shield-check',
                'image' => 'images/assets/program_anak.webp',
                'badge' => 'Garansi Skor Target',
                'order' => 4,
            ],
            [
                'slug' => 'posture-rehab-functional',
                'title' => 'Posture Correction & Rehab Fungsional',
                'subtitle' => 'Pemulihan skoliosis, sakit pinggang (HNP/Saraf Kejepit), bahu bungkuk, & mobilitas sendi.',
                'target_audience' => 'Pekerja kantoran, penderita bungkuk (Kyphosis), nyeri pinggang, & rehabilitasi cedera.',
                'description' => 'Program terapi latihan fungsional khusus untuk memperbaiki postur tubuh, menghilangkan rasa pegal kronis leher & punggung, serta memperkuat otot penopang tulang belakang.',
                'features' => [
                    'Assesment Postur Tubuh & Mobilitas Sendi 3D',
                    'Latihan Corrective Movement & Spinal Decompression',
                    'Penanganan Kyphosis (Bahu Bungkuk) & Forward Head Posture',
                    'Bimbingan Terapi Ringan Tanpa Risiko Cedera'
                ],
                'benefits' => [
                    'Menghilangkan nyeri punggung bawah (LBP) & saraf kejepit',
                    'Memperbaiki postur berdiri & duduk agar tampak lebih tegap',
                    'Meningkatkan fleksibilitas & kenyamanan gerak harian'
                ],
                'curriculum' => [
                    'Fase 1: Pain Relief & Core Muscle Activation',
                    'Fase 2: Spinal Realignment & Scapular Stabilization',
                    'Fase 3: Functional Strength & Posture Maintenance'
                ],
                'price_start' => 500000,
                'icon' => 'heart-pulse',
                'image' => 'images/assets/program_terapi.webp',
                'badge' => 'Rekomendasi Medis',
                'order' => 5,
            ],
            [
                'slug' => 'corporate-wellness-group',
                'title' => 'Corporate Wellness & Group Fitness Class',
                'subtitle' => 'Program kebugaran karyawan instansi, perusahaan, & kelas grup HIIT / Crossfit.',
                'target_audience' => 'Perusahaan, instansi pemerintah, BUMN, sekolah, & komunitas fitness.',
                'description' => 'Paket pelatihan kebugaran kelompok untuk meningkatkan produktivitas karyawan, kesehatan fisik tim, dan ikatan kebersamaan perusahaan melalui kelas latihan seru.',
                'features' => [
                    'Tim Personal Trainer Complete membawa peralatan',
                    'Medical & Physical Checkup Karyawan Berkala',
                    'Pilihan Kelas: HIIT Functional, Yoga BootCamp, Zumba/Crossfit',
                    'Diskon Khusus Rombongan Instansi'
                ],
                'benefits' => [
                    'Menurunkan angka sakit karyawan & meningkatkan stamina kerja',
                    'Membangun budaya kerja sehat & kekompakan tim (Team Building)',
                    'Sesi interaktif yang menyenangkan & membakar kalori tinggi'
                ],
                'curriculum' => [
                    'Sesi 1: Health Assessment & Group Warmup BootCamp',
                    'Sesi 2-4: Functional Group Challenge & Cardio Burn Class'
                ],
                'price_start' => 1500000,
                'icon' => 'users-three',
                'image' => 'images/assets/program_privat.webp',
                'badge' => 'Paket Rombongan',
                'order' => 6,
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 2. GYM BRANCH LOCATIONS / STUDIOS
        $locations = [
            [
                'slug' => 'apex-gym-sleman-center',
                'name' => 'ApexFitness Center Sleman (Headquarters)',
                'city' => 'Yogyakarta (Sleman)',
                'address' => 'Jl. Kaliurang Km 5.5 No. 88, Caturtunggal, Depok, Sleman, D.I. Yogyakarta 55281',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.189569035177!2d110.3853112!3d-7.7702812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b20ab248bf%3A0xb3adacbfdf5d16e0!2sKolam%20Renang%20FIK%20UNY!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Peralatan Gym Impor Hammer Strength', 'InBody 3D Scan Test', 'Area VIP PT 1-on-1', 'Locker & Shower Air Hangat', 'Protein Bar Cafe'],
                'image' => 'images/assets/pool_uny.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'apex-studio-seturan',
                'name' => 'ApexFitness Studio Seturan (Kampus Area)',
                'city' => 'Yogyakarta (Sleman)',
                'address' => 'Jl. Raya Seturan No.12B, Caturtunggal, Depok, Sleman, DIY (Dekat UPN & YKPN)',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.076840788647!2d110.4074218!3d-7.7816828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5991c015b6cd%3A0xa193d56b02660144!2sDepok%20Sports%20Center!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Studio HIIT & Functional Training', 'Khusus Mahasiswa & Umum', 'Free Wifi Super Cepat', 'Parkir Luas & Keamanan 24 Jam'],
                'image' => 'images/assets/pool_depok.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'apex-gym-umbulharjo-jogja',
                'name' => 'ApexFitness Performance Gym (Kota Jogja)',
                'city' => 'Yogyakarta (Kota)',
                'address' => 'Jl. Umbulharjo Raya No. 45, Umbulharjo, Kota Yogyakarta, DIY',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.923485747683!2d110.3888321!3d-7.8081298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a579bc4cb5443%3A0xbce5b93108c48a73!2sKota%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Zona Bodybuilding & Heavy Lifting', 'Personal Trainer Sertifikasi APKI', 'Sauna Room', 'Buka 06.00 - 22.00 WIB'],
                'image' => 'images/assets/pool_tirtasari.webp',
                'is_featured' => true,
            ],
            [
                'slug' => 'apex-executive-hyatt',
                'name' => 'Apex Executive Gym & Wellness (Palagan)',
                'city' => 'Yogyakarta (Privat)',
                'address' => 'Jl. Palagan Tentara Pelajar No.KM.7, Sariharjo, Ngaglik, Sleman, DIY',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.488349280963!2d110.3708491!3d-7.7378772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58e2fb8d0f1b%3A0x7d6f51950d856012!2sHyatt%20Regency%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000',
                'features' => ['Fasilitas Luxury Resort Bintang 5', 'Privasi Eksekutif Maksimal', 'Studio Reformer Pilates & Rehab', 'Hydrotherapy & Spa'],
                'image' => 'images/assets/pool_ugm.webp',
                'is_featured' => true,
            ],
        ];

        foreach ($locations as $loc) {
            Location::updateOrCreate(['slug' => $loc['slug']], $loc);
        }

        // 3. FAQS FOR FITNESS (20+ ITEMS)
        $faqs = [
            [
                'category' => 'Umum',
                'question' => 'Mengapa harus latihan bersama Personal Trainer di ApexFitness?',
                'answer' => 'ApexFitness didukung oleh tim Personal Trainer tersertifikasi APKI & IFBB dengan rekam jejak sukses melatih 1000+ member. Kami menyediakan program yang disesuaikan 100% dengan kondisi fisik Anda, evaluasi InBody 3D Scan, serta panduan nutrisi harian.',
                'is_popular' => true,
                'order' => 1,
            ],
            [
                'category' => 'Umum',
                'question' => 'Berapa lama waktu yang dibutuhkan sampai hasil terlihat?',
                'answer' => 'Dengan mengikuti sesi PT 3x seminggu dan mematuhi panduan nutrisi, perubahan fisik awal (penurunan berat badan 2–4 kg atau peningkatan tonus otot) dapat terlihat dan terasa dalam 3–4 minggu pertama.',
                'is_popular' => true,
                'order' => 2,
            ],
            [
                'category' => 'Umum',
                'question' => 'Saya pemula dan belum pernah ke gym, apakah bisa?',
                'answer' => 'Sangat bisa! 70% member ApexFitness adalah pemula yang baru pertama kali menyentuh alat gym. Trainer kami akan membimbing secara perlahan dari pengenalan alat, form gerakan yang aman, hingga peningkatan beban bertahap.',
                'is_popular' => true,
                'order' => 3,
            ],
            [
                'category' => 'Umum',
                'question' => 'Apakah ada garansi penurunan berat badan atau pembentukan otot?',
                'answer' => 'Ya! Kami memberikan garansi bimbingan tambahan bagi peserta program komitmen yang menjalankan saran trainer & nutrisi namun belum mencapai target yang disepakati.',
                'is_popular' => false,
                'order' => 4,
            ],
            [
                'category' => 'Personal Training',
                'question' => 'Bagaimana cara klaim Free Trial Sesi 1 Personal Trainer?',
                'answer' => 'Anda cukup mengisi formulir daftar trial di website ini atau klik tombol WhatsApp Admin. Tim kami akan menjadwalkan sesi trial gratis 45 menit meliputi Body Assessment + Sesi Latihan Privat.',
                'is_popular' => true,
                'order' => 5,
            ],
            [
                'category' => 'Personal Training',
                'question' => 'Apakah ada Personal Trainer wanita khusus member perempuan?',
                'answer' => 'Tentu saja ada! Kami memiliki tim Personal Trainer wanita berpengalaman khusus untuk member wanita/muslimah yang menginginkan kenyamanan dan privasi tinggi.',
                'is_popular' => true,
                'order' => 6,
            ],
            [
                'category' => 'Personal Training',
                'question' => 'Bagaimana jika jadwal saya berubah-ubah karena pekerjaan?',
                'answer' => 'Jadwal latihan di ApexFitness super fleksibel. Anda dapat berkoordinasi langsung dengan Trainer pribadi Anda untuk menentukan jam latihan harian dari pukul 06.00 hingga 21.00 WIB.',
                'is_popular' => false,
                'order' => 7,
            ],
            [
                'category' => 'Personal Training',
                'question' => 'Apakah saya mendapat panduan makanan / Diet Plan?',
                'answer' => 'Ya, setiap paket PT sudah termasuk fasilitas Custom Meal Plan harian berdasarkan kebutuhan kalori makro (Protein, Karbohidrat, Lemak) yang disesuaikan dengan makanan kesukaan Anda.',
                'is_popular' => false,
                'order' => 8,
            ],
            [
                'category' => 'Fasilitas & Gym',
                'question' => 'Peralatan apa saja yang tersedia di cabang ApexFitness?',
                'answer' => 'Fasilitas kami dilengkapi alat strength impor kelas dunia (Hammer Strength, LifeFitness), area free weights lengkap, kardio zone (Treadmill, Assault Bike), studio kelas, locker room, shower air hangat, dan InBody Scan.',
                'is_popular' => false,
                'order' => 9,
            ],
            [
                'category' => 'Fasilitas & Gym',
                'question' => 'Apakah bisa Personal Trainer datang ke rumah / gym perumahan (Home PT)?',
                'answer' => 'Bisa. Kami melayani program Private Home Personal Training di wilayah Yogyakarta dan sekitarnya. Trainer kami akan membawa peralatan pendukung ke lokasi Anda.',
                'is_popular' => true,
                'order' => 10,
            ],
            [
                'category' => 'Kesehatan & Rehab',
                'question' => 'Saya memiliki masalah nyeri pinggang / saraf kejepit, apakah aman ikut gym?',
                'answer' => 'Sangat aman jika dibimbing trainer spesialis rehab. Program Posture Correction & Rehab kami berfokus pada dekompresi tulang belakang, peregangan otot tegang, dan penguatan otot core penopang tubuh.',
                'is_popular' => true,
                'order' => 11,
            ],
            [
                'category' => 'Kesehatan & Rehab',
                'question' => 'Apakah wanita yang latihan beban tubuhnya akan menjadi kekar seperti pria?',
                'answer' => 'Tidak! Mitos wanita kekar karena angkat beban adalah tidak benar. Secara biologis kadar hormon testosterone wanita jauh lebih rendah dari pria. Latihan beban pada wanita akan membentuk tubuh lebih ramping, kencang, dan berbentuk indah.',
                'is_popular' => false,
                'order' => 12,
            ],
            [
                'category' => 'Persiapan TNI/POLRI',
                'question' => 'Bagaimana metode latihan fisik untuk persiapan tes TNI/POLRI?',
                'answer' => 'Program difokuskan pada peningkatan jumlah repetisi Pull-Up presisi, Push-Up standar Mabes, Sit-Up, Shuttle Run cepat, dan daya tahan lari 12 menit dengan pacing yang efisien.',
                'is_popular' => true,
                'order' => 13,
            ],
            [
                'category' => 'Pembayaran & Paket',
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami menerima pembayaran Cash, Transfer Bank, QRIS, serta Cicilan 0% via Kartu Kredit / E-Wallet untuk paket membership tahunan dan paket PT.',
                'is_popular' => false,
                'order' => 14,
            ],
            [
                'category' => 'Pembayaran & Paket',
                'question' => 'Apakah ada promo diskon jika daftar berdua dengan pasangan / teman?',
                'answer' => 'Ada! Kami menyediakan Promo Couple & Buddy Package dengan diskon hingga 20% untuk pendaftaran 2 orang sekaligus.',
                'is_popular' => true,
                'order' => 15,
            ],
            [
                'category' => 'Pembayaran & Paket',
                'question' => 'Berapa masa berlaku paket pertemuan Sesi PT?',
                'answer' => 'Paket 12 sesi memiliki masa aktif 2 bulan, sedangkan paket 24–48 sesi memiliki masa aktif hingga 6 bulan dengan toleransi pembekuan (cuti latihan) jika Anda bertugas luar kota.',
                'is_popular' => false,
                'order' => 16,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        // 4. TESTIMONIALS & CLIENT TRANSFORMATIONS
        $testimonials = [
            [
                'name' => 'Bima Perkasa (28 th)',
                'role' => 'Software Engineer (Sleman)',
                'program' => 'Weight Loss & Body Transformation',
                'rating' => 5,
                'review' => 'Turun 16 kg dalam 3 bulan! Dulu sering sakit pinggang karena kelamaan duduk koding & BB 88 kg. Dibimbing Coach ApexFitness dengan pola latihan intensif tapi tetep bisa makan nasi. Sekarang BB 72 kg & perut buncit hilang!',
                'avatar' => 'images/assets/coach_hendra.webp',
                'video_url' => 'https://www.youtube.com/embed/5ee8sX_1-9c',
                'is_featured' => true,
            ],
            [
                'name' => 'Rian Ardianto',
                'role' => 'Lulusan Bintara POLRI 2026',
                'program' => 'Strength & Persiapan TNI-POLRI',
                'rating' => 5,
                'review' => 'Awalnya pull-up cuma bisa 3x dan lari 12 menit dapet 1800m. Setelah 2 bulan gabung ApexFitness program TNI-POLRI, pull-up tembus 18x presisi & lari tembus 3100m. Nilai kesamaptaan saya dapet 100 sempurna!',
                'avatar' => 'images/assets/coach_danu.webp',
                'video_url' => 'https://www.youtube.com/embed/xVeXGKPOH58',
                'is_featured' => true,
            ],
            [
                'name' => 'Anisa Rahma, S.Farm',
                'role' => 'Apoteker & Member Wanita',
                'program' => 'Female Fitness & Body Shaping',
                'rating' => 5,
                'review' => 'Privasi luar biasa nyaman karena ada area khusus cewek & pelatih wanita yang ramah. Dalam 8 minggu paha & pinggul jadi kencang, lengan tidak gelambir lagi. Berat badan ideal & badan terasa super fit!',
                'avatar' => 'images/assets/coach_rina.webp',
                'video_url' => 'https://www.youtube.com/embed/M5cs8a3Bhfg',
                'is_featured' => true,
            ],
            [
                'name' => 'Drs. Supriyanto (49 th)',
                'role' => 'PNS & Pasien Posture Rehab',
                'program' => 'Posture Correction & Rehab',
                'rating' => 5,
                'review' => 'Nyeri saraf kejepit di pinggang bawah yang mengganggu tidur selama 2 tahun akhirnya sembuh total setelah terapi latihan fungsional di ApexFitness. Postur berdiri jadi tegap & rasa pegal hilang.',
                'avatar' => 'images/assets/coach_bima.webp',
                'video_url' => null,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $testi) {
            Testimonial::create($testi);
        }

        // 5. POSTS (FITNESS BLOG ARTICLES)
        $posts = [
            [
                'slug' => 'panduan-lengkap-defisit-kalori-dan-latihan-beban-penurunan-berat-badan',
                'title' => 'Panduan Lengkap Defisit Kalori & Latihan Beban: Rahasia Turun BB Tanpa Efek Yoyo',
                'category' => 'Nutrisi & Fat Loss',
                'excerpt' => 'Ingin menurunkan lemak tubuh secara permanent tanpa harus kelaparan? Pahami sains di balik perhitungan BMR, defisit kalori bersih, dan pentingnya latihan beban.',
                'content' => '<p>Banyak orang terjebak dalam diet ekstrem hanya makan buah atau melakukan kardio berlebihan jam-jaman. Padahal kunci sukses pemangkasan lemak jangka panjang adalah kombinasi <strong>Defisit Kalori Terukur + Latihan Beban (Strength Training)</strong>.</p><h3>1. Hitung BMR & TDEE Anda</h3><p>Basal Metabolic Rate (BMR) adalah jumlah kalori yang dibakar tubuh saat beristirahat. Untuk memangkas lemak 0.5 kg per minggu, buatlah defisit 300–500 kalori dari TDEE Anda.</p><h3>2. Utamakan Asupan Protein Tinggi</h3><p>Konsumsi protein 1.6 - 2.2 gram per kg berat badan untuk mencegah otot terkikis saat proses pembakaran lemak berlangsung.</p><h3>3. Latihan Beban Jaga Massa Otot</h3><p>Otot yang terlatih memikat metabolisme tubuh agar tetap aktif membakar kalori bahkan saat Anda sedang tidur nyenyak.</p>',
                'image' => 'images/assets/program_dewasa.webp',
                'author' => 'Coach Hendra, CSCS',
                'reading_time' => 5,
                'published_at' => now(),
            ],
            [
                'slug' => '5-kesalahan-fatal-pemula-saat-pertama-kali-latihan-di-gym',
                'title' => '5 Kesalahan Fatal Pemula Saat Pertama Kali Gym & Cara Menghindarnya',
                'category' => 'Tips Fitness',
                'excerpt' => 'Baru mau mulai gym? Hindari ego lifting, abaikan pemanasan, atau form gerakan salah yang dapat memicu cedera sendi dan menghentikan progress Anda.',
                'content' => '<p>Memulai perjalanan kebugaran di gym adalah keputusan luar biasa. Namun, pastikan Anda menghindari 5 kesalahan umum berikut:</p><h3>1. Ego Lifting (Beban Terlalu Berat)</h3><p>Fokuslah pada teknik form gerakan yang benar terlebih dahulu sebelum menambah beban piringan berat.</p><h3>2. Melewatkan Pemanasan Dinamis</h3><p>Pemanasan sendi dan otot selama 5–10 menit sangat vital untuk melumasi cairan sinovial sendi dan mencegah kram.</p><h3>3. Tidak Memiliki Program Latihan Terstruktur</h3><p>Jangan asal mencoba alat tanpa rencana. Pakailah program split routine yang teruji seperti Push-Pull-Legs.</p>',
                'image' => 'images/assets/program_tni.webp',
                'author' => 'Coach Danu, APKI Certified',
                'reading_time' => 4,
                'published_at' => now(),
            ],
            [
                'slug' => 'rahasia-pull-up-20x-presisi-persiapan-tes-kesamaptaan-tni-polri',
                'title' => 'Rahasia Tembus Pull-Up 20x Presisi untuk Tes Kesamaptaan TNI & POLRI',
                'category' => 'Persiapan TNI',
                'excerpt' => 'Kesulitan menaikkan jumlah pull-up? Pelajari teknik penguatan otot Lats, bicep grip, dan latihan negatif pull-up untuk hasil skor maksimal 100.',
                'content' => '<p>Pull-up merupakan tes fisik tersulit bagi banyak peserta calon Bintara dan Taruna. Untuk menguasainya, Anda butuh latihan spesifik berikut:</p><h3>1. Latihan Negative Pull-Up</h3><p>Melompat ke atas bar lalu menahan tubuh turun perlahan selama 5 detik. Ini membangun kekuatan otot dasar dengan cepat.</p><h3>2. Kuatkan Otot Core & Lats</h3><p>Pull-up bukan hanya tentang otot lengan, tetapi pelibatan otot punggung Latissimus Dorsi dan ayunan tubuh yang stabil.</p>',
                'image' => 'images/assets/program_anak.webp',
                'author' => 'Coach Serka (Purn) Danu',
                'reading_time' => 6,
                'published_at' => now(),
            ],
            [
                'slug' => 'manfaat-latihan-beban-bagi-wanita-mengencangkan-tubuh-dan-cegah-osteoporosis',
                'title' => 'Manfaat Luar Biasa Latihan Beban bagi Wanita: Tubuh Ramping, Kencang & Bebas Osteoporosis',
                'category' => 'Female Fitness',
                'excerpt' => 'Benarkah angkat beban bikin wanita berotot besar? Simak penjelasan ilmiah mengapa angkat beban adalah kunci utama lekuk tubuh ideal wanita.',
                'content' => '<p>Banyak wanita khawatir angkat beban akan membuat tubuh kekar bak binaragawan. Hal ini adalah salah kaprah. Hormon estrogen pada wanita membuat tubuh merespons latihan beban dengan bentuk yang ramping, kencang, dan proporsional.</p>',
                'image' => 'images/assets/program_wanita.webp',
                'author' => 'Coach Rina, Pilates & Strength Specialist',
                'reading_time' => 4,
                'published_at' => now(),
            ]
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
