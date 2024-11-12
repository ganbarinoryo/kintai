<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkHistoryController;





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

// ユーザー登録フォームの送信処理（未認証ユーザーもアクセス可能）
Route::post('/register', [AuthController::class, 'register'])->name('register');

// サンクスページ表示（未認証ユーザーもアクセス可能）
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

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

    //ユーザー情報の一覧表示
    Route::get('/worker', [WorkerController::class, 'worker']);
    Route::get('/worker', [WorkerController::class, 'index'])->name('worker.index');

    //ユーザーの個別勤怠情報の一覧表示
    Route::get('/work_history', [WorkHistoryController::class, 'work_history']);
    Route::get('/work_history', [WorkHistoryController::class, 'index'])->name('work_history')->middleware('auth');

    //ユーザーを選択して勤務履歴を表示する
    Route::get('/work_history', [WorkHistoryController::class, 'showWorkHistory'])->name('work_history');



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
