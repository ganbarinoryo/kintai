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

    protected $casts = [
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

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

    // clock_in を H:i:s 形式でフォーマット
    public function getFormattedClockInAttribute()
    {
        return $this->clock_in ? Carbon::parse($this->clock_in)->format('H:i:s') : '---';
    }

    // clock_out を H:i:s 形式でフォーマット
    public function getFormattedClockOutAttribute()
    {
        return $this->clock_out ? Carbon::parse($this->clock_out)->format('H:i:s') : '---';
    }

    // 1日の休憩時間を取得するメソッド
    public function getTotalBreakAttribute()
    {
        // 休憩時間の合計を1日分に限定して取得
        $totalBreak = $this->breakTimes->reduce(function ($carry, $break) {
            if ($break->break_in && $break->break_out) {
                // 休憩の開始・終了を分単位で計算
                $carry += Carbon::parse($break->break_out)->diffInMinutes(Carbon::parse($break->break_in));
            }
            return $carry;
        }, 0);
        
        // 分単位で返す
        return $totalBreak;
    }

    // 勤務時間の合計から休憩時間の合計を引いた値を取得するメソッド
    public function getTotalWorkAttribute()
    {
        if ($this->clock_in && $this->clock_out) {
            // 勤務開始から終了までの分数
            $totalWorkMinutes = Carbon::parse($this->clock_out)->diffInMinutes(Carbon::parse($this->clock_in));
            $totalWorkMinutes -= $this->total_break; // 休憩時間を差し引く

            return $totalWorkMinutes; // 分単位で返す
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

    // 1日の休憩時間（フォーマット済み）
    public function getFormattedTotalBreakAttribute()
    {
        return $this->formatTime($this->total_break);
    }

    // 1日の勤務時間（フォーマット済み）
    public function getFormattedTotalWorkAttribute()
    {
        return $this->formatTime($this->total_work);
    }
}