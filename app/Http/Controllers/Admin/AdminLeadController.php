<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\TrialBooking;

class AdminLeadController extends Controller
{
    public function registrations()
    {
        // Auto-create table if not exists
        if (!\Illuminate\Support\Facades\Schema::hasTable('registrations')) {
            \Illuminate\Support\Facades\Schema::create('registrations', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('phone');
                $table->string('email')->nullable();
                $table->string('age_category')->nullable();
                $table->string('program_name')->nullable();
                $table->string('preferred_location')->nullable();
                $table->string('preferred_schedule')->nullable();
                $table->text('notes')->nullable();
                $table->string('status')->default('baru');
                $table->timestamps();
            });
        }

        // Auto-seed dummy registrations if empty
        if (Registration::count() === 0) {
            $dummyRegistrations = [
                [
                    'name' => 'Budi Santoso',
                    'phone' => '081298765432',
                    'email' => 'budi.santoso@gmail.com',
                    'age_category' => 'Anak-Anak (6-12 Tahun)',
                    'program_name' => 'Paket Les Renang Anak',
                    'preferred_location' => 'Kolam Renang UNY Sleman',
                    'preferred_schedule' => 'Sabtu & Minggu Pagi (07.00 - 08.30)',
                    'notes' => 'Anak belum pernah belajar renang, sedikit takut air.',
                    'status' => 'baru',
                    'created_at' => now()->subDays(2),
                ],
                [
                    'name' => 'Siti Rahmawati',
                    'phone' => '085712345678',
                    'email' => 'siti.rahma@yahoo.com',
                    'age_category' => 'Dewasa (18+ Tahun)',
                    'program_name' => 'Paket Privat Wanita / Muslimah',
                    'preferred_location' => 'Kolam Renang Depok Jogja',
                    'preferred_schedule' => 'Selasa & Kamis Sore (16.00 - 17.30)',
                    'notes' => 'Menginginkan pelatih khusus wanita.',
                    'status' => 'dihubungi',
                    'created_at' => now()->subDays(1),
                ],
                [
                    'name' => 'Fajri Kurniawan',
                    'phone' => '082145678901',
                    'email' => 'fajri.tni@gmail.com',
                    'age_category' => 'Dewasa (18+ Tahun)',
                    'program_name' => 'Kelas Intensif TNI & POLRI',
                    'preferred_location' => 'Kolam Renang FIK UNY',
                    'preferred_schedule' => 'Senin - Jumat Pagi (06.00 - 07.30)',
                    'notes' => 'Persiapan tes Bintara POLRI 2026, fokus ketahanan napas & gaya dada.',
                    'status' => 'dikonfirmasi',
                    'created_at' => now(),
                ],
            ];

            foreach ($dummyRegistrations as $data) {
                Registration::create($data);
            }
        }

        $registrations = Registration::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.leads.registrations', compact('registrations'));
    }

    public function trials()
    {
        // Auto-create table if not exists
        if (!\Illuminate\Support\Facades\Schema::hasTable('trial_bookings')) {
            \Illuminate\Support\Facades\Schema::create('trial_bookings', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('parent_name')->nullable();
                $table->string('participant_name');
                $table->string('participant_age')->nullable();
                $table->string('phone');
                $table->string('program_name')->nullable();
                $table->string('preferred_location')->nullable();
                $table->date('trial_date')->nullable();
                $table->string('trial_time')->nullable();
                $table->text('notes')->nullable();
                $table->string('status')->default('menunggu');
                $table->timestamps();
            });
        }

        // Auto-seed dummy trials if empty
        if (TrialBooking::count() === 0) {
            $dummyTrials = [
                [
                    'parent_name' => 'Ibu Anisa',
                    'participant_name' => 'Naufal',
                    'participant_age' => '8 Tahun',
                    'phone' => '081399887766',
                    'program_name' => 'Trial Class Les Renang Anak',
                    'preferred_location' => 'Kolam Renang UNY Sleman',
                    'trial_date' => now()->addDays(2)->format('Y-m-d'),
                    'trial_time' => '08:00 WIB',
                    'notes' => 'Ingin uji coba 1 kali sesi sebelum daftar paket full 8x pertemuan.',
                    'status' => 'menunggu',
                    'created_at' => now()->subDays(2),
                ],
                [
                    'parent_name' => 'Bapak Haryono',
                    'participant_name' => 'Alya',
                    'participant_age' => '10 Tahun',
                    'phone' => '087711223344',
                    'program_name' => 'Trial Class Les Renang Anak',
                    'preferred_location' => 'Kolam Renang FIK UNY',
                    'trial_date' => now()->addDays(3)->format('Y-m-d'),
                    'trial_time' => '16:00 WIB',
                    'notes' => 'Anak suka berenang tapi belum paham teknik pernapasan.',
                    'status' => 'dikonfirmasi',
                    'created_at' => now()->subDays(1),
                ],
                [
                    'parent_name' => 'Rizky Febrian (Sendiri)',
                    'participant_name' => 'Rizky Febrian',
                    'participant_age' => '21 Tahun',
                    'phone' => '089655443322',
                    'program_name' => 'Trial Class Persiapan TNI POLRI',
                    'preferred_location' => 'Kolam Renang Depok Jogja',
                    'trial_date' => now()->addDays(4)->format('Y-m-d'),
                    'trial_time' => '06:30 WIB',
                    'notes' => 'Tes kemampuan awal renang 50 meter gaya bebas.',
                    'status' => 'selesai',
                    'created_at' => now(),
                ],
            ];

            foreach ($dummyTrials as $data) {
                TrialBooking::create($data);
            }
        }

        $trials = TrialBooking::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.leads.trials', compact('trials'));
    }
}
