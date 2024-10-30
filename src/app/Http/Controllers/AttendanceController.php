<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AttendanceController extends Controller
{
    public function attendance()
    {
        // ユーザーデータを取得し、ページネーションを適用
        $users = User::with(['clocks', 'breakTimes'])
                     ->paginate(5); // 10件ごとにページネーション

        // attendance.blade.phpビューにデータを渡す
        return view('attendance', compact('users'));
    }
}
