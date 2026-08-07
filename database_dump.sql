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
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2026_08_05_100008_create_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2026_08_05_100009_create_coaches_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2026_08_05_100010_create_videos_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2026_08_05_100011_create_features_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2026_08_07_000001_add_member_fields_to_users_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2026_08_07_000002_create_attendances_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2026_08_07_000003_create_payments_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2026_08_07_000004_create_pos_products_and_transactions_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2026_08_07_000005_create_trainer_bookings_table', 6);

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
  `phone` VARCHAR(255) NULL,
  `role` VARCHAR(255) NOT NULL,
  `member_card_id` VARCHAR(255) NULL,
  `membership_type` VARCHAR(255) NULL,
  `status` VARCHAR(255) NOT NULL,
  `branch` VARCHAR(255) NULL,
  `total_sessions` INT NOT NULL,
  `completed_sessions` INT NOT NULL,
  `remaining_sessions` INT NOT NULL,
  `assigned_coach` VARCHAR(255) NULL,
  `next_session` VARCHAR(255) NULL,
  `initial_weight` DOUBLE NULL,
  `current_weight` DOUBLE NULL,
  `target_weight` DOUBLE NULL,
  `initial_bodyfat` DOUBLE NULL,
  `current_bodyfat` DOUBLE NULL,
  `muscle_mass` VARCHAR(255) NULL,
  `reward_points` INT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (1, 'Admin ApexFitness', 'admin@apexfitness.id', NULL, '$2y$12$WMXHtYrp7ffrvBd7QfmJh.JylorM4nfxc0KBBGhljgFe/dV.IzK6O', NULL, '2026-08-05 16:28:50', '2026-08-07 01:52:41', NULL, 'admin', NULL, NULL, 'active', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (2, 'Admin FitLife Center', 'admin@fitlifecenter.id', NULL, '$2y$12$1gFteMBcOsa/MdefTADdk.uli8B.E9uzqnNuaQOOc3D5.cDBlgXMu', NULL, '2026-08-05 18:16:08', '2026-08-07 01:52:41', NULL, 'admin', NULL, NULL, 'active', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (3, 'Admin FitLife Owner', 'admin@fitlife.id', NULL, '$2y$12$LNqo76Hgv/9fGSxPufW6.eYNyd/SyZtrBdxneNtw.KFqPR7/.IV12', NULL, '2026-08-07 00:12:50', '2026-08-07 01:52:41', '081234567890', 'admin', 'FL-ADM-001', NULL, 'active', 'Sleman HQ (Jl. Kaliurang)', 16, 4, 12, 'Coach Hendra APKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (4, 'Admin LesRenang Utama', 'admin@lesrenangjogja.com', NULL, '$2y$12$96YEvPKVDa94WdmndF8zIelMW0AWLNnUj6lovyxws9cHMFrVzgk6e', NULL, '2026-08-07 00:12:50', '2026-08-07 01:52:41', NULL, 'admin', NULL, NULL, 'active', NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (5, 'Maya Resepsionis Kasir', 'kasir@fitlife.id', NULL, '$2y$12$hImTqnMGLEaXQORqJP0.iO05fuIjmEodRvw.88Pff.9aZo6iKuPqy', NULL, '2026-08-07 01:46:14', '2026-08-07 01:52:41', '081234567891', 'receptionist', 'FL-KAS-002', NULL, 'active', 'Sleman HQ (Jl. Kaliurang)', 16, 4, 12, 'Coach Hendra APKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (6, 'Coach Hendra APKI', 'coach@fitlife.id', NULL, '$2y$12$NlcMgBgB9X06LjVw6jOEO.GQg0fQ6ehQMkHvvT9kcOwDacKZIt3TW', NULL, '2026-08-07 01:46:14', '2026-08-07 01:52:41', '081234567892', 'coach', 'FL-COA-003', NULL, 'active', 'Sleman HQ (Jl. Kaliurang)', 16, 4, 12, 'Coach Hendra APKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `role`, `member_card_id`, `membership_type`, `status`, `branch`, `total_sessions`, `completed_sessions`, `remaining_sessions`, `assigned_coach`, `next_session`, `initial_weight`, `current_weight`, `target_weight`, `initial_bodyfat`, `current_bodyfat`, `muscle_mass`, `reward_points`) VALUES (7, 'Budi Pratama Member', 'member@fitlife.id', NULL, '$2y$12$fLibfAG1J4qwqmEZhZeIVugH.nHlMPUCJfnBFQKgKfQyUhTVG8R.W', NULL, '2026-08-07 01:46:15', '2026-08-07 01:52:42', '081234567893', 'member', 'FL-MEM-004', NULL, 'active', 'Sleman HQ (Jl. Kaliurang)', 16, 4, 12, 'Coach Hendra APKI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50);

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

INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (1, 'weight-loss-fat-burn', 'Weight Loss & Body Transformation', 'Program penurunan berat badan intensif, pemangkasan lemak, & pembentukan lekuk tubuh ideal.', 'Pria & Wanita yang ingin turun berat badan 5–25 kg dengan aman tanpa efek rebound.', 'Program bimbingan privat 1-on-1 gabungan latihan HIIT, Strength Training, dan panduan kalori nutrition plan harian yang disesuaikan metabolisme tubuh Anda. Hasil terukur dengan InBody 3D Scan berkala.', '["Personal Trainer Privat 1-on-1 tersertifikasi APKI","InBody 3D Scan Komposisi Tubuh Gratis Setiap 2 Minggu","Custom Meal Plan & Panduan Defisit Kalori Harian","Garansi Lingkar Pinggang & Lemak Tubuh Berkurang","Jadwal Fleksibel (Pagi 06.00 s\\/d Malam 21.00 WIB)"]', '["Membakar lemak membandel di perut, paha, dan lengan","Meningkatkan metabolisme basal (BMR) agar tidak cepat gemuk","Meningkatkan energi harian & stamina tubuh","Membentuk postur tubuh lebih tegas & percaya diri"]', '["Fase 1 (Minggu 1-2): Body Composition Assessment, Adaptasi Kardio & Corrective Exercise","Fase 2 (Minggu 3-5): Fat Burn HIIT & Compound Movement Training (Squat, Deadlift, Bench)","Fase 3 (Minggu 6-8): Metabolic Conditioning & Hypertrophy Sculpting","Fase 4 (Minggu 9-12): Peak Transformation & Long-Term Maintenance System"]', 450000, 'fire', 'images/assets/program_dewasa.webp', 'Paling Populer', 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (2, 'muscle-building-hypertrophy', 'Muscle Building & Hypertrophy', 'Program pembentukan otot dada, bahu, lengan, & dada bidang untuk postur atletis.', 'Pria/Wanita yang ingin tambah massa otot, menaikkan berat badan bersih, & badan lebih berisi.', 'Dirancang untuk Anda yang ingin membangun otot secara proporsional dan efektif. Fokus pada Progressive Overload, form gerakan yang presisi, serta diet surplus nutrisi berprotein tinggi.', '["Privat Training dengan Metode Progressive Overload","Evaluasi Form Gerakan & Biomekanika Otot","Panduan Asupan Protein & Surplus Kalori Bersih","Latihan Beban Free Weights & Machine Gym Modern","Jadwal & Target Massa Otot Terukur Setiap Bulan"]', '["Menambah berat badan sehat melalui pembentukan otot","Menciptakan postur bahu lebar V-Taper & dada bidang","Memperkuat kepadatan tulang & sendi tubuh","Meningkatkan kadar testosterone alami & performa"]', '["Minggu 1-2: Form Mastery & Neuromuscular Mind-Muscle Connection","Minggu 3-6: Hypertrophy Split Routine (Push-Pull-Legs)","Minggu 7-10: Heavy Compound Strength & Progressive Load","Minggu 11-12: Muscle Peak & Symmetry Check"]', 500000, 'dumbbell', 'images/assets/program_tni.webp', 'Rekomendasi Bulking', 2, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (3, 'female-fitness-shaping', 'Female Fitness & Body Shaping', 'Program gym privat khusus wanita: Kencangkan perut, bokong (Glutes), & membentuk lekuk tubuh.', 'Wanita / Muslimah yang menginginkan instruktur wanita & area gym privat yang nyaman.', 'Program kebugaran wanita modern yang memadukan Strength Training ringan, Pilates Mat, dan Glute-Focused Workouts. Dilatih oleh Personal Trainer wanita profesional.', '["100% Instruktur Trainer Wanita Berlisensi","Area Studio Gym Privat Khusus Wanita (Bebas Riba & Safe Space)","Latihan Glutes, Core, Lower Body & Toned Arms","Panduan Nutrisi Hormonal & Bebas Diet Ketat Menyiksa"]', '["Membentuk lekuk tubuh hourglass & mengencangkan bagian perut","Menghilangkan gelambir lengan & paha dalam","Menjaga keseimbangan hormon & metabolisme wanita","Privasi 100% terjaga dengan suasana menyenangkan"]', '["Tingkat 1: Full Body Mobility, Core Stabilization & Glute Activation","Tingkat 2: Sculpting Lower Body & Tone Upper Body","Tingkat 3: High Intensity Body Shaping & Pilates Core Fusion"]', 480000, 'sparkles', 'images/assets/program_wanita.webp', '100% Trainer Wanita', 3, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (4, 'calisthenics-strength-conditioning', 'Strength & Conditioning / Persiapan Fisik TNI-POLRI', 'Program ketahanan fisik militer, latihan kalistenik, lari stamina, & pull-up maksimal.', 'Calon Taruna/Akpol, Bintara, POLRI, Kedinasan, & Atlet Performance.', 'Persiapan fisik komprehensif untuk mencapai standar tes Kesamaptaan Jasmani TNI-POLRI (Push-up, Sit-up, Pull-up, Shuttle Run, & Lari 12 Menit). Mentoring fisik ketat untuk nilai skor 100.', '["Simulasi Tes Kesamaptaan Standar Mabes TNI\\/POLRI","Pelatihan Drill Pull-Up, Push-Up Presisi, & Shuttle Run","Peningkatan Kapasitas Paru (VO2 Max) & Stamina Lari","Evaluasi Video Biomekanika Gerakan Nilai Maksimal","Pendampingan Nutrisi & Fisik Harian"]', '["Memastikan lulus passing grade tinggi dengan nilai 100","Meningkatkan daya tahan kardiovaskular & kekuatan otot","Membentuk mental disiplin & pantang menyerah"]', '["Minggu 1: Baseline Physical Diagnostic & Form Correction","Minggu 2-4: Core Power, Calisthenics Progression & Pull-up Mastery","Minggu 5-7: Speed & VO2 Max Interval Running Training","Minggu 8: Trial Test Simulation & Peak Performance Readiness"]', 550000, 'shield-check', 'images/assets/program_anak.webp', 'Garansi Skor Target', 4, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (5, 'posture-rehab-functional', 'Posture Correction & Rehab Fungsional', 'Pemulihan skoliosis, sakit pinggang (HNP/Saraf Kejepit), bahu bungkuk, & mobilitas sendi.', 'Pekerja kantoran, penderita bungkuk (Kyphosis), nyeri pinggang, & rehabilitasi cedera.', 'Program terapi latihan fungsional khusus untuk memperbaiki postur tubuh, menghilangkan rasa pegal kronis leher & punggung, serta memperkuat otot penopang tulang belakang.', '["Assesment Postur Tubuh & Mobilitas Sendi 3D","Latihan Corrective Movement & Spinal Decompression","Penanganan Kyphosis (Bahu Bungkuk) & Forward Head Posture","Bimbingan Terapi Ringan Tanpa Risiko Cedera"]', '["Menghilangkan nyeri punggung bawah (LBP) & saraf kejepit","Memperbaiki postur berdiri & duduk agar tampak lebih tegap","Meningkatkan fleksibilitas & kenyamanan gerak harian"]', '["Fase 1: Pain Relief & Core Muscle Activation","Fase 2: Spinal Realignment & Scapular Stabilization","Fase 3: Functional Strength & Posture Maintenance"]', 500000, 'heart-pulse', 'images/assets/program_terapi.webp', 'Rekomendasi Medis', 5, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `programs` (`id`, `slug`, `title`, `subtitle`, `target_audience`, `description`, `features`, `benefits`, `curriculum`, `price_start`, `icon`, `image`, `badge`, `order`, `created_at`, `updated_at`) VALUES (6, 'corporate-wellness-group', 'Corporate Wellness & Group Fitness Class', 'Program kebugaran karyawan instansi, perusahaan, & kelas grup HIIT / Crossfit.', 'Perusahaan, instansi pemerintah, BUMN, sekolah, & komunitas fitness.', 'Paket pelatihan kebugaran kelompok untuk meningkatkan produktivitas karyawan, kesehatan fisik tim, dan ikatan kebersamaan perusahaan melalui kelas latihan seru.', '["Tim Personal Trainer Complete membawa peralatan","Medical & Physical Checkup Karyawan Berkala","Pilihan Kelas: HIIT Functional, Yoga BootCamp, Zumba\\/Crossfit","Diskon Khusus Rombongan Instansi"]', '["Menurunkan angka sakit karyawan & meningkatkan stamina kerja","Membangun budaya kerja sehat & kekompakan tim (Team Building)","Sesi interaktif yang menyenangkan & membakar kalori tinggi"]', '["Sesi 1: Health Assessment & Group Warmup BootCamp","Sesi 2-4: Functional Group Challenge & Cardio Burn Class"]', 1500000, 'users-three', 'images/assets/program_privat.webp', 'Paket Rombongan', 6, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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

INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (1, 'apex-gym-sleman-center', 'ApexFitness Center Sleman (Headquarters)', 'Yogyakarta (Sleman)', 'Jl. Kaliurang Km 5.5 No. 88, Caturtunggal, Depok, Sleman, D.I. Yogyakarta 55281', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.189569035177!2d110.3853112!3d-7.7702812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b20ab248bf%3A0xb3adacbfdf5d16e0!2sGym%20Fitness%20FIK%20UNY!5e0!3m2!1sid!2sid!4v1700000000000', '["Peralatan Gym Impor Hammer Strength","InBody 3D Scan Test","Area VIP PT 1-on-1","Locker & Shower Air Hangat","Protein Bar Cafe"]', 'images/assets/pool_uny.webp', 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (2, 'apex-studio-seturan', 'ApexFitness Studio Seturan (Kampus Area)', 'Yogyakarta (Sleman)', 'Jl. Raya Seturan No.12B, Caturtunggal, Depok, Sleman, DIY (Dekat UPN & YKPN)', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.076840788647!2d110.4074218!3d-7.7816828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5991c015b6cd%3A0xa193d56b02660144!2sDepok%20Sports%20Center!5e0!3m2!1sid!2sid!4v1700000000000', '["Studio HIIT & Functional Training","Khusus Mahasiswa & Umum","Free Wifi Super Cepat","Parkir Luas & Keamanan 24 Jam"]', 'images/assets/pool_depok.webp', 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (3, 'apex-gym-umbulharjo-jogja', 'ApexFitness Performance Gym (Kota Jogja)', 'Yogyakarta (Kota)', 'Jl. Umbulharjo Raya No. 45, Umbulharjo, Kota Yogyakarta, DIY', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.923485747683!2d110.3888321!3d-7.8081298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a579bc4cb5443%3A0xbce5b93108c48a73!2sKota%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000', '["Zona Bodybuilding & Heavy Lifting","Personal Trainer Sertifikasi APKI","Sauna Room","Buka 06.00 - 22.00 WIB"]', 'images/assets/pool_tirtasari.webp', 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `locations` (`id`, `slug`, `name`, `city`, `address`, `map_embed_url`, `features`, `image`, `is_featured`, `created_at`, `updated_at`) VALUES (4, 'apex-executive-hyatt', 'Apex Executive Gym & Wellness (Palagan)', 'Yogyakarta (Privat)', 'Jl. Palagan Tentara Pelajar No.KM.7, Sariharjo, Ngaglik, Sleman, DIY', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.488349280963!2d110.3708491!3d-7.7378772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a58e2fb8d0f1b%3A0x7d6f51950d856012!2sHyatt%20Regency%20Yogyakarta!5e0!3m2!1sid!2sid!4v1700000000000', '["Fasilitas Luxury Resort Bintang 5","Privasi Eksekutif Maksimal","Studio Reformer Pilates & Rehab","Hydrotherapy & Spa"]', 'images/assets/pool_ugm.webp', 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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

INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (1, 'Umum', 'Mengapa harus latihan bersama Personal Trainer di ApexFitness?', 'ApexFitness didukung oleh tim Personal Trainer tersertifikasi APKI & IFBB dengan rekam jejak sukses melatih 1000+ member. Kami menyediakan program yang disesuaikan 100% dengan kondisi fisik Anda, evaluasi InBody 3D Scan, serta panduan nutrisi harian.', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (2, 'Umum', 'Berapa lama waktu yang dibutuhkan sampai hasil terlihat?', 'Dengan mengikuti sesi PT 3x seminggu dan mematuhi panduan nutrisi, perubahan fisik awal (penurunan berat badan 2–4 kg atau peningkatan tonus otot) dapat terlihat dan terasa dalam 3–4 minggu pertama.', 1, 2, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (3, 'Umum', 'Saya pemula dan belum pernah ke gym, apakah bisa?', 'Sangat bisa! 70% member ApexFitness adalah pemula yang baru pertama kali menyentuh alat gym. Trainer kami akan membimbing secara perlahan dari pengenalan alat, form gerakan yang aman, hingga peningkatan beban bertahap.', 1, 3, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (4, 'Umum', 'Apakah ada garansi penurunan berat badan atau pembentukan otot?', 'Ya! Kami memberikan garansi bimbingan tambahan bagi peserta program komitmen yang menjalankan saran trainer & nutrisi namun belum mencapai target yang disepakati.', 0, 4, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (5, 'Personal Training', 'Bagaimana cara klaim Free Trial Sesi 1 Personal Trainer?', 'Anda cukup mengisi formulir daftar trial di website ini atau klik tombol WhatsApp Admin. Tim kami akan menjadwalkan sesi trial gratis 45 menit meliputi Body Assessment + Sesi Latihan Privat.', 1, 5, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (6, 'Personal Training', 'Apakah ada Personal Trainer wanita khusus member perempuan?', 'Tentu saja ada! Kami memiliki tim Personal Trainer wanita berpengalaman khusus untuk member wanita/muslimah yang menginginkan kenyamanan dan privasi tinggi.', 1, 6, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (7, 'Personal Training', 'Bagaimana jika jadwal saya berubah-ubah karena pekerjaan?', 'Jadwal latihan di ApexFitness super fleksibel. Anda dapat berkoordinasi langsung dengan Trainer pribadi Anda untuk menentukan jam latihan harian dari pukul 06.00 hingga 21.00 WIB.', 0, 7, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (8, 'Personal Training', 'Apakah saya mendapat panduan makanan / Diet Plan?', 'Ya, setiap paket PT sudah termasuk fasilitas Custom Meal Plan harian berdasarkan kebutuhan kalori makro (Protein, Karbohidrat, Lemak) yang disesuaikan dengan makanan kesukaan Anda.', 0, 8, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (9, 'Fasilitas & Gym', 'Peralatan apa saja yang tersedia di cabang ApexFitness?', 'Fasilitas kami dilengkapi alat strength impor kelas dunia (Hammer Strength, LifeFitness), area free weights lengkap, kardio zone (Treadmill, Assault Bike), studio kelas, locker room, shower air hangat, dan InBody Scan.', 0, 9, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (10, 'Fasilitas & Gym', 'Apakah bisa Personal Trainer datang ke rumah / gym perumahan (Home PT)?', 'Bisa. Kami melayani program Private Home Personal Training di wilayah Yogyakarta dan sekitarnya. Trainer kami akan membawa peralatan pendukung ke lokasi Anda.', 1, 10, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (11, 'Kesehatan & Rehab', 'Saya memiliki masalah nyeri pinggang / saraf kejepit, apakah aman ikut gym?', 'Sangat aman jika dibimbing trainer spesialis rehab. Program Posture Correction & Rehab kami berfokus pada dekompresi tulang belakang, peregangan otot tegang, dan penguatan otot core penopang tubuh.', 1, 11, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (12, 'Kesehatan & Rehab', 'Apakah wanita yang latihan beban tubuhnya akan menjadi kekar seperti pria?', 'Tidak! Mitos wanita kekar karena angkat beban adalah tidak benar. Secara biologis kadar hormon testosterone wanita jauh lebih rendah dari pria. Latihan beban pada wanita akan membentuk tubuh lebih ramping, kencang, dan berbentuk indah.', 0, 12, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (13, 'Persiapan TNI/POLRI', 'Bagaimana metode latihan fisik untuk persiapan tes TNI/POLRI?', 'Program difokuskan pada peningkatan jumlah repetisi Pull-Up presisi, Push-Up standar Mabes, Sit-Up, Shuttle Run cepat, dan daya tahan lari 12 menit dengan pacing yang efisien.', 1, 13, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (14, 'Pembayaran & Paket', 'Metode pembayaran apa saja yang diterima?', 'Kami menerima pembayaran Cash, Transfer Bank, QRIS, serta Cicilan 0% via Kartu Kredit / E-Wallet untuk paket membership tahunan dan paket PT.', 0, 14, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (15, 'Pembayaran & Paket', 'Apakah ada promo diskon jika daftar berdua dengan pasangan / teman?', 'Ada! Kami menyediakan Promo Couple & Buddy Package dengan diskon hingga 20% untuk pendaftaran 2 orang sekaligus.', 1, 15, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `faqs` (`id`, `category`, `question`, `answer`, `is_popular`, `order`, `created_at`, `updated_at`) VALUES (16, 'Pembayaran & Paket', 'Berapa masa berlaku paket pertemuan Sesi PT?', 'Paket 12 sesi memiliki masa aktif 2 bulan, sedangkan paket 24–48 sesi memiliki masa aktif hingga 6 bulan dengan toleransi pembekuan (cuti latihan) jika Anda bertugas luar kota.', 0, 16, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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

INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (1, 'panduan-lengkap-defisit-kalori-dan-latihan-beban-penurunan-berat-badan', 'Panduan Lengkap Defisit Kalori & Latihan Beban: Rahasia Turun BB Tanpa Efek Yoyo', 'Nutrisi & Fat Loss', 'Ingin menurunkan lemak tubuh secara permanent tanpa harus kelaparan? Pahami sains di balik perhitungan BMR, defisit kalori bersih, dan pentingnya latihan beban.', '<p>Banyak orang terjebak dalam diet ekstrem hanya makan buah atau melakukan kardio berlebihan jam-jaman. Padahal kunci sukses pemangkasan lemak jangka panjang adalah kombinasi <strong>Defisit Kalori Terukur + Latihan Beban (Strength Training)</strong>.</p><h3>1. Hitung BMR & TDEE Anda</h3><p>Basal Metabolic Rate (BMR) adalah jumlah kalori yang dibakar tubuh saat beristirahat. Untuk memangkas lemak 0.5 kg per minggu, buatlah defisit 300–500 kalori dari TDEE Anda.</p><h3>2. Utamakan Asupan Protein Tinggi</h3><p>Konsumsi protein 1.6 - 2.2 gram per kg berat badan untuk mencegah otot terkikis saat proses pembakaran lemak berlangsung.</p><h3>3. Latihan Beban Jaga Massa Otot</h3><p>Otot yang terlatih memikat metabolisme tubuh agar tetap aktif membakar kalori bahkan saat Anda sedang tidur nyenyak.</p>', 'images/assets/program_dewasa.webp', 'Coach Hendra, CSCS', 5, 0, '2026-08-07 01:52:42', '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (2, '5-kesalahan-fatal-pemula-saat-pertama-kali-latihan-di-gym', '5 Kesalahan Fatal Pemula Saat Pertama Kali Gym & Cara Menghindarnya', 'Tips Fitness', 'Baru mau mulai gym? Hindari ego lifting, abaikan pemanasan, atau form gerakan salah yang dapat memicu cedera sendi dan menghentikan progress Anda.', '<p>Memulai perjalanan kebugaran di gym adalah keputusan luar biasa. Namun, pastikan Anda menghindari 5 kesalahan umum berikut:</p><h3>1. Ego Lifting (Beban Terlalu Berat)</h3><p>Fokuslah pada teknik form gerakan yang benar terlebih dahulu sebelum menambah beban piringan berat.</p><h3>2. Melewatkan Pemanasan Dinamis</h3><p>Pemanasan sendi dan otot selama 5–10 menit sangat vital untuk melumasi cairan sinovial sendi dan mencegah kram.</p><h3>3. Tidak Memiliki Program Latihan Terstruktur</h3><p>Jangan asal mencoba alat tanpa rencana. Pakailah program split routine yang teruji seperti Push-Pull-Legs.</p>', 'images/assets/program_tni.webp', 'Coach Danu, APKI Certified', 4, 0, '2026-08-07 01:52:42', '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (3, 'rahasia-pull-up-20x-presisi-persiapan-tes-kesamaptaan-tni-polri', 'Rahasia Tembus Pull-Up 20x Presisi untuk Tes Kesamaptaan TNI & POLRI', 'Persiapan TNI', 'Kesulitan menaikkan jumlah pull-up? Pelajari teknik penguatan otot Lats, bicep grip, dan latihan negatif pull-up untuk hasil skor maksimal 100.', '<p>Pull-up merupakan tes fisik tersulit bagi banyak peserta calon Bintara dan Taruna. Untuk menguasainya, Anda butuh latihan spesifik berikut:</p><h3>1. Latihan Negative Pull-Up</h3><p>Melompat ke atas bar lalu menahan tubuh turun perlahan selama 5 detik. Ini membangun kekuatan otot dasar dengan cepat.</p><h3>2. Kuatkan Otot Core & Lats</h3><p>Pull-up bukan hanya tentang otot lengan, tetapi pelibatan otot punggung Latissimus Dorsi dan ayunan tubuh yang stabil.</p>', 'images/assets/program_anak.webp', 'Coach Serka (Purn) Danu', 6, 0, '2026-08-07 01:52:42', '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `posts` (`id`, `slug`, `title`, `category`, `excerpt`, `content`, `image`, `author`, `reading_time`, `views`, `published_at`, `created_at`, `updated_at`) VALUES (4, 'manfaat-latihan-beban-bagi-wanita-mengencangkan-tubuh-dan-cegah-osteoporosis', 'Manfaat Luar Biasa Latihan Beban bagi Wanita: Tubuh Ramping, Kencang & Bebas Osteoporosis', 'Female Fitness', 'Benarkah angkat beban bikin wanita berotot besar? Simak penjelasan ilmiah mengapa angkat beban adalah kunci utama lekuk tubuh ideal wanita.', '<p>Banyak wanita khawatir angkat beban akan membuat tubuh kekar bak binaragawan. Hal ini adalah salah kaprah. Hormon estrogen pada wanita membuat tubuh merespons latihan beban dengan bentuk yang ramping, kencang, dan proporsional.</p>', 'images/assets/program_wanita.webp', 'Coach Rina, Pilates & Strength Specialist', 4, 0, '2026-08-07 01:52:42', '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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
  `is_approved` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES (1, 'Bima Perkasa (28 th)', 'Software Engineer (Sleman)', 'Weight Loss & Body Transformation', 5, 'Turun 16 kg dalam 3 bulan! Dulu sering sakit pinggang karena kelamaan duduk koding & BB 88 kg. Dibimbing Coach ApexFitness dengan pola latihan intensif tapi tetep bisa makan nasi. Sekarang BB 72 kg & perut buncit hilang!', 'images/assets/coach_hendra.webp', 'https://www.youtube.com/embed/5ee8sX_1-9c', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES (2, 'Rian Ardianto', 'Lulusan Bintara POLRI 2026', 'Strength & Persiapan TNI-POLRI', 5, 'Awalnya pull-up cuma bisa 3x dan lari 12 menit dapet 1800m. Setelah 2 bulan gabung ApexFitness program TNI-POLRI, pull-up tembus 18x presisi & lari tembus 3100m. Nilai kesamaptaan saya dapet 100 sempurna!', 'images/assets/coach_danu.webp', 'https://www.youtube.com/embed/xVeXGKPOH58', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES (3, 'Anisa Rahma, S.Farm', 'Apoteker & Member Wanita', 'Female Fitness & Body Shaping', 5, 'Privasi luar biasa nyaman karena ada area khusus cewek & pelatih wanita yang ramah. Dalam 8 minggu paha & pinggul jadi kencang, lengan tidak gelambir lagi. Berat badan ideal & badan terasa super fit!', 'images/assets/coach_rina.webp', 'https://www.youtube.com/embed/M5cs8a3Bhfg', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `testimonials` (`id`, `name`, `role`, `program`, `rating`, `review`, `avatar`, `video_url`, `is_featured`, `is_approved`, `created_at`, `updated_at`) VALUES (4, 'Drs. Supriyanto (49 th)', 'PNS & Pasien Posture Rehab', 'Posture Correction & Rehab', 5, 'Nyeri saraf kejepit di pinggang bawah yang mengganggu tidur selama 2 tahun akhirnya sembuh total setelah terapi latihan fungsional di ApexFitness. Postur berdiri jadi tegap & rasa pegal hilang.', 'images/assets/coach_bima.webp', NULL, 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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

INSERT INTO `registrations` (`id`, `name`, `phone`, `email`, `age_category`, `program_name`, `preferred_location`, `preferred_schedule`, `notes`, `status`, `created_at`, `updated_at`) VALUES (1, 'Budi Santoso', '081234567890', 'budi@example.com', 'Dewasa Pemula', 'Weight Loss & Body Transformation', 'ApexFitness Center Sleman (HQ)', 'Pagi Hari (06:00 - 09:00 WIB)', 'Ingin turun BB 10 kg & perbaiki postur', 'pending', '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `registrations` (`id`, `name`, `phone`, `email`, `age_category`, `program_name`, `preferred_location`, `preferred_schedule`, `notes`, `status`, `created_at`, `updated_at`) VALUES (2, 'Siti Nurhaliza', '081987654321', 'siti@example.com', 'Wanita / Muslimah Privat', 'Female Fitness & Body Shaping', 'Apex Studio Seturan', 'Sore Hari (15:30 - 18:30 WIB)', 'Minta Personal Trainer wanita', 'confirmed', '2026-08-07 01:52:42', '2026-08-07 01:52:42');

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

INSERT INTO `trial_bookings` (`id`, `parent_name`, `participant_name`, `participant_age`, `phone`, `program_name`, `preferred_location`, `trial_date`, `trial_time`, `notes`, `status`, `created_at`, `updated_at`) VALUES (1, 'Bima Perkasa', 'Bima Perkasa', '28 Tahun', '081234567890', 'Weight Loss & Body Transformation', 'ApexFitness Center Sleman HQ', '2026-08-09 01:52:42', '08.00 WIB', 'Mau klaim Free InBody Scan', 'pending', '2026-08-07 01:52:42', '2026-08-07 01:52:42');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `key` VARCHAR(255) NOT NULL,
  `value` LONGTEXT NULL,
  `group` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (1, 'site_name', 'FitLife', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (2, 'whatsapp_number', '6281234567890', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (3, 'whatsapp_message', 'Halo Admin FitLife, saya ingin klaim Free Trial 7 Hari & konsultasi program fitness.', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (4, 'site_email', 'info@fitlife.id', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (5, 'site_phone', '+62 812-3456-7890', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (6, 'office_address', 'Jl. Kaliurang Km 5.5 No. 88, Sleman, D.I. Yogyakarta 55281', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (7, 'instagram_url', 'https://instagram.com/fitlife.id', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (8, 'tiktok_url', 'https://tiktok.com/@fitlife.id', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (9, 'youtube_url', 'https://youtube.com/@fitlifeid', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (10, 'site_seo_title', 'FitLife - Stronger Body, Better Life | Fitness Center Terpercaya di Yogyakarta', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (11, 'site_seo_description', 'FitLife Yogyakarta. #1 Fitness Center Terpercaya di Yogyakarta dengan bimbingan Personal Trainer profesional bersertifikasi. Trial Gratis 7 Hari Tanpa Komitmen!', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (12, 'site_footer_about', 'Pusat kebugaran fitness gym & Personal Trainer privat 1-on-1 terpercaya di Yogyakarta. Stronger Body, Better Life.', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (13, 'hero_subtitle', 'Raih versi terbaik dirimu bersama program latihan dan bimbingan profesional dari trainer berpengalaman.', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (14, 'promo_text', '🔥 Trial Gratis 7 Hari - Tanpa Komitmen', 'general', '2026-08-05 16:28:50', '2026-08-05 16:36:59');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (15, 'office_hours', 'Buka Setiap Hari: 06.00 - 22.00 WIB', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (16, 'stat_alumni', '1.000+', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (17, 'stat_alumni_label', 'Member Sukses Transformasi', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (18, 'stat_experience', '10+ Th', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (19, 'stat_experience_label', 'Pengalaman Personal Trainer', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (20, 'stat_trainers', '100%', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (21, 'stat_trainers_label', 'PT Sertifikasi APKI / IFBB', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (22, 'stat_rating', '4.9 / 5', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (23, 'stat_rating_label', 'Rating Kepuasan Member', 'general', '2026-08-05 16:28:50', '2026-08-05 16:28:50');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (24, 'site_logo_footer', 'images/logo-footer.png', 'general', '2026-08-05 18:36:25', '2026-08-05 18:40:13');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (25, 'hero_title', 'FitLife Fitness & PT Privat Jogja', 'general', '2026-08-05 18:36:25', '2026-08-05 18:36:25');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (26, 'cta_banner_title', 'Siap Memulai Perjalanan Fitness Dalam Waktu Singkat?', 'general', '2026-08-05 18:36:25', '2026-08-05 18:36:25');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (27, 'cta_banner_subtitle', 'Jangan tunda lagi! Konsultasikan kebutuhan fitness & personal trainer Anda secara gratis dengan tim admin & pelatih kami sekarang juga.', 'general', '2026-08-05 18:36:25', '2026-08-05 18:36:25');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (28, 'cta_popup_enabled', '1', 'general', '2026-08-05 18:36:25', '2026-08-05 18:36:25');
INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES (29, 'cta_popup_delay', '20', 'general', '2026-08-05 18:36:25', '2026-08-05 18:36:25');

DROP TABLE IF EXISTS `coaches`;
CREATE TABLE `coaches` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NULL,
  `specialty` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  `photo` VARCHAR(255) NULL,
  `color` VARCHAR(255) NOT NULL,
  `order` INT NOT NULL,
  `is_active` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `coaches` (`id`, `name`, `title`, `specialty`, `description`, `photo`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'Coach Hendra', 'S.Or, CSCS', 'Head PT & Weight Loss Specialist', 'Lulusan Ilmu Keolahragaan UNY & APKI Certified. Pengalaman 10+ tahun melatih 500+ member fat burn & body transformation.', 'images/assets/coach_hendra.webp', '#10b981', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `coaches` (`id`, `name`, `title`, `specialty`, `description`, `photo`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (2, 'Coach Danu', 'APKI Certified', 'Persiapan TNI/POLRI & Muscle Building', 'Mantan instruktur fisik militer. Spesialis drill kalistenik, stamina lari 12 menit, & pull-up presisi nilai 100.', 'images/assets/coach_danu.webp', '#f97316', 2, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `coaches` (`id`, `name`, `title`, `specialty`, `description`, `photo`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (3, 'Coach Rina', 'Pilates & Female Fitness Specialist', 'Female Body Shaping & Glute Workout', 'Personal Trainer wanita khusus member cewek & muslimah. Penguasaan Reformer Pilates & shaping lekuk tubuh.', 'images/assets/coach_rina.webp', '#ec4899', 3, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `coaches` (`id`, `name`, `title`, `specialty`, `description`, `photo`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (4, 'Coach Bima', 'S.Fis, AIFO', 'Posture Rehab & Pain Relief', 'Fisioterapis keolahragaan. Spesialis penanganan bungkuk (Kyphosis), scoliosis ringan, & rehabilitasi pasca cedera.', 'images/assets/coach_bima.webp', '#38bdf8', 4, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `subtitle` VARCHAR(255) NULL,
  `before_badge` VARCHAR(255) NULL,
  `after_badge` VARCHAR(255) NULL,
  `description` LONGTEXT NULL,
  `video_url` VARCHAR(255) NOT NULL,
  `thumbnail` VARCHAR(255) NULL,
  `order` INT NOT NULL,
  `is_active` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `videos` (`id`, `title`, `subtitle`, `before_badge`, `after_badge`, `description`, `video_url`, `thumbnail`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'Bima (28 Tahun)', 'Hari 1: 88 kg & Perut Buncit ➔ Hari 90: 72 kg Lean Muscle', '🔴 Hari 1: 88 kg Fat', '🟢 Hari 90: 72 kg Lean', 'Transformasi total 16 kg lemak terpangkas dalam 90 hari bimbingan privat Personal Trainer ApexFitness & custom diet plan!', 'https://www.youtube.com/embed/5ee8sX_1-9c', 'images/assets/video_thumb_daffa.png', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `videos` (`id`, `title`, `subtitle`, `before_badge`, `after_badge`, `description`, `video_url`, `thumbnail`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (2, 'Anisa (25 Tahun)', 'Bulan 1: Posture Bungkuk ➔ Bulan 3: Hourglass Shape & Toned Body', '🔴 Bulan 1: Gelambir & Bungkuk', '🟢 Bulan 3: Hourglass', 'Bimbingan Personal Trainer wanita 1-on-1. Membentuk lekuk pinggul, mengencangkan paha & memperbaiki postur tegap!', 'https://www.youtube.com/embed/M5cs8a3Bhfg', 'images/assets/video_thumb_siti.png', 2, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `videos` (`id`, `title`, `subtitle`, `before_badge`, `after_badge`, `description`, `video_url`, `thumbnail`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (3, 'Rian (Calon TNI/POLRI)', 'Hari 1: Pull-up 3x & Lari 1800m ➔ Hari 60: Pull-up 18x & Lari 3100m', '🔴 Hari 1: Skor 40', '🟢 Hari 60: Lulus 100', 'Pelatihan stamina fisik & kekuatan kalistenik intensif. Lulus tes kesamaptaan jasmani dengan nilai sempurna 100!', 'https://www.youtube.com/embed/xVeXGKPOH58', 'images/assets/video_thumb_rian.png', 3, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `icon` VARCHAR(255) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NULL,
  `color` VARCHAR(255) NOT NULL,
  `order` INT NOT NULL,
  `is_active` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `features` (`id`, `icon`, `title`, `description`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'fa-solid fa-certificate', 'Trainer Berlisensi APKI / IFBB', 'Didampingi Personal Trainer profesional tersertifikasi nasional & internasional yang berpengalaman melatih 1000+ member.', '#10b981', 1, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `features` (`id`, `icon`, `title`, `description`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (2, 'fa-solid fa-chart-line', 'InBody 3D Scan & Body Assessment', 'Evaluasi massa otot, % lemak tubuh, dan kadar metabolisme tubuh secara akurat setiap 2 minggu sekali.', '#f97316', 2, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `features` (`id`, `icon`, `title`, `description`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (3, 'fa-solid fa-person-dress', 'Trainer Wanita & Studio Privat', 'Khusus member wanita / muslimah dengan Personal Trainer wanita sabar & area studio gym privat aman 100%.', '#ec4899', 3, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');
INSERT INTO `features` (`id`, `icon`, `title`, `description`, `color`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (4, 'fa-solid fa-trophy', 'Garansi Hasil Terukur', 'Program latihan terstruktur, custom meal plan harian, & garansi pemangkasan lemak/pembentukan otot progresif.', '#38bdf8', 4, 1, '2026-08-07 01:52:42', '2026-08-07 01:52:42');

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `user_id` INT NULL,
  `member_card_id` VARCHAR(255) NOT NULL,
  `member_name` VARCHAR(255) NOT NULL,
  `branch` VARCHAR(255) NOT NULL,
  `checkin_time` DATETIME NOT NULL,
  `pt_deducted` VARCHAR(255) NOT NULL,
  `remaining_sessions_after` INT NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `notes` LONGTEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `order_id` VARCHAR(255) NOT NULL,
  `user_id` INT NULL,
  `member_name` VARCHAR(255) NOT NULL,
  `member_phone` VARCHAR(255) NOT NULL,
  `member_email` VARCHAR(255) NULL,
  `package_name` VARCHAR(255) NOT NULL,
  `gross_amount` DOUBLE NOT NULL,
  `discount_amount` DOUBLE NOT NULL,
  `net_amount` DOUBLE NOT NULL,
  `payment_type` VARCHAR(255) NULL,
  `payment_method_detail` VARCHAR(255) NOT NULL,
  `transaction_status` VARCHAR(255) NOT NULL,
  `snap_token` VARCHAR(255) NULL,
  `proof_img` VARCHAR(255) NULL,
  `paid_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `code` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) NOT NULL,
  `price` DOUBLE NOT NULL,
  `stock` INT NOT NULL,
  `image` VARCHAR(255) NULL,
  `is_active` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `pos_transactions`;
CREATE TABLE `pos_transactions` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `invoice_number` VARCHAR(255) NOT NULL,
  `member_name` VARCHAR(255) NULL,
  `member_phone` VARCHAR(255) NULL,
  `subtotal` DOUBLE NOT NULL,
  `discount` DOUBLE NOT NULL,
  `total` DOUBLE NOT NULL,
  `pay_amount` DOUBLE NOT NULL,
  `change_amount` DOUBLE NOT NULL,
  `payment_method` VARCHAR(255) NOT NULL,
  `notes` LONGTEXT NULL,
  `transacted_at` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `pos_transaction_items`;
CREATE TABLE `pos_transaction_items` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `pos_transaction_id` INT NOT NULL,
  `product_id` INT NULL,
  `product_name` VARCHAR(255) NOT NULL,
  `price` DOUBLE NOT NULL,
  `qty` INT NOT NULL,
  `subtotal` DOUBLE NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `trainer_bookings`;
CREATE TABLE `trainer_bookings` (
  `id` INT AUTO_INCREMENT NOT NULL,
  `user_id` INT NOT NULL,
  `member_name` VARCHAR(255) NOT NULL,
  `coach_name` VARCHAR(255) NOT NULL,
  `booking_date` VARCHAR(255) NOT NULL,
  `booking_time` VARCHAR(255) NOT NULL,
  `branch` VARCHAR(255) NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `notes` LONGTEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


SET FOREIGN_KEY_CHECKS=1;
