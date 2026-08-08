<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainerBooking;
use App\Models\FitnessClass;
use App\Models\User;
use Carbon\Carbon;

class BookingApiController extends Controller
{
    /**
     * Get list of active & past bookings for member
     * GET /api/v1/bookings
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $userId = $user ? $user->id : 1;

        $bookings = TrainerBooking::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil daftar reservasi booking.',
            'data' => $bookings,
        ]);
    }

    /**
     * Create new PT 1-on-1 or Group Class Booking
     * POST /api/v1/bookings
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'booking_type' => 'nullable|string', // 'trainer' or 'class'
            'coach_name' => 'nullable|string',
            'class_name' => 'nullable|string',
            'booking_date' => 'required|string',
            'booking_time' => 'required|string',
            'branch' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $memberId = $user ? $user->id : 1;
        $memberName = $user ? $user->name : ($request->input('member_name') ?: 'Member VIP FitLife');
        $branch = $validated['branch'] ?? ($user->branch ?? 'Sleman HQ (Jl. Kaliurang)');
        $bookingType = $validated['booking_type'] ?? ($request->filled('class_name') ? 'class' : 'trainer');

        $coachOrClassName = $bookingType === 'class'
            ? ($validated['class_name'] ?? 'Kelas Gym FitLife')
            : ($validated['coach_name'] ?? 'Coach Bima Sakti');

        // Parse date safely
        try {
            $formattedDate = Carbon::parse($validated['booking_date'])->format('Y-m-d');
        } catch (\Exception $e) {
            $formattedDate = now()->format('Y-m-d');
        }

        // Create Trainer Booking Record
        $booking = TrainerBooking::create([
            'user_id' => $memberId,
            'member_name' => $memberName,
            'coach_name' => $coachOrClassName,
            'booking_date' => $formattedDate,
            'booking_time' => $validated['booking_time'],
            'branch' => $branch,
            'status' => 'CONFIRMED',
            'notes' => $validated['notes'] ?? ($bookingType === 'class' ? 'Reservasi Kursi Kelas Gym' : 'Booking Sesi 1-on-1 Personal Trainer'),
        ]);

        // If it's a fitness class, increment booked count
        if ($bookingType === 'class' && !empty($validated['class_name'])) {
            $fitnessClass = FitnessClass::where('name', 'LIKE', '%' . $validated['class_name'] . '%')->first();
            if ($fitnessClass) {
                $fitnessClass->increment('booked_count');
            }
        }

        // If user logged in, update next_session info & decrement remaining sessions
        if ($user) {
            $user->next_session = Carbon::parse($formattedDate)->translatedFormat('l, d F Y') . ' • ' . $validated['booking_time'];
            if ($user->remaining_sessions && $user->remaining_sessions > 0) {
                $user->remaining_sessions -= 1;
            }
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => $bookingType === 'class'
                ? 'Reservasi Kursi Kelas Gym BERHASIL dikonfirmasi!'
                : 'Jadwal Latihan bersama ' . $coachOrClassName . ' BERHASIL dikonfirmasi!',
            'data' => $booking,
        ], 201);
    }
}
