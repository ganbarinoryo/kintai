<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\AttendanceController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 認証ミドルウェアを適用
Route::middleware(['auth'])->group(function () {

    // ホームページ表示（スタンプページへリダイレクト）
    Route::get('/', [AuthController::class, 'stamp'])->name('home');

    // 打刻ページの表示
    Route::get('/stamp', [ClockController::class, 'showStampPage'])->name('stamp.page');

    // 勤務開始ボタンの処理
    Route::post('/clock/in', [ClockController::class, 'clockIn'])->name('clock.in');

    // 勤務終了ボタンの処理
    Route::post('/clock/out', [ClockController::class, 'clockOut'])->name('clock.out');

    // 休憩開始ボタンの処理
    Route::post('/break/in', [BreakTimeController::class, 'breakIn'])->name('break.in');

    // 休憩終了ボタンの処理
    Route::post('/break/out', [BreakTimeController::class, 'breakOut'])->name('break.out');

    // 出勤情報の一覧表示
    Route::get('/attendance', [UserController::class, 'attendance']);

    // 特定の日付の出勤情報の表示
    Route::get('/attendance/{date}', [AttendanceController::class, 'showAttendanceByDate'])->name('attendance.show');
});

// 認証ミドルウェアとメール認証済みミドルウェアを適用
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボードの表示（メール認証済みユーザーのみアクセス可能）
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// 出勤情報の一覧表示（未認証ユーザーのアクセス許可）
Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');
