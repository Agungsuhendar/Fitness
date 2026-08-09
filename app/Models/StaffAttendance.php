<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_shift_id',
        'user_id',
        'staff_name',
        'clock_in',
        'clock_out',
        'clock_in_status',
        'clock_out_status',
        'latitude',
        'longitude',
        'distance_meters',
        'selfie_path',
        'face_verified',
        'device_info',
        'total_hours_worked',
        'notes',
    ];

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
        'face_verified' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'total_hours_worked' => 'decimal:2',
    ];

    public static function ensureTable()
    {
        if (!Schema::hasTable('staff_attendances')) {
            Schema::create('staff_attendances', function ($table) {
                $table->id();
                $table->unsignedBigInteger('staff_shift_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('staff_name');
                $table->timestamp('clock_in')->nullable();
                $table->timestamp('clock_out')->nullable();
                $table->string('clock_in_status')->default('ontime');
                $table->string('clock_out_status')->default('ontime');
                $table->decimal('latitude', 10, 7)->nullable();
                $table->decimal('longitude', 10, 7)->nullable();
                $table->integer('distance_meters')->default(0);
                $table->string('selfie_path')->nullable();
                $table->boolean('face_verified')->default(true);
                $table->string('device_info')->nullable();
                $table->decimal('total_hours_worked', 5, 2)->default(0);
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public static function calculateDistanceInMeters($lat1, $lon1, $lat2, $lon2)
    {
        if (!$lat1 || !$lon1 || !$lat2 || !$lon2) return 0;
        $earthRadius = 6371000; // Earth radius in meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return (int) round($angle * $earthRadius);
    }

    public function shift()
    {
        return $this->belongsTo(StaffShift::class, 'staff_shift_id');
    }
}
