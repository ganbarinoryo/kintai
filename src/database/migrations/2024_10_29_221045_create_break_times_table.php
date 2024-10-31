<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('break_times', function (Blueprint $table) {
            $table->id(); // 自動インクリメントID
            $table->unsignedBigInteger('clock_id'); // clock_id
            $table->datetime('break_in')->nullable(); // 休憩開始
            $table->datetime('break_out')->nullable(); // 休憩終了
            $table->timestamps();

            // 外部キー制約の追加
            $table->foreign('clock_id')->references('id')->on('clocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('break_times');
    }
}
