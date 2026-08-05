<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\TrialBooking;

class LeadController extends Controller
{
    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'age_category' => 'required|string',
            'program_name' => 'required|string',
            'preferred_location' => 'required|string',
            'preferred_schedule' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $registration = Registration::create($validated);

        // Target WhatsApp phone number (Admin FitLife Gym Jogja)
        $targetWa = '6281234567890'; // Default admin contact

        $waMessage = "Halo Admin FitLife Gym Jogja, saya ingin mendaftar fitness & personal trainer!%0A%0A"
            . "*Data Pendaftar:*%0A"
            . "• Nama: {$registration->name}%0A"
            . "• WhatsApp: {$registration->phone}%0A"
            . "• Kategori Usia: {$registration->age_category}%0A"
            . "• Program Pilihan: {$registration->program_name}%0A"
            . "• Lokasi Gym: {$registration->preferred_location}%0A"
            . "• Jadwal Mulai: {$registration->preferred_schedule}%0A"
            . ($registration->notes ? "• Catatan Tambahan: {$registration->notes}%0A" : "")
            . "%0AMohon informasi ketersediaan pelatih dan konfirmasi pendaftaran. Terima kasih!";

        $waUrl = "https://wa.me/{$targetWa}?text={$waMessage}";

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim! Anda akan diarahkan ke WhatsApp Admin.',
                'wa_url' => $waUrl
            ]);
        }

        return redirect()->away($waUrl);
    }

    public function storeTrial(Request $request)
    {
        $validated = $request->validate([
            'parent_name' => 'required|string|max:255',
            'participant_name' => 'required|string|max:255',
            'participant_age' => 'required|string|max:50',
            'phone' => 'required|string|max:30',
            'program_name' => 'required|string',
            'preferred_location' => 'required|string',
            'trial_date' => 'required|date',
            'trial_time' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ]);

        $trial = TrialBooking::create($validated);

        $targetWa = '6281234567890';

        $waMessage = "Halo Admin FitLife Gym Jogja, saya ingin Booking Trial Gratis!%0A%0A"
            . "*Data Booking Trial:*%0A"
            . "• Nama Orang Tua/Pendaftar: {$trial->parent_name}%0A"
            . "• Nama Peserta: {$trial->participant_name} ({$trial->participant_age})%0A"
            . "• WhatsApp: {$trial->phone}%0A"
            . "• Program: {$trial->program_name}%0A"
            . "• Lokasi: {$trial->preferred_location}%0A"
            . "• Tanggal Trial: " . $trial->trial_date->format('d-m-Y') . "%0A"
            . "• Waktu Trial: {$trial->trial_time}%0A"
            . "%0AMohon konfirmasi slot jadwal trial. Terima kasih!";

        $waUrl = "https://wa.me/{$targetWa}?text={$waMessage}";

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking Trial berhasil dikirim! Silakan verifikasi via WhatsApp.',
                'wa_url' => $waUrl
            ]);
        }

        return redirect()->away($waUrl);
    }
}
