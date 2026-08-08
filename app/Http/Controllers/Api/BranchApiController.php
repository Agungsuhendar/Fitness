<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class BranchApiController extends Controller
{
    /**
     * Get Gym Branches with Live Crowd Meter
     * GET /api/v1/branches
     */
    public function index(Request $request)
    {
        $dbLocations = Location::where('is_featured', true)->get();

        if ($dbLocations->isEmpty()) {
            $branches = [
                [
                    'id' => 1,
                    'name' => 'FitLife Gym Sleman HQ',
                    'city' => 'Sleman, DIY',
                    'address' => 'Jl. Kaliurang Km 5.5 No. 18, Sleman, DIY',
                    'distance' => '1.2 km dari lokasi Anda',
                    'occupancyPercent' => 0.35,
                    'occupancyText' => 'SEPI (35% Kapasitas)',
                    'currentMembers' => 28,
                    'maxCapacity' => 80,
                    'statusColor' => 'limePrimary',
                    'image' => 'assets/images/fitlife_gym_tour.png',
                    'facilities' => ['Free Weights Arena', 'Kolam Renang Heated', 'Sauna & Locker', 'Juice Bar'],
                    'hours' => '24 Jam Nonstop',
                    'phone' => '0274-556677',
                    'map_url' => 'https://maps.google.com/?q=-7.754,110.378',
                ],
                [
                    'id' => 2,
                    'name' => 'FitLife Gym Seturan Raya',
                    'city' => 'Depok, Sleman',
                    'address' => 'Jl. Seturan Raya No. 45, Caturtunggal, Depok',
                    'distance' => '3.4 km dari lokasi Anda',
                    'occupancyPercent' => 0.82,
                    'occupancyText' => 'RAMAI (82% Kapasitas)',
                    'currentMembers' => 65,
                    'maxCapacity' => 80,
                    'statusColor' => 'roseAccent',
                    'image' => 'assets/images/fitlife_hero_gym_bg.png',
                    'facilities' => ['Studio Aerobik & Zumba', 'Spinning Cycling Studio', 'Free WiFi High-Speed'],
                    'hours' => '06.00 - 23.00 WIB',
                    'phone' => '0274-558899',
                    'map_url' => 'https://maps.google.com/?q=-7.768,110.408',
                ],
                [
                    'id' => 3,
                    'name' => 'FitLife Gym Ringroad Bantul',
                    'city' => 'Bantul, DIY',
                    'address' => 'Jl. Ringroad Selatan No. 88, Sewon, Bantul',
                    'distance' => '7.8 km dari lokasi Anda',
                    'occupancyPercent' => 0.55,
                    'occupancyText' => 'SEDANG (55% Kapasitas)',
                    'currentMembers' => 44,
                    'maxCapacity' => 80,
                    'statusColor' => 'goldAccent',
                    'image' => 'assets/images/fitlife_hero_couple.png',
                    'facilities' => ['Calisthenics Outdoor Park', 'Powerlifting Rig', 'Cafe Protein'],
                    'hours' => '06.00 - 22.00 WIB',
                    'phone' => '0274-551122',
                    'map_url' => 'https://maps.google.com/?q=-7.828,110.358',
                ],
            ];
        } else {
            $branches = $dbLocations->map(function ($loc) {
                $maxCap = $loc->max_capacity ?: 80;
                $currCap = $loc->current_capacity ?: 28;
                $pct = round($currCap / $maxCap, 2);

                $statusText = $pct >= 0.8 ? 'RAMAI (' . round($pct * 100) . '% Kapasitas)'
                            : ($pct >= 0.5 ? 'SEDANG (' . round($pct * 100) . '% Kapasitas)'
                            : 'SEPI (' . round($pct * 100) . '% Kapasitas)');

                $statusColor = $pct >= 0.8 ? 'roseAccent' : ($pct >= 0.5 ? 'goldAccent' : 'limePrimary');

                return [
                    'id' => $loc->id,
                    'name' => $loc->name,
                    'city' => $loc->city,
                    'address' => $loc->address,
                    'distance' => $loc->distance_text ?: '1.5 km dari lokasi Anda',
                    'occupancyPercent' => $pct,
                    'occupancyText' => $statusText,
                    'currentMembers' => $currCap,
                    'maxCapacity' => $maxCap,
                    'statusColor' => $statusColor,
                    'image' => $loc->image ?: 'assets/images/fitlife_gym_tour.png',
                    'facilities' => is_array($loc->features) ? $loc->features : ['Free Weights Arena', 'Sauna & Locker', 'Free WiFi'],
                    'hours' => $loc->hours ?: '24 Jam Nonstop',
                    'phone' => $loc->phone ?: '0274-556677',
                    'map_url' => $loc->map_embed_url ?: 'https://maps.google.com',
                ];
            });
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar lokasi cabang & Live Crowd Meter FitLife Gym.',
            'total_branches' => count($branches),
            'data' => $branches,
        ]);
    }
}
