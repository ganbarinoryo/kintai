<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clock;


class ClockController extends Controller
{
    //勤務開始ボタン
    public function clockIn(Request $request)
    {
        //現在のユーザーの最新の打刻を取得
        $currentClock = Clock::where('user_id', Auth::id())->latest()->first();

        // 当日の勤務開始レコードが存在するか確認
        $todayClockIn = Clock::where('user_id', Auth::id())
        ->whereDate('clock_in', now()->toDateString())
        ->first();

        //当日分の開始打刻データがない場合新しい打刻を作成
        $clock = new Clock();
        $clock->user_id = Auth::id(); // 現在のユーザーIDを取得
        $clock->clock_in = now()->format('H:i:s'); // 現在の時刻を設定
        $clock->save(); // DBに保存

        return redirect()->back()->with('status', '勤務開始しました！');
    }

    //勤務終了ボタン
    public function clockOut(Request $request)
    {
    // 現在のユーザーの最新の勤務記録を取得
    $clock = Clock::where('user_id', Auth::id())->latest()->first();

    // 勤務記録がない、または勤務開始が記録されていない場合はエラー
    if (!$clock || !$clock->clock_in) {
        return redirect()->back()->with('error', '勤務開始記録がありません。');
    }

    // 既に勤務終了している場合はエラー
    if ($clock->clock_out) {
        return redirect()->back()->with('error', 'すでに勤務終了しています。');
    }

    // 最新の休憩記録を取得
    $latestBreak = $clock->breakTimes()->latest()->first();

    // 休憩開始のレコードが存在し、休憩終了レコードがない場合はエラー
    $latestBreak = $clock->breakTimes()->latest()->first();
    if ($latestBreak && !$latestBreak->break_out) {
        return redirect()->back()->with('error', '休憩が終了していません。');
    }

    // 勤務終了を打刻
    $clock->clock_out = now(); // 現在の日時を設定
    $clock->save(); // DBに保存

    return redirect()->back()->with('status', '勤務終了しました！');
    }


    // 打刻ページ表示
    public function showStampPage()
    {
    $user = Auth::user();
    $currentClock = $user->clocks()->latest()->first();
    $latestBreak = $currentClock ? $currentClock->breakTimes()->latest()->first() : null;

    return view('stamp')->with('currentClock', $currentClock)
                         ->with('latestBreak', $latestBreak);
    }

}
