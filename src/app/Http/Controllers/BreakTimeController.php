<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BreakTime;
use App\Models\Clock;

class BreakTimeController extends Controller
{
    public function breakIn(Request $request)
    {
        $currentClock = Clock::where('user_id', Auth::id())->latest()->first();

        // 勤務記録が存在し、勤務開始がある場合のみ打刻可能
        if (!$currentClock || !$currentClock->clock_in) {
            return redirect()->back()->with('error', '勤務記録がありません。');
        }

        // 休憩開始の記録を作成
        $breakTime = new BreakTime();
        $breakTime->clock_id = $currentClock->id; // 現在の勤務記録のID
        $breakTime->break_in = now()->format('H:i:s'); // 現在の時刻を設定
        $breakTime->save(); // DBに保存

        return redirect()->back()->with('status', '休憩を開始しました！');
    }

    public function breakOut(Request $request)
    {
        // 現在のユーザーの勤務記録を取得
        $currentClock = Clock::where('user_id', Auth::id())->latest()->first();
        
        // 勤務が開始されていない、または終了している場合は打刻不可
        if (!$currentClock || !$currentClock->clock_in || $currentClock->clock_out !== null) {
            return redirect()->back()->with('error', '無効な操作です。');
        }
        
        // 最新の休憩記録を取得
        $breakTime = BreakTime::where('clock_id', function ($query) {
            $query->select('id')->from('clocks')->where('user_id', Auth::id())->latest();
        })->latest()->first();

        // break_in が存在し、かつ break_out が未設定の場合のみ休憩終了を許可
        if ($breakTime && $breakTime->break_in !== null && $breakTime->break_out === null) {
        $breakTime->break_out = now()->format('H:i:s'); // 現在の時刻を設定
        $breakTime->save(); // DBに保存
        return redirect()->back()->with('status', '休憩を終了しました！');
    }

        
        

        return redirect()->back()->with('error', '休憩開始記録がありません。');
    }
}
