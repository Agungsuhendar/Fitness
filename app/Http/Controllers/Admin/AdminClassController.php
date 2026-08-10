<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FitnessClass;
use App\Models\ClassBooking;
use App\Models\User;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminClassController extends Controller
{
    public function index(Request $request)
    {
        ClassBooking::ensureTable();
        $this->ensureSampleClassesAndBookingsSeeded();

        $classes = FitnessClass::orderByDesc('class_date')->orderBy('start_time')->get();

        $classId = $request->input('class_id');
        $activeClass = $classId ? FitnessClass::find($classId) : ($classes->first() ?? null);

        $confirmedBookings = collect();
        $waitlistBookings = collect();

        if ($activeClass) {
            $confirmedBookings = ClassBooking::where('fitness_class_id', $activeClass->id)
                ->where('booking_type', 'confirmed')
                ->where('status', '!=', 'cancelled')
                ->orderBy('id')
                ->get();

            $waitlistBookings = ClassBooking::where('fitness_class_id', $activeClass->id)
                ->where('booking_type', 'waitlist')
                ->where('status', '!=', 'cancelled')
                ->orderBy('waitlist_position')
                ->get();
        }

        // Metrics
        $totalClasses = $classes->count();
        $totalConfirmed = ClassBooking::where('booking_type', 'confirmed')->where('status', '!=', 'cancelled')->count();
        $totalWaitlist = ClassBooking::where('booking_type', 'waitlist')->where('status', '!=', 'cancelled')->count();
        $totalPromoted = ClassBooking::where('status', 'promoted')->count();

        return view('admin.classes.index', compact(
            'classes', 'activeClass', 'confirmedBookings', 'waitlistBookings',
            'totalClasses', 'totalConfirmed', 'totalWaitlist', 'totalPromoted'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'coach_name' => 'required|string|max:255',
            'class_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_capacity' => 'required|integer|min:1',
            'branch' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        FitnessClass::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Jadwal Kelas Studio "' . $validated['name'] . '" BERHASIL DITAMBAHKAN!');
    }

    public function bookClass(Request $request)
    {
        ClassBooking::ensureTable();

        $validated = $request->validate([
            'fitness_class_id' => 'required|exists:fitness_classes,id',
            'member_name' => 'required|string',
            'member_phone' => 'nullable|string',
        ]);

        $fitnessClass = FitnessClass::findOrFail($validated['fitness_class_id']);
        $maxCapacity = $fitnessClass->max_capacity ?: 15;

        $confirmedCount = ClassBooking::where('fitness_class_id', $fitnessClass->id)
            ->where('booking_type', 'confirmed')
            ->where('status', '!=', 'cancelled')
            ->count();

        if ($confirmedCount < $maxCapacity) {
            $booking = ClassBooking::create([
                'fitness_class_id' => $fitnessClass->id,
                'member_name' => $validated['member_name'],
                'member_phone' => $validated['member_phone'] ?? null,
                'booking_type' => 'confirmed',
                'status' => 'active',
            ]);

            return redirect()->route('admin.classes.index', ['class_id' => $fitnessClass->id])
                ->with('success', "🟢 Peserta {$validated['member_name']} BERHASIL DIDAFTARKAN sebagai PESERTA RESMI!");
        } else {
            // Put on Waitlist
            $currentWaitlistCount = ClassBooking::where('fitness_class_id', $fitnessClass->id)
                ->where('booking_type', 'waitlist')
                ->where('status', '!=', 'cancelled')
                ->count();

            $waitlistPos = $currentWaitlistCount + 1;

            $booking = ClassBooking::create([
                'fitness_class_id' => $fitnessClass->id,
                'member_name' => $validated['member_name'],
                'member_phone' => $validated['member_phone'] ?? null,
                'booking_type' => 'waitlist',
                'waitlist_position' => $waitlistPos,
                'status' => 'active',
            ]);

            return redirect()->route('admin.classes.index', ['class_id' => $fitnessClass->id])
                ->with('success', "⏳ Kuota Kelas Penuh ({$confirmedCount}/{$maxCapacity}). Peserta {$validated['member_name']} BERHASIL MASUK DAFTAR ANTREAN (WAITLIST #{$waitlistPos})!");
        }
    }

    public function cancelBooking($id)
    {
        ClassBooking::ensureTable();
        $booking = ClassBooking::findOrFail($id);
        $classId = $booking->fitness_class_id;
        $memberName = $booking->member_name;

        $wasConfirmed = ($booking->booking_type === 'confirmed');
        $booking->status = 'cancelled';
        $booking->cancelled_at = now();
        $booking->save();

        $promotedInfo = "";

        // If a confirmed booking was cancelled, auto-promote the #1 waitlist person!
        if ($wasConfirmed) {
            $nextWaitlist = ClassBooking::where('fitness_class_id', $classId)
                ->where('booking_type', 'waitlist')
                ->where('status', '!=', 'cancelled')
                ->orderBy('waitlist_position')
                ->first();

            if ($nextWaitlist) {
                $nextWaitlist->booking_type = 'confirmed';
                $nextWaitlist->status = 'promoted';
                $nextWaitlist->promoted_at = now();
                $nextWaitlist->waitlist_position = null;
                $nextWaitlist->save();

                // Send WA Notification to promoted member!
                WhatsAppService::sendClassWaitlistPromotionNotification($nextWaitlist);

                $promotedInfo = " 🎉 Peringatan: Pendaftaran {$nextWaitlist->member_name} (Waitlist #1) OTOMATIS DIPROMOSIKAN menjadi Peserta Resmi & Notifikasi WA Telah Dikirimkan!";

                // Re-index remaining waitlist positions
                $remainingWaitlists = ClassBooking::where('fitness_class_id', $classId)
                    ->where('booking_type', 'waitlist')
                    ->where('status', '!=', 'cancelled')
                    ->orderBy('waitlist_position')
                    ->get();

                $pos = 1;
                foreach ($remainingWaitlists as $rw) {
                    $rw->waitlist_position = $pos++;
                    $rw->save();
                }
            }
        }

        return redirect()->route('admin.classes.index', ['class_id' => $classId])
            ->with('success', "Pendaftaran {$memberName} berhasil dibatalkan.{$promotedInfo}");
    }

    public function destroy($id)
    {
        $class = FitnessClass::findOrFail($id);
        $name = $class->name;
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Jadwal kelas "' . $name . '" telah dihapus.');
    }

    private function ensureSampleClassesAndBookingsSeeded()
    {
        if (FitnessClass::count() === 0) {
            $today = Carbon::today();
            $classes = [
                ['name' => 'Yoga Sunset Harmony', 'category' => 'Yoga', 'coach_name' => 'Coach Maya Putri', 'start_time' => '17:00:00', 'end_time' => '18:15:00', 'max_capacity' => 5],
                ['name' => 'Crossfit Strength & Conditioning', 'category' => 'Crossfit', 'coach_name' => 'Coach Hendra Wijaya', 'start_time' => '18:30:00', 'end_time' => '19:45:00', 'max_capacity' => 10],
                ['name' => 'Zumba Cardio Burn Party', 'category' => 'Zumba', 'coach_name' => 'Coach Dennis Sugianto', 'start_time' => '19:45:00', 'end_time' => '21:00:00', 'max_capacity' => 15],
            ];

            foreach ($classes as $c) {
                FitnessClass::create([
                    'name' => $c['name'],
                    'category' => $c['category'],
                    'coach_name' => $c['coach_name'],
                    'class_date' => $today->format('Y-m-d'),
                    'start_time' => $c['start_time'],
                    'end_time' => $c['end_time'],
                    'max_capacity' => $c['max_capacity'],
                    'branch' => 'Sleman HQ',
                    'price' => 50000,
                ]);
            }
        }

        $firstClass = FitnessClass::first();
        if ($firstClass && ClassBooking::where('fitness_class_id', $firstClass->id)->count() === 0) {
            // Fill capacity 5
            for ($i = 1; $i <= 5; $i++) {
                ClassBooking::create([
                    'fitness_class_id' => $firstClass->id,
                    'member_name' => 'Member ' . $i,
                    'member_phone' => '08123456780' . $i,
                    'booking_type' => 'confirmed',
                    'status' => 'active',
                ]);
            }

            // Create 3 Waitlist Bookings
            for ($w = 1; $w <= 3; $w++) {
                ClassBooking::create([
                    'fitness_class_id' => $firstClass->id,
                    'member_name' => 'Peserta Waitlist ' . $w,
                    'member_phone' => '08998877660' . $w,
                    'booking_type' => 'waitlist',
                    'waitlist_position' => $w,
                    'status' => 'active',
                ]);
            }
        }
    }
}
