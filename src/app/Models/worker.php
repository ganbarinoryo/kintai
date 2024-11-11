<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class worker extends Model
{
    use HasFactory;

    // Usersテーブルとのリレーション
    public function user()
    {
        return $this->belongsTo(Clock::class, 'id');
    }
}
