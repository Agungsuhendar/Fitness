<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramApiController extends Controller
{
    /**
     * Get All Programs & Membership Pricing
     */
    public function index()
    {
        $programs = Program::orderBy('order', 'asc')->get();

        if ($programs->isEmpty()) {
            // Default Programs Fallback if DB is empty
            $programs = [
                [
                    'id' => 1,
                    'slug' => 'personal-trainer-privat',
                    'title' => 'VIP Personal Trainer 1-on-1',
                    'subtitle' => 'Bimbingan privat bergaransi hasil dengan Personal Trainer tersertifikasi',
                    'price_start' => 2500000,
                    'badge' => 'MOST POPULAR',
                    'features' => ['12 Sesi Privat 1-on-1', 'Free InBody Scan', 'Garansi Body Transformation'],
                ],
                [
                    'id' => 2,
                    'slug' => 'membership-gym-pass',
                    'title' => 'Monthly Gym Pass VIP',
                    'subtitle' => 'Akses tak terbatas ke seluruh alat fitness & fasilitas shower VIP',
                    'price_start' => 299000,
                    'badge' => 'BEST VALUE',
                    'features' => ['Unlimited Access', 'Free Locker & Shower', 'Free Locker Key'],
                ],
                [
                    'id' => 3,
                    'slug' => 'tni-polri-preparation',
                    'title' => 'Persiapan Tes TNI / POLRI',
                    'subtitle' => 'Pelatihan fisik terukur khusus tes samapta kedinasan & Akpol/Akmil',
                    'price_start' => 3200000,
                    'badge' => 'SPECIALIZED',
                    'features' => ['Simulasi Tes Samapta', 'Program Lari & Pull Up', 'Nutrisi Stamina'],
                ]
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar program fitness.',
            'data' => $programs
        ]);
    }

    /**
     * Get Single Program Detail by Slug or ID
     */
    public function show($identifier)
    {
        $program = Program::where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->first();

        if (!$program) {
            return response()->json([
                'success' => false,
                'message' => 'Program tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $program
        ]);
    }
}
