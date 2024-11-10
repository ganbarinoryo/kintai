<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // clocksメソッドの追加
    public function clocks()
    {
        return $this->hasMany(Clock::class);
    }

    // BreakTimeとのリレーションを追加
    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class, 'clock_id', 'id');
    }

    // 各ユーザーの勤務データと休憩データを取得
    public function attendance()
    {
        $users = User::with(['clocks.breakTimes'])->get();
        return view('your_view_name', compact('users'));
    }
}
