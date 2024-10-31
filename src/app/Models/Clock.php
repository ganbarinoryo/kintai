<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BreakTime;
use Carbon\Carbon;

class Clock extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_in', 'clock_out'];

    // userメソッドの追加
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // break_timeメソッドの追加
    public function breakTimes()
    {
    return $this->hasMany(BreakTime::class, 'clock_id');
    }

    // 休憩時間を計算するメソッド
    public function getTotalBreakAttribute()
    {
        // 最新の BreakTimes レコードを取得して合計時間を計算
        $totalBreak = $this->breakTimes->reduce(function ($carry, $break) {
            if ($break->break_in && $break->break_out) {
                $carry += Carbon::parse($break->break_out)->diffInMinutes(Carbon::parse($break->break_in));
            }
            return $carry;
        }, 0);

        return $totalBreak;
    }

    // 勤務時間を計算するメソッド
    public function getTotalWorkAttribute()
    {
        // 勤務時間から休憩時間を引く
        if ($this->clock_in && $this->clock_out) {
            $totalWorkMinutes = Carbon::parse($this->clock_out)
            ->diffInMinutes(Carbon::parse($this->clock_in));
            $totalWorkMinutes -= $this->total_break;

            return $totalWorkMinutes;
        }
        return 0;
    }

    // 時間を H:i:s 形式に変換するメソッド
    public function formatTime($minutes)
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;
        return sprintf('%02d:%02d:00', $hours, $minutes);
    }

    // フォーマットされた休憩時間を返す
    public function getFormattedTotalBreakAttribute()
    {
        return $this->formatTime($this->total_break);
    }

    // フォーマットされた勤務時間を返す
    public function getFormattedTotalWorkAttribute()
    {
        return $this->formatTime($this->total_work);
    }
}
