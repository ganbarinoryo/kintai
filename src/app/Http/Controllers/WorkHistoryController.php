<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clock;
use App\Models\User;

class WorkHistoryController extends Controller
{
    public function index()
    {
        // 認証されたユーザーを取得
        $user = Auth::user();

        // 勤務履歴データ（clocksテーブル）をユーザーに紐づけて取得し降順で表示する
        $clocks = $user->clocks()->with('breakTimes')->orderBy('created_at', 'desc')->paginate(5);

        // ビューにデータを渡す
        return view('work_history', compact('user', 'clocks'));
    }
}
