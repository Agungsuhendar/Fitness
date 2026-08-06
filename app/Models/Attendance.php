<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_card_id',
        'member_name',
        'branch',
        'checkin_time',
        'pt_deducted',
        'remaining_sessions_after',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'checkin_time' => 'datetime',
            'remaining_sessions_after' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
