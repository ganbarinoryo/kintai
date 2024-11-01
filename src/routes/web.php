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
    Route::get('/', [AuthController::class, 'stamp'])->name('home');
    Route::get('/stamp', [ClockController::class, 'showStampPage'])->name('stamp.page');
    Route::post('/clock/in', [ClockController::class, 'clockIn'])->name('clock.in');
    Route::post('/clock/out', [ClockController::class, 'clockOut'])->name('clock.out');
    Route::post('/break/in', [BreakTimeController::class, 'breakIn'])->name('break.in');
    Route::post('/break/out', [BreakTimeController::class, 'breakOut'])->name('break.out');
    Route::get('/attendance', [UserController::class, 'attendance']);
    
    Route::get('attendance', [ClockController::class, 'index'])->name('attendance.index');

    //日付を渡せるようにする処理
    Route::get('attendance/date/{date?}', [ClockController::class, 'showAttendanceByDate'])->name('attendance.date');
});

Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');