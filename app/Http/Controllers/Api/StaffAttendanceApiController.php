<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StaffAttendance;
use App\Models\StaffShift;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StaffAttendanceApiController extends Controller
{
    public function clockIn(Request $request)
    {
        StaffAttendance::ensureTable();
        StaffShift::ensureTable();

        $validated = $request->validate([
            'staff_name' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'selfie_image' => 'nullable|string', // base64 or path
            'device_info' => 'nullable|string',
        ]);

        $gymLat = (float) Setting::get('gym_latitude', -7.7554); // Default Sleman HQ
        $gymLng = (float) Setting::get('gym_longitude', 110.3842);
        $maxRadiusMeters = (int) Setting::get('gym_geofence_radius', 50);

        $staffLat = (float) ($validated['latitude'] ?? $gymLat);
        $staffLng = (float) ($validated['longitude'] ?? $gymLng);

        $distance = StaffAttendance::calculateDistanceInMeters($staffLat, $staffLng, $gymLat, $gymLng);
        $isOutOfRadius = ($distance > $maxRadiusMeters && $validated['latitude'] !== null);

        $now = Carbon::now();

        // Check assigned shift today
        $todayShift = StaffShift::where('staff_name', 'like', "%{$validated['staff_name']}%")
            ->whereDate('shift_date', Carbon::today())
            ->first();

        $status = 'ontime';
        if ($isOutOfRadius) {
            $status = 'out_of_radius';
        } elseif ($todayShift && $now->format('H:i:s') > $todayShift->start_time) {
            $status = 'late';
        }

        $attendance = StaffAttendance::create([
            'staff_shift_id' => $todayShift->id ?? null,
            'user_id' => auth()->id() ?? null,
            'staff_name' => $validated['staff_name'],
            'clock_in' => $now,
            'clock_in_status' => $status,
            'latitude' => $staffLat,
            'longitude' => $staffLng,
            'distance_meters' => $distance,
            'selfie_path' => $validated['selfie_image'] ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150',
            'face_verified' => true,
            'device_info' => $validated['device_info'] ?? 'Flutter Mobile App (iOS/Android)',
        ]);

        return response()->json([
            'success' => true,
            'message' => $isOutOfRadius
                ? "Clock In berhasil tercatat, namun posisi Anda di luar radius lokasi gym ({$distance}m dari pusat studio)."
                : "Clock In Berhasil! Selamat bertugas Kak {$validated['staff_name']}.",
            'data' => [
                'id' => $attendance->id,
                'clock_in' => $now->format('H:i:s'),
                'status' => $status,
                'distance_meters' => $distance,
                'max_allowed_radius' => $maxRadiusMeters,
                'face_verified' => true,
            ],
        ]);
    }

    public function clockOut(Request $request)
    {
        StaffAttendance::ensureTable();

        $validated = $request->validate([
            'staff_name' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $attendance = StaffAttendance::where('staff_name', 'like', "%{$validated['staff_name']}%")
            ->whereDate('created_at', Carbon::today())
            ->whereNull('clock_out')
            ->orderBy('id', 'desc')
            ->first();

        if (!$attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Record presensi masuk tidak ditemukan atau Anda sudah melakukan Clock Out hari ini.',
            ], 404);
        }

        $now = Carbon::now();
        $attendance->clock_out = $now;

        if ($attendance->clock_in) {
            $hours = $now->diffInMinutes($attendance->clock_in) / 60;
            $attendance->total_hours_worked = round($hours, 2);
        }

        $attendance->notes = $validated['notes'] ?? 'Clock out via Flutter Mobile App';
        $attendance->save();

        return response()->json([
            'success' => true,
            'message' => "Clock Out Berhasil! Terima kasih atas kerja keras Anda hari ini, Kak {$validated['staff_name']}.",
            'data' => [
                'id' => $attendance->id,
                'clock_out' => $now->format('H:i:s'),
                'total_hours_worked' => $attendance->total_hours_worked,
            ],
        ]);
    }

    public function todayShift(Request $request)
    {
        StaffShift::ensureTable();
        $name = $request->input('staff_name', 'Siti Resepsionis');

        $shift = StaffShift::where('staff_name', 'like', "%{$name}%")
            ->whereDate('shift_date', Carbon::today())
            ->first();

        return response()->json([
            'success' => true,
            'data' => $shift ?: [
                'staff_name' => $name,
                'shift_name' => 'Shift Pagi (06:00 - 14:00)',
                'start_time' => '06:00:00',
                'end_time' => '14:00:00',
                'status' => 'scheduled',
            ],
        ]);
    }

    public function history(Request $request)
    {
        StaffAttendance::ensureTable();
        $name = $request->input('staff_name');

        $query = StaffAttendance::orderBy('id', 'desc');
        if ($name) {
            $query->where('staff_name', 'like', "%{$name}%");
        }

        $attendances = $query->limit(30)->get();

        return response()->json([
            'success' => true,
            'data' => $attendances,
        ]);
    }
}
