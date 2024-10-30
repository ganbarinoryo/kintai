<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clock;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'clock_id',
        'break_in',
        'break_out',
    ];

    // clocksテーブルとのリレーション
    public function clock()
    {
        return $this->belongsTo(Clock::class, 'clock_id');
    }

}