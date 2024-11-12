<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_history extends Model
{
    use HasFactory;

    // userメソッドの追加
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // clocksテーブルとのリレーション
    public function clock()
    {
        return $this->belongsTo(Clock::class, 'clock_id');
    }
}
