<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BreakTime;

class Clock extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_in', 'clock_out'];

    // userメソッドの追加
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakTimes()
{
    return $this->hasMany(BreakTime::class, 'clock_id');
}

}
