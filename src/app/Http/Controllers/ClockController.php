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
        if ($this->hasClockedInToday()) {
            return redirect()->back()->with('error', '今日の勤務開始は既に記録されています。');
        }

        Clock::create([
            'user_id' => Auth::id(),
            'clock_in' => now()->format('H:i:s')
        ]);

        return redirect()->back()->with('status', '勤務開始しました！');
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

    public function showAttendanceByDate(Request $request, $date = null)
    {
        $date = $date ? Carbon::parse($date) : Carbon::today();
        $user = Auth::user();
        $clocks = $user->clocks()->whereDate('clock_in', $date->toDateString())->get();
        $dateExists = $clocks->isNotEmpty();

        return view('attendance', compact('user', 'clocks', 'date', 'dateExists', 'previousDate', 'nextDate'))
            ->with([
                'previousDate' => $date->copy()->subDay(),
                'nextDate' => $date->copy()->addDay()
            ]);
    }

    private function hasClockedInToday(): bool
    {
        return Clock::where('user_id', Auth::id())
                    ->whereDate('clock_in', now()->toDateString())
                    ->exists();
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
