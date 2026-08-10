<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ClassBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'fitness_class_id',
        'user_id',
        'member_name',
        'member_phone',
        'booking_type',
        'waitlist_position',
        'status',
        'promoted_at',
        'cancelled_at',
    ];

    protected $casts = [
        'promoted_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'waitlist_position' => 'integer',
    ];

    public static function ensureTable()
    {
        if (!Schema::hasTable('class_bookings')) {
            Schema::create('class_bookings', function ($table) {
                $table->id();
                $table->unsignedBigInteger('fitness_class_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('member_name');
                $table->string('member_phone')->nullable();
                $table->string('booking_type')->default('confirmed');
                $table->integer('waitlist_position')->nullable();
                $table->string('status')->default('active');
                $table->timestamp('promoted_at')->nullable();
                $table->timestamp('cancelled_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function fitnessClass()
    {
        return $this->belongsTo(FitnessClass::class, 'fitness_class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
