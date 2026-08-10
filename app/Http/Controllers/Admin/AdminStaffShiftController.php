<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffShift;
use App\Models\StaffAttendance;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminStaffShiftController extends Controller
{
    public function index(Request $request)
    {
        try {
            StaffShift::ensureTable();
            StaffAttendance::ensureTable();
        } catch (\Throwable $t) {}

        $today = Carbon::today();
        $date = $request->input('date', $today->format('Y-m-d'));

        try {
            $this->ensureSampleShiftsAndAttendancesSeeded();
        } catch (\Throwable $t) {}

        try {
            $shifts = StaffShift::whereDate('shift_date', $date)
                ->orderBy('start_time')
                ->get();
        } catch (\Throwable $t) {
            $shifts = collect();
        }

        try {
            $attendances = StaffAttendance::whereDate('created_at', $date)
                ->orderBy('id', 'desc')
                ->get();
        } catch (\Throwable $t) {
            $attendances = collect();
        }

        // HR Metrics
        $totalShiftStaff = $shifts->count();
        $clockedInCount = $attendances->count();
        $lateCount = $attendances->where('clock_in_status', 'late')->count();
        $outOfRadiusCount = $attendances->where('clock_in_status', 'out_of_radius')->count();

        $gymLat = Setting::get('gym_latitude', -7.7554);
        $gymLng = Setting::get('gym_longitude', 110.3842);
        $geofenceRadius = Setting::get('gym_geofence_radius', 50);

        return view('admin.staff_shifts.index', compact(
            'shifts', 'attendances', 'date', 'totalShiftStaff',
            'clockedInCount', 'lateCount', 'outOfRadiusCount',
            'gymLat', 'gymLng', 'geofenceRadius'
        ));
    }

    public function storeShift(Request $request)
    {
        StaffShift::ensureTable();

        $validated = $request->validate([
            'staff_name' => 'required|string',
            'role' => 'required|string',
            'shift_name' => 'required|string',
            'shift_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        StaffShift::create($validated);

        return redirect()->back()->with('success', "Jadwal Shift untuk {$validated['staff_name']} BERHASIL DITAMBAHKAN!");
    }

    public function webClockIn(Request $request)
    {
        StaffAttendance::ensureTable();

        $validated = $request->validate([
            'staff_name' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $now = Carbon::now();

        StaffAttendance::create([
            'staff_name' => $validated['staff_name'],
            'clock_in' => $now,
            'clock_in_status' => 'ontime',
            'latitude' => -7.7554,
            'longitude' => 110.3842,
            'distance_meters' => 5,
            'selfie_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150',
            'face_verified' => true,
            'device_info' => 'Web Admin Workstation Kiosk',
            'notes' => $validated['notes'] ?? 'Clock In via Web Kiosk Studio',
        ]);

        return redirect()->back()->with('success', "✅ Presensi Masuk (Clock In) untuk {$validated['staff_name']} BERHASIL DICATAT!");
    }

    public function webClockOut($id)
    {
        StaffAttendance::ensureTable();
        $attendance = StaffAttendance::findOrFail($id);

        $now = Carbon::now();
        $attendance->clock_out = $now;

        if ($attendance->clock_in) {
            $hours = $now->diffInMinutes($attendance->clock_in) / 60;
            $attendance->total_hours_worked = round($hours, 2);
        }

        $attendance->save();

        return redirect()->back()->with('success', "🔴 Presensi Pulang (Clock Out) untuk {$attendance->staff_name} BERHASIL DICATAT!");
    }

    private function ensureSampleShiftsAndAttendancesSeeded()
    {
        $today = Carbon::today();

        if (StaffShift::whereDate('shift_date', $today)->count() === 0) {
            $defaultShifts = [
                ['staff_name' => 'Siti Resepsionis', 'role' => 'receptionist', 'shift_name' => 'Shift Pagi (06:00 - 14:00)', 'start' => '06:00:00', 'end' => '14:00:00'],
                ['staff_name' => 'Coach Hendra Wijaya', 'role' => 'trainer', 'shift_name' => 'Shift Pagi (06:00 - 14:00)', 'start' => '06:00:00', 'end' => '14:00:00'],
                ['staff_name' => 'Budi Security', 'role' => 'security', 'shift_name' => 'Shift Siang (14:00 - 22:00)', 'start' => '14:00:00', 'end' => '22:00:00'],
                ['staff_name' => 'Rina Cleaner', 'role' => 'cleaner', 'shift_name' => 'Shift Pagi (06:00 - 14:00)', 'start' => '06:00:00', 'end' => '14:00:00'],
            ];

            foreach ($defaultShifts as $s) {
                StaffShift::create([
                    'staff_name' => $s['staff_name'],
                    'role' => $s['role'],
                    'shift_name' => $s['shift_name'],
                    'shift_date' => $today->format('Y-m-d'),
                    'start_time' => $s['start'],
                    'end_time' => $s['end'],
                    'status' => 'scheduled',
                ]);
            }
        }

        if (StaffAttendance::whereDate('created_at', $today)->count() === 0) {
            StaffAttendance::create([
                'staff_name' => 'Siti Resepsionis',
                'clock_in' => $today->copy()->addHours(6)->addMinutes(5),
                'clock_in_status' => 'ontime',
                'latitude' => -7.7554,
                'longitude' => 110.3842,
                'distance_meters' => 12,
                'selfie_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150',
                'face_verified' => true,
                'device_info' => 'Flutter Mobile App (iOS)',
                'notes' => 'Presensi masuk dari HP Flutter',
            ]);

            StaffAttendance::create([
                'staff_name' => 'Coach Hendra Wijaya',
                'clock_in' => $today->copy()->addHours(6)->addMinutes(25),
                'clock_in_status' => 'late',
                'latitude' => -7.7550,
                'longitude' => 110.3840,
                'distance_meters' => 35,
                'selfie_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150',
                'face_verified' => true,
                'device_info' => 'Flutter Mobile App (Android)',
                'notes' => 'Terlambat 25 menit karena hujan',
            ]);
        }
    }
}
