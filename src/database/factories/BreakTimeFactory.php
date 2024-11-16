<?php

namespace Database\Factories;

use App\Models\BreakTime;
use App\Models\Clock;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreakTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = BreakTime::class;

    public function definition()
    {
        // Clockのインスタンスを取得
        $clock = Clock::factory()->create();

        return [
            // clock_id は生成した Clock の ID を使用
            'clock_id' => $clock->id,

            // 勤務中のランダムな開始時刻
            'break_in' => $this->faker->dateTimeBetween($clock->clock_in, $clock->clock_out),

            // 勤務終了までのランダムな終了時刻
            'break_out' => $this->faker->dateTimeBetween($clock->clock_in, $clock->clock_out),
        ];
    }
}
