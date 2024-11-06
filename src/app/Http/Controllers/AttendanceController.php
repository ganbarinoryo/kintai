<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

    class AttendanceController extends Controller
{
    public function attendance(Request $request)
    {
        // 初期の日付を取得
        $date = $request->get('date', Carbon::today()->toDateString());
        $date = Carbon::parse($date);

        // ユーザーデータを取得し、日付に基づくクレックデータを取得
        $users = $this->getUsersWithClocks($date->toDateString());

        // attendance.blade.phpビューにデータを渡す
        return view('attendance', compact('users', 'date'))
            ->with([
                'previousDate' => $date->copy()->subDay()->toDateString(),
                'nextDate' => $date->copy()->addDay()->toDateString()
            ]);
    }

    public function showAttendanceByDate(Request $request, $date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();
        $users = $this->getUsersWithClocks($date->toDateString());

        return view('attendance', compact('users', 'date'))
            ->with([
                'previousDate' => $date->copy()->subDay()->toDateString(),
                'nextDate' => $date->copy()->addDay()->toDateString()
            ]);
    }

    private function getUsersWithClocks($date)
    {
        // ユーザーとその日のクレックデータを取得
        return User::with(['clocks' => function($query) use ($date) {
            $query->whereDate('created_at', $date); // created_atが指定された日付のデータのみ取得
        }])->paginate(5); // 5件ごとにページネーション
    }
}