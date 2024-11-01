<?php

//簡略化済み

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BreakTime;
use App\Models\Clock;

class BreakTimeController extends Controller
{
    private const ERROR_NO_CLOCK_RECORD = '勤務記録がありません。';
    private const ERROR_INVALID_OPERATION = '無効な操作です。';
    private const ERROR_NO_BREAK_IN_RECORD = '休憩開始記録がありません。';

    public function breakIn(Request $request)
    {
        $currentClock = $this->getCurrentClock();

        if (!$currentClock || !$currentClock->clock_in) {
            return redirect()->back()->with('error', self::ERROR_NO_CLOCK_RECORD);
        }

        // 休憩開始の記録を作成
        BreakTime::create([
            'clock_id' => $currentClock->id,
            'break_in' => now()->format('H:i:s')
        ]);

        return redirect()->back()->with('status', '休憩を開始しました！');
    }

    public function breakOut(Request $request)
    {
        $currentClock = $this->getCurrentClock();

        if (!$currentClock || !$currentClock->clock_in || $currentClock->clock_out) {
            return redirect()->back()->with('error', self::ERROR_INVALID_OPERATION);
        }

        $breakTime = $this->getLatestBreakTime($currentClock->id);

        if ($breakTime && $breakTime->break_in && !$breakTime->break_out) {
            $breakTime->update(['break_out' => now()->format('H:i:s')]);
            return redirect()->back()->with('status', '休憩を終了しました！');
        }

        return redirect()->back()->with('error', self::ERROR_NO_BREAK_IN_RECORD);
    }

    private function getCurrentClock()
    {
        return Clock::where('user_id', Auth::id())->latest()->first();
    }

    private function getLatestBreakTime($clockId)
    {
        return BreakTime::where('clock_id', $clockId)->latest()->first();
    }
}
