<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'member_card_id',
        'membership_type',
        'status',
        'branch',
        'total_sessions',
        'completed_sessions',
        'remaining_sessions',
        'assigned_coach',
        'next_session',
        'initial_weight',
        'current_weight',
        'target_weight',
        'initial_bodyfat',
        'current_bodyfat',
        'muscle_mass',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'initial_weight' => 'float',
            'current_weight' => 'float',
            'target_weight' => 'float',
            'initial_bodyfat' => 'float',
            'current_bodyfat' => 'float',
            'total_sessions' => 'integer',
            'completed_sessions' => 'integer',
            'remaining_sessions' => 'integer',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->email === 'admin@lesrenangjogja.com';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
