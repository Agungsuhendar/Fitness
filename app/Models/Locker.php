<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Locker extends Model
{
    use HasFactory;

    protected $fillable = [
        'locker_number',
        'gender_category',
        'status',
        'user_id',
        'member_name',
        'assigned_at',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    public static function ensureTable()
    {
        if (!Schema::hasTable('lockers')) {
            Schema::create('lockers', function ($table) {
                $table->id();
                $table->string('locker_number')->unique();
                $table->string('gender_category')->default('all');
                $table->string('status')->default('available');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('member_name')->nullable();
                $table->timestamp('assigned_at')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function assignToUser($user)
    {
        $this->status = 'occupied';
        $this->user_id = $user->id;
        $this->member_name = $user->name;
        $this->assigned_at = now();
        $this->save();

        return $this;
    }

    public function release()
    {
        $this->status = 'available';
        $this->user_id = null;
        $this->member_name = null;
        $this->assigned_at = null;
        $this->save();

        return $this;
    }

    public static function autoAssignForUser($user)
    {
        self::ensureTable();

        // Check if user already has an active assigned locker
        $existing = self::where('user_id', $user->id)->where('status', 'occupied')->first();
        if ($existing) {
            return $existing;
        }

        $userGender = strtolower((string)($user->gender ?? 'all'));
        $genderCat = 'all';
        if (str_contains($userGender, 'pria') || str_contains($userGender, 'male') || str_contains($userGender, 'laki')) {
            $genderCat = 'male';
        } elseif (str_contains($userGender, 'wanita') || str_contains($userGender, 'female') || str_contains($userGender, 'perempuan')) {
            $genderCat = 'female';
        }

        // Try gender-specific available locker first, then fallback to 'all' or any available
        $locker = self::where('status', 'available')
            ->where(function($q) use ($genderCat) {
                $q->where('gender_category', $genderCat)
                  ->orWhere('gender_category', 'all');
            })
            ->orderBy('locker_number')
            ->first();

        if (!$locker) {
            $locker = self::where('status', 'available')->orderBy('locker_number')->first();
        }

        if ($locker) {
            $locker->assignToUser($user);
            return $locker;
        }

        return null;
    }
}
