<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clocks', function (Blueprint $table) {
            $table->id(); // idカラム
            $table->foreignId('user_id')->constrained('users'); // usersテーブルのidと紐づけ
            $table->datetime('clock_in')->nullable(); // 勤務開始
            $table->datetime('clock_out')->nullable(); // 勤務終了
            $table->timestamps(); // created_atとupdated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clocks');
    }
}
