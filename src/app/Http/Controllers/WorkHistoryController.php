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

    public function showWorkHistory(Request $request)
{
    // デフォルトは認証中のユーザーID
    $userId = $request->get('user_id', auth()->id());

    // 全ユーザーのリストを取得
    $users = User::all();

    // ページネートで勤務履歴を取得
    $clocks = Clock::where('user_id', $userId)->paginate(5);

    // ビューに渡す
    return view('work_history', compact('users', 'clocks'));
}

}
