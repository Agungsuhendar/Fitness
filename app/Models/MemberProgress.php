<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProgress extends Model
{
    use HasFactory;

    protected $table = 'member_progress';

    protected $fillable = [
        'member_id',
        'member_program_id',
        'recorded_at',
        'weight',
        'body_fat',
        'bmi',
        'chest',
        'waist',
        'arm',
        'thigh',
        'notes',
        'recorded_by',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function memberProgram()
    {
        return $this->belongsTo(MemberProgram::class, 'member_program_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
