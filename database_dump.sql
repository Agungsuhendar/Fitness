-- Complete MySQL Schema and Data Dump for InfinityFree
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2026_08_02_100001_create_programs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2026_08_02_100002_create_locations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2026_08_02_100003_create_faqs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2026_08_02_100004_create_posts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2026_08_02_100005_create_testimonials_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2026_08_02_100006_create_registrations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2026_08_02_100007_create_trial_bookings_table', 1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` DATETIME NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Admin Les Renang Jogja', 'admin@lesrenangjogja.com', NULL, '$2y$12$W/sD0/6Mbt5Dk0HkPg5z7eE9ElJDDMMhCtxENFHtMxaU8/9Db0T4S', NULL, '2026-08-02 14:27:50', '2026-08-02 14:27:50');

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` INT NULL,
  `ip_address` VARCHAR(255) NULL,
  `user_agent` LONGTEXT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` LONGTEXT NOT NULL,
  `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` INT NOT NULL,
  `reserved_at` INT NULL,
  `available_at` INT NOT NULL,
  `created_at` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` LONGTEXT NULL,
  `cancelled_at` INT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` VARCHAR(255) NOT NULL,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) NULL,
  `target_audience` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `features` LONGTEXT NULL,
  `benefits` LONGTEXT NULL,
  `curriculum` LONGTEXT NULL,
  `price_start` INT NOT NULL,
  `icon` VARCHAR(255) NULL,
  `image` VARCHAR(255) NULL,
  `badge` VARCHAR(255) NULL,
  `order` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (1, 'les-renang-anak', 'Les Renang Anak (Usia 3–15 Tahun)', 'Metode ramah anak, menyenangkan, cepat bisa, & berstandar keselamatan tinggi.', 'Orang tua yang ingin anaknya mahir renang & percaya diri', 'Program privat & semi privat khusus anak-anak usia 3 hingga 15 tahun. Pelatih kami sangat sabar, tersertifikasi PRSI, dan menggunakan metode fun learning tanpa rasa takut.', '["Metode pelathan Water Confidence & Fun Learning","Rasio 1 Pelatih : 1\\u20132 Anak (Privat Khusus)","Garansi anak berani air & bisa gaya dada\\/bebas","Jadwal fleksibel menyesuaikan sekolah anak","Sertifikat kelulusan & penilaian progress"]', '["Melatih keberanian & kemandirian anak sejak dini","Meningkatkan metabolisme, tinggi badan & daya tahan tubuh","Mengurangi ketergantungan pada gadget","Keterampilan keselamatan diri (Water Safety)"]', '["Pertemuan 1-2: Adaptasi Air, Water Breathing & Floating","Pertemuan 3-5: Gliding, Kicking Technique & Gaya Dada (Katak)","Pertemuan 6-8: Gaya Bebas (Freestyle) & Pengambilan Napas","Pertemuan 9-10: Kombinasi Gaya, Water Treading (Mengapung) & Water Safety"]', 350000, 'child', 'images/assets/program_anak.webp', 'Paling Populer', 1, '2026-08-02 14:27:50', '2026-08-02 14:27:50');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (2, 'les-renang-dewasa', 'Les Renang Dewasa Pemula', 'Hilangkan trauma air & kuasai teknik renang dengan cepat & nyaman.', 'Dewasa (16+ tahun) yang trauma air atau ingin belajar dari nol', 'Program privat khusus dewasa yang belum pernah bisa renang atau memiliki trauma masa kecil. Bimbingan privat 1-on-1 dengan teknik efisien & suasana tenang.', '["Privat 1-on-1 privasi terjamin","Pendekatan mengatasi Aquaphobia \\/ Trauma Air","Penguasaan Gaya Dada, Gaya Bebas, & Injak Air","Pilihan kolam tenang & tidak terlalu ramai","Garansi 4-8 kali pertemuan pasti bisa mengapung & meluncur"]', '["Olah raga low-impact aman untuk sendi & punggung","Meningkatkan kesehatan jantung & kapasitas paru-paru","Menghilangkan stres kerja & membakar kalori secara maksimal"]', '["Sesi 1: Penanganan Trauma & Teknik Bernapas Efisien","Sesi 2-4: Posisi Streamline Body & Gaya Dada","Sesi 5-7: Gaya Bebas & Rotasi Bahu","Sesi 8: Mengapung Diam (Treading Water) di Kolam Dalam"]', 400000, 'user-check', 'images/assets/program_dewasa.webp', 'Rekomendasi Pemula', 2, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (3, 'les-renang-wanita', 'Les Renang Khusus Wanita / Muslimah', 'Pelatih wanita berpengalaman, kolam privat, & privasi 100% terjaga.', 'Wanita / Muslimah yang menginginkan instruktur wanita & area privat', 'Program eksklusif untuk wanita yang ingin belajar renang dengan nyaman. Dilatih langsung oleh instruktur wanita profesional di lokasi kolam privat yang aman.', '["100% Pelatih Wanita Berlisensi & Sabar","Pilihan kolam privat khusus wanita (Indoor \\/ Semi-Indoor)","Waktu & tempat latihan fleksibel","Materi disesuaikan dengan kebutuhan fisik wanita"]', '["Menjaga kebugaran & kelenturan tubuh","Privasi & rasa nyaman tanpa canggung","Membantu program penurunan berat badan & postur ideal"]', '["Tingkat Dasar: Penguasaan Pernapasan & Gaya Dada","Tingkat Menengah: Gaya Bebas & Gaya Punggung","Tingkat Lanjut: Stamina Swimming & Treading Water"]', 450000, 'user-female', 'images/assets/program_wanita.webp', '100% Instruktur Wanita', 3, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (4, 'persiapan-tni-polri', 'Program Persiapan Tes TNI, POLRI & Kedinasan', 'Target waktu maksimal, teknik renang militer, & evaluasi skor standar tes.', 'Calon Taruna/Akpol, Bintara, Tamtama, IPDN, STIN, Kemenhub', 'Program intesif untuk menghadapi tes renang seleksi TNI, POLRI, & Sekolah Kedinasan. Dipandu oleh instruktur spesialis fisik militer untuk mencapai jarak 50 meter dengan waktu tercepat.', '["Simulasi tes resmi jarak 50 meter berwaktu","Pelatihan Gaya Dada Militer & Gaya Bebas Cepat","Teknik pernapasan daya tahan & efisiensi kayuhan","Analisis & koreksi video gerakan teknik","Modul latihan fisik pendukung (Core strength & lung capacity)"]', '["Memastikan nilai tes renang memenuhi passing grade & nilai maksimal (100)","Meningkatkan rasa percaya diri saat menghadapi tim penguji","Penguasaan teknik renang yang efisien tanpa cepat lelah"]', '["Minggu 1: Diagnostic Test & Koreksi Teknik dasar 50m","Minggu 2-3: Penguatan Kayuhan Leg Power & Arm Push","Minggu 4-6: Drill Kecepatan (Sprint Interval 25m & 50m)","Minggu 7-8: Time Trial Simulation & Mental Readiness"]', 500000, 'shield', 'images/assets/program_tni.webp', 'Garansi Skor Target', 4, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (5, 'terapi-renang', 'Terapi Renang & Pemulihan Fisik', 'Pemulihan skoliosis, sakit punggung, asma, & terapi pasca cedera.', 'Individu dengan skoliosis, masalah HNP/saraf kejepit, asma, atau rehabilitasi', 'Program latihan air berorientasi kesehatan yang disesuaikan dengan kondisi medis peserta. Berfungsi mengurangi beban pada tulang belakang & melatih paru-paru.', '["Bimbingan khusus berdasar saran medis \\/ dokter","Gerakan gentle hydrotherapy & dekompresi tulang belakang","Latihan pernapasan terkontrol untuk penderita asma","Pendampingan erat selama di dalam air"]', '["Meringankan nyeri punggung & memulihkan skoliosis","Mengurangi gejala sesak napas pada penderita asma","Mempercepat pemulihan otot & sendi"]', '["Fase 1: Water Decompression & Gentle Floating","Fase 2: Controlled Breathing & Spinal Alignment Drills","Fase 3: Low-Impact Stroke Swimming"]', 450000, 'heart-pulse', 'images/assets/program_terapi.webp', 'Rekomendasi Medis', 5, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (6, 'corporate-training', 'Corporate Training & Group Class', 'Program kebugaran renang untuk instansi, perusahaan, & komunitas.', 'Perusahaan, instansi pemerintah, sekolah, & komunitas', 'Paket pelatihan renang kelompok untuk perusahaan atau instansi yang ingin meningkatkan kebugaran tim, keselamatan air, & kegiatan kebersamaan.', '["Instruktur tim profesional lengkap","Sertifikasi keselamatan air & First Aid","Jadwal & tempat dapat disesuaikan","Diskon khusus rombongan \\/ grup"]', '["Meningkatkan kesehatan karyawan & produktivitas kerja","Mempererat kebersamaan tim (Team Building)","Pembekalan tanggap darurat di air (Water Safety & Rescue)"]', '["Sesi 1: Basic Water Safety & Self Survival","Sesi 2-4: Stroke Swimming & Team Relay Challenge"]', 1200000, 'users', 'images/assets/program_privat.webp', 'Paket Hemat Rombongan', 6, '2026-08-02 14:27:51', '2026-08-02 14:27:51');

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `address` LONGTEXT NOT NULL,
  `map_embed_url` LONGTEXT NULL,
  `features` LONGTEXT NULL,
  `image` VARCHAR(255) NULL,
  `is_featured` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (1, 'kolam-renang-fik-uny-sleman', 'Kolam Renang FIK UNY (Sleman, Jogja)', 'Yogyakarta (Sleman)', 'Jl. Colombo No.1, Karang Gayam, Caturtunggal, Kec. Depok, Kabupaten Sleman, D.I. Yogyakarta 55281', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.189569035177!2d110.3853112!3d-7.7702812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b20ab248bf%3A0xb3adacbfdf5d16e0!2sKolam%20Renang%20FIK%20UNY!5e0!3m2!1sid!2sid!4v1700000000000', '["Standar Olahraga Internasional","Kolam Anak & Dewasa","Air Jernih Filter Berkala","Kantin & Parkir Luas"]', 'images/assets/pool_uny.webp', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (2, 'kolam-renang-depok-sport-center', 'Depok Sport Center (Seturan, Sleman)', 'Yogyakarta (Sleman)', 'Jl. Raya Seturan No.9, Kledokan, Caturtunggal, Depok, Sleman, DIY', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.076840788647!2d110.4074218!3d-7.7816828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5991c015b6cd%3A0xa193d56b02660144!2sDepok%20Sports%20Center!5e0!3m2!1sid!2sid!4v1700000000000', '["Indoor Heated Pool","Ramah Wanita & Anak","Kamar Bilas Air Hangat","Lokasi Strategis Pusat Sleman"]', 'images/assets/pool_depok.webp', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (3, 'kolam-renang-umbulharjo-jogja', 'Kolam Renang Nabtir / Umbulharjo (Kota Jogja)', 'Yogyakarta (Kota)', 'Jl. Umbulharjo Raya No. 45, Kota Yogyakarta, DIY', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.923485747683!2d110.3888321!3d-7.8081298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a579bc4cb5443%3A0xbce5b93108c48a73!2sKota%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000', '["Akses Mudah Kota Jogja","Kolam Pendek Anak","Kedalaman Bertingkat","Buka Setiap Hari"]', 'images/assets/pool_tirtasari.webp', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (4, 'kolam-renang-hyatt-regency', 'Hyatt Regency Swimming Pool (Palagan, Sleman)', 'Yogyakarta (Privat)', 'Jl. Palagan Tentara Pelajar No.KM.7, Sariharjo, Ngaglik, Sleman, DIY', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.488349280963!2d110.3708491!3d-7.7378772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58e2fb8d0f1b%3A0x7d6f51950d856012!2sHyatt%20Regency%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000', '["Suasana Resort Bintang 5","Privasi Maksimal","Air Sangat Higienis","Cocok Privat Wanita & Anak"]', 'images/assets/pool_ugm.webp', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (5, 'area-semarang', 'Mitra Kolam Renang Semarang', 'Semarang', 'Jawa Tengah - Semarang Barat, Selatan & Tembalang', '', '["Pelatih Privat Panggilan","Kolam Partner Semarang","Latihan Intensif"]', 'images/assets/pool_uny.webp', 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (6, 'area-solo', 'Mitra Kolam Renang Solo / Surakarta', 'Solo', 'Jawa Tengah - Solo Kota, Manahan & Surakarta', '', '["Instruktur Lokal Solo","Jadwal Fleksibel","Kolam Pendukung Manahan"]', 'images/assets/pool_depok.webp', 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (7, 'area-magelang', 'Mitra Kolam Renang Magelang', 'Magelang', 'Jawa Tengah - Magelang Kota & Mertoyudan', '', '["Persiapan Renang Taruna Akmil","Pelatih Teruji","Pendampingan Fisik"]', 'images/assets/program_tni.webp', 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (8, 'area-klaten', 'Mitra Kolam Renang Klaten', 'Klaten', 'Jawa Tengah - Klaten Utara, Kota & Prambanan', '', '["Kolam Rekreasi & Olahraga","Program Privat Anak & Dewasa"]', 'images/assets/pool_tirtasari.webp', 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51');

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `category` VARCHAR(255) NOT NULL,
  `question` VARCHAR(255) NOT NULL,
  `answer` LONGTEXT NOT NULL,
  `is_popular` INT NOT NULL,
  `order` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (1, 'Umum', 'Mengapa harus memilih Les Renang Jogja?', 'Les Renang Jogja didukung instruktur profesional tersertifikasi PRSI/POSSI dengan pengalaman lebih dari 10 tahun. Kami menawarkan metode ramah anak, garansi bisa renang, jadwal fleksibel, serta rasio privat 1 pelatih untuk 1-2 siswa.', 1, 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (2, 'Umum', 'Berapa lama rata-rata waktu sampai peserta bisa berenang?', 'Untuk anak-anak dan dewasa pemula tanpa trauma berat, biasanya sudah bisa mengapung dan meluncur dalam 3–4 kali pertemuan, serta menguasai 1 gaya renang (Gaya Dada) dalam 8–10 kali pertemuan.', 1, 2, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (3, 'Umum', 'Apakah ada garansi sampai bisa renang?', 'Ya! Kami memberikan garansi bimbingan tambahan bagi peserta privat yang mengambil paket reguler hingga mencapai kompetensi dasar (berani air, mengapung, meluncur, dan pernapasan dada).', 1, 3, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (4, 'Umum', 'Berapa batasan usia peserta les renang?', 'Kami melayani peserta mulai dari anak usia 3 tahun hingga dewasa usia 60+ tahun. Materi disesuaikan dengan tingkat usia dan kondisi fisik masing-masing.', 0, 4, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (5, 'Umum', 'Apakah tempat latihan bisa ditentukan oleh peserta?', 'Bisa. Peserta dapat memilih lokasi kolam renang partner kami di Jogja (UNY, Depok Sport Center, Umbulharjo, Hyatt, dll) atau kolam privat/perumahan milik peserta.', 0, 5, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (6, 'Pendaftaran', 'Bagaimana cara mendaftar les renang?', 'Pendaftaran sangat mudah! Anda cukup mengisi form online di website kami atau klik tombol WhatsApp untuk terhubung dengan Admin. Admin akan membantu memilihkan paket & jadwal terbaik.', 1, 6, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (7, 'Pendaftaran', 'Apakah ada sesi Trial / Uji Coba Gratis?', 'Ya, kami menyediakan sesi Trial Booking gratis selama 30 menit agar calon siswa dan orang tua dapat merasakan secara langsung kecocokan metode mengajar pelatih kami.', 1, 7, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (8, 'Pendaftaran', 'Bagaimana jika saya harus ijin / ganti jadwal karena sakit atau keperluan lain?', 'Jadwal latihan sangat fleksibel. Apabila berhalangan hadir, cukup beri tahu pelatih atau admin maksimal 6 jam sebelum sesi dimulai untuk dijadwalkan ulang (Reschedule) tanpa hangus.', 0, 8, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (9, 'Pendaftaran', 'Jam berapa saja sesi les renang yang tersedia?', 'Sesi tersedia setiap hari (Senin–Minggu) mulai jam 06.00 WIB pagi hingga jam 20.00 WIB malam.', 0, 9, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (10, 'Pelatih', 'Apakah ada pelatih renang wanita khusus?', 'Tentu ada. Kami memiliki tim instruktur wanita profesional khusus untuk siswa perempuan, anak-anak, atau muslimah yang menginginkan privasi penuh.', 1, 10, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (11, 'Pelatih', 'Bagaimana kualifikasi dan latar belakang pelatih Les Renang Jogja?', 'Semua pelatih kami merupakan lulusan Ilmu Keolahragaan/PJKR, memiliki lisensi PRSI/POSSI, sertifikat First Aid & Water Safety Lifeguard, serta ramah dan sabar.', 0, 11, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (12, 'Pelatih', 'Apakah pelatih turun langsung ke dalam air saat mengajar?', 'Ya, 100%! Pelatih selalu berada di dalam air mendampingi peserta secara intensif dari awal hingga akhir sesi demi keamanan dan efektivitas pembelajaran.', 0, 12, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (13, 'Kolam & Safety', 'Bagaimana dengan tiket masuk kolam renang?', 'Tiket masuk kolam untuk pelatih sudah ditanggung oleh lembaga. Tiket masuk peserta dibeli secara mandiri atau dapat dimasukkan ke dalam paket bundling khusus.', 0, 13, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (14, 'Kolam & Safety', 'Bagaimana jika peserta memiliki rasa takut / trauma mendalam pada air?', 'Kami berpengalaman menangani trauma air (aquaphobia). Metode kami diawali dengan relaksasi pernapasan, adaptasi kedalaman dangkal, dan pendekatan psikologis bertahap tanpa paksaan.', 1, 14, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (15, 'Kolam & Safety', 'Peralatan apa saja yang perlu dibawa saat latihan?', 'Peserta cukup membawa baju renang yang nyaman, kacamata renang, dan papan pelampung (jika ada). Kami juga menyediakan pelampung bantu selama sesi latihan.', 0, 15, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (16, 'TNI/POLRI & Terapi', 'Bagaimana metode program khusus tes TNI / POLRI / Kedinasan?', 'Fokus pada pencapaian target waktu tercepat 50m (Gaya Dada Militer & Gaya Bebas), ketahanan napas, serta simulasi penilaian riil sesuai petunjuk teknis seleksi tes kesamaptaan.', 1, 16, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (17, 'TNI/POLRI & Terapi', 'Apakah program Terapi Renang aman untuk penderita Skoliosis & Saraf Kejepit (HNP)?', 'Sangat aman dan sangat direkomendasikan dokter spesialis ortopedi karena olahraga air mengurangi beban gravitasi pada tulang belakang. Gerakan akan disesuaikan dengan kurikulum terapi medis.', 0, 17, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (18, 'Pembayaran', 'Bagaimana sistem pembayaran les renang?', 'Pembayaran dapat dilakukan secara tunai atau transfer bank / QRIS setelah sesi pertama atau saat konfirmasi pendaftaran paket.', 0, 18, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (19, 'Pembayaran', 'Apakah ada potongan harga / promo untuk pendaftaran kakak-adik atau grup?', 'Ada! Kami memberikan diskon khusus 10-20% untuk pendaftaran 2 peserta sekaligus (Kakak-Adik / Suami-Istri) atau paket grup keluarga.', 1, 19, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (20, 'Pembayaran', 'Apakah paket pertemuan memiliki batas kadaluarsa waktu?', 'Paket 8 kali pertemuan memiliki masa aktif fleksibel hingga 2 bulan, sehingga sangat aman jika Anda memiliki kesibukan atau liburan.', 0, 20, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (21, 'Umum', 'Apakah Les Renang Jogja juga melayani luar area kota Yogyakarta?', 'Ya, kami melayani seluruh wilayah DIY (Sleman, Bantul, Kota, Kulon Progo) serta kota sekitarnya seperti Semarang, Solo, Magelang, dan Klaten untuk sistem privat panggilan.', 0, 21, '2026-08-02 14:27:51', '2026-08-02 14:27:51');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NOT NULL,
  `excerpt` LONGTEXT NOT NULL,
  `content` LONGTEXT NOT NULL,
  `image` VARCHAR(255) NULL,
  `author` VARCHAR(255) NOT NULL,
  `reading_time` INT NOT NULL,
  `views` INT NOT NULL,
  `published_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (1, '5-tips-mengatasi-anak-takut-air-saat-belajar-renang', '5 Tips Efektif Mengatasi Anak Takut Air Saat Pertama Kali Belajar Renang', 'Parenting', 'Anak panik atau menangis saat berada di kolam renang? Ketahui trik psikologis dan metode fun learning agar anak berani dan antusias belajar renang.', '<p>Rasa takut terhadap air (Aquaphobia) adalah hal yang sangat alami terjadi pada anak-anak usia 3 hingga 7 tahun. Sebagai orang tua, pemaksaan atau melempar anak ke dalam air justru bisa menimbulkan trauma jangka panjang.</p><h3>1. Mulai dengan Bermain Air di Rumah</h3><p>Kenalkan sensasi air yang menyenangkan lewat mainan saat mandi di bathtub atau kolam tiup di halaman rumah.</p><h3>2. Gunakan Alat Bantu Warna-Warni</h3><p>Kacamata renang bermotif lucu dan pelampung karakter favorit akan menambah rasa aman anak.</p><h3>3. Pilih Pelatih Renang Privat Berpengalaman</h3><p>Pelatih renang anak profesional memiliki pendekatan khusus untuk membangun kepercayaan (Water Confidence) sebelum mengajarkan teknik gerakan.</p>', 'images/assets/program_anak.webp', 'Coach Hendra (Senior Instructor)', 4, 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (2, 'panduan-lengkap-tes-renang-tni-polri-target-waktu-dan-teknik', 'Panduan Lengkap Tes Renang TNI & POLRI: Target Waktu, Teknik Dada Militer & Kesalahan Fatal', 'Persiapan TNI', 'Ingin meraih nilai 100 pada tes renang kesamaptaan TNI/POLRI? Simak rahasia kayuhan efisien, posisi tubuh streamline, dan pernapasan 50 meter tanpa henti.', '<p>Tes renang merupakan salah satu item penting dalam Ujian Kesamaptaan Jasmani seleksi TNI AD, AL, AU, Akpol, maupun Bintara POLRI. Jarak yang diujikan adalah 50 meter gaya dada (militer) atau gaya bebas.</p><h3>Target Waktu Nilai Maksimal (100)</h3><p>Untuk Bintara dan Akpol, waktu di bawah 45 detik untuk 50 meter akan memberikan nilai sempurna. Kuncinya ada pada dorongan kaki (leg kick push) yang kuat dan gliding jarak jauh.</p><h3>Kesalahan Fatal Peserta Tes</h3><ul><li>Kaki tidak dibuka sempurna saat dorongan gaya dada</li><li>Pengambilan napas yang terlalu tinggi hingga merusak hidrodinamika tubuh</li><li>Panik dan kehabisan tenaga di pertengahan lintasan (25 meter)</li></ul>', 'images/assets/program_tni.webp', 'Coach Serka (Purn) Danu', 6, 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (3, 'manfaat-luar-biasa-renang-untuk-penderita-asma-dan-skoliosis', 'Manfaat Luar Biasa Olahraga Renang untuk Penderita Asma dan Tulang Belakang Skoliosis', 'Kesehatan', 'Mengapa dokter Ortopedi dan Paru sangat merekomendasikan renang? Baca penjelasan medis mengenai efek gaya apung air terhadap struktur tubuh.', '<p>Renang adalah satu-satunya jenis olahraga yang melatih seluruh kelompok otot utama tanpa memberikan tekanan benturan (impact zero) pada persendian dan tulang belakang.</p><h3>Manfaat untuk Skoliosis & Saraf Kejepit</h3><p>Saat tubuh mengapung di air, gravitasi yang menekan tulang belakang berkurang hingga 80%. Ini memberikan ruang bagi diskus intervertebralis untuk kembali ke posisi rileks.</p>', 'images/assets/program_terapi.webp', 'Dr. Fitriana, Sp.KO & Coach Team', 5, 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (4, 'rekomendasi-kolam-renang-terbaik-di-jogja-untuk-belajar-privat', 'Rekomendasi 7 Kolam Renang Terbaik di Jogja yang Bersih, Nyaman, & Cocok untuk Belajar Privat', 'Tips Renang', 'Mencari tempat latihan renang di Yogyakarta dengan air jernih dan fasilitas lengkap? Ini daftar kolam renang partner terbaik di Sleman, Bantul, dan Kota Jogja.', '<p>Kenyamanan dan kebersihan air kolam renang sangat mempengaruhi kecepatan proses belajar peserta. Berikut adalah daftar kolam renang rekomendasi dari tim Les Renang Jogja.</p>', 'images/assets/pool_uny.webp', 'Tim Redaksi Les Renang Jogja', 5, 0, '2026-08-02 14:27:51', '2026-08-02 14:27:51', '2026-08-02 14:27:51');

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL,
  `program` VARCHAR(255) NOT NULL,
  `rating` INT NOT NULL,
  `review` LONGTEXT NOT NULL,
  `avatar` VARCHAR(255) NULL,
  `video_url` VARCHAR(255) NULL,
  `is_featured` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `created_at`, `updated_at`) VALUES (1, 'Ibu Ratna Dewi & Kenzo (7 th)', 'Orang Tua Murid (Sleman)', 'Les Renang Anak Privat', 5, 'Alhamdulillah Kenzo yang tadinya panik kalau kena air dalam, sekarang di pertemuan ke-4 sudah bisa gaya dada dan meluncur dengan ceria! Pelatihnya sabar sekali & komunikatif.', 'images/assets/coach_hendra.webp', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `created_at`, `updated_at`) VALUES (2, 'Bagas Prasetyo', 'Peserta Seleksi Bintara POLRI 2026', 'Persiapan Tes TNI/POLRI', 5, 'Sebelum latihan di sini renang 50m saya memakan waktu 1 menit 15 detik. Setelah dirombak tekniknya oleh Coach Les Renang Jogja, waktu saya tembus 42 detik dan lulus tes renang angka 100!', 'images/assets/coach_danu.webp', 'https://www.youtube.com/embed/dQw4w9WgXcQ', 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `created_at`, `updated_at`) VALUES (3, 'Siti Nurhaliza, S.E.', 'Dewasa Pemula (Muslimah)', 'Les Renang Wanita Privat', 5, 'Sebagai wanita karir dan muslimah, saya merasa sangat nyaman karena dilatih oleh mba pelatih wanita. Kolamnya privat, suasananya tenang, dan dalam 5 kali latihan sudah berani mengapung di kolam dalam!', 'images/assets/coach_rina.webp', NULL, 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `created_at`, `updated_at`) VALUES (4, 'Dr. H. Hendra Wijaya', 'Pasien Terapi Skoliosis (45 th)', 'Terapi Renang Medis', 5, 'Sakit punggung karena HNP berkurang drastis setelah rutin terapi air di Les Renang Jogja. Pelatih benar-benar paham teknik hydrotherapy yang aman sesuai arahan dokter saya.', 'images/assets/coach_bima.webp', NULL, 1, '2026-08-02 14:27:51', '2026-08-02 14:27:51');

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE `registrations` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL,
  `age_category` VARCHAR(255) NOT NULL,
  `program_name` VARCHAR(255) NOT NULL,
  `preferred_location` VARCHAR(255) NOT NULL,
  `preferred_schedule` VARCHAR(255) NOT NULL,
  `notes` LONGTEXT NULL,
  `status` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `trial_bookings`;
CREATE TABLE `trial_bookings` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `parent_name` VARCHAR(255) NOT NULL,
  `participant_name` VARCHAR(255) NOT NULL,
  `participant_age` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `program_name` VARCHAR(255) NOT NULL,
  `preferred_location` VARCHAR(255) NOT NULL,
  `trial_date` VARCHAR(255) NOT NULL,
  `trial_time` VARCHAR(255) NOT NULL,
  `notes` LONGTEXT NULL,
  `status` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


SET FOREIGN_KEY_CHECKS=1;
