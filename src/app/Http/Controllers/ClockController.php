<?php

//簡略化済み

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clock;
use Carbon\Carbon;

class ClockController extends Controller
{
    private const ERROR_CLOCK_IN_NOT_FOUND = '勤務開始記録がありません。';
    private const ERROR_ALREADY_CLOCKED_OUT = 'すでに勤務終了しています。';
    private const ERROR_BREAK_NOT_ENDED = '休憩が終了していません。';

    // 勤務開始ボタン
   public function clockIn(Request $request)
    {
    // 本日すでに勤務開始しているかを確認（created_atを基にチェック）
    if ($this->hasClockedInToday()) {
        // すでに勤務開始が記録されている場合はエラーメッセージを設定してリダイレクト
        return redirect()->back()->with('error', '今日の勤務開始は既に記録されています。');
    }

    // 本日の勤務開始時刻をClockテーブルに新規レコードとして記録
    Clock::create([
        'user_id' => Auth::id(),           // 現在のユーザーIDを記録
        'clock_in' => now()->format('H:i:s') // 現在の時刻をHH:MM:SS形式で記録
    ]);

    // リダイレクトしてボタンが再度表示されるのを防ぐため、元のページに戻る
    return redirect()->back();
    }

    private function hasClockedInToday(): bool
    {
    // 当日レコードがcreated_atで存在するか確認
    return Clock::where('user_id', Auth::id())
                ->whereDate('created_at', now()->toDateString())
                ->exists();
    }

    // 勤務終了ボタン
    public function clockOut(Request $request)
    {
        $clock = $this->getCurrentClock();

        if (!$clock) {
            return redirect()->back()->with('error', self::ERROR_CLOCK_IN_NOT_FOUND);
        }

        if ($clock->clock_out) {
            return redirect()->back()->with('error', self::ERROR_ALREADY_CLOCKED_OUT);
        }

        if ($this->hasActiveBreak($clock)) {
            return redirect()->back()->with('error', self::ERROR_BREAK_NOT_ENDED);
        }

        $clock->update(['clock_out' => now()]);

        return redirect()->back()->with('status', '勤務終了しました！');
    }

    // 打刻ページ表示
    public function showStampPage()
    {
        $user = Auth::user();
        $currentClock = $user->clocks()->latest()->first();
        $latestBreak = $currentClock ? $currentClock->breakTimes()->latest()->first() : null;

        return view('stamp', compact('currentClock', 'latestBreak'));
    }

    private function getCurrentClock()
    {
        return Clock::where('user_id', Auth::id())->latest()->first();
    }

    private function hasActiveBreak(Clock $clock): bool
    {
        $latestBreak = $clock->breakTimes()->latest()->first();
        return $latestBreak && !$latestBreak->break_out;
    }
}