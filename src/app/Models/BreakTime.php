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

    // break_in を H:i:s 形式でフォーマット
    public function getFormattedBreakInAttribute()
    {
        return $this->break_in ? Carbon::parse($this->break_in)->format('H:i:s') : '---';
    }

    // break_out を H:i:s 形式でフォーマット
    public function getFormattedBreakOutAttribute()
    {
        return $this->break_out ? Carbon::parse($this->break_out)->format('H:i:s') : '---';
    }

}
