<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class StaffShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_name',
        'role',
        'shift_name',
        'shift_date',
        'start_time',
        'end_time',
        'status',
        'notes',
    ];

    public static function ensureTable()
    {
        if (!Schema::hasTable('staff_shifts')) {
            Schema::create('staff_shifts', function ($table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('staff_name');
                $table->string('role')->default('receptionist');
                $table->string('shift_name');
                $table->date('shift_date');
                $table->time('start_time')->default('06:00:00');
                $table->time('end_time')->default('14:00:00');
                $table->string('status')->default('scheduled');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(StaffAttendance::class, 'staff_shift_id');
    }
}
