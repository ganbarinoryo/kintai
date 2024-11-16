<?php

namespace Database\Factories;

use App\Models\Clock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Clock::class;

    public function definition()
    {
    // clock_in の日時を生成
    $clockIn = $this->faker->dateTimeThisYear();
    
    return [
        'user_id' => \App\Models\User::factory(),
        
        // clock_in と clock_out の時間の順序を保証
        'clock_in' => $clockIn,
        'clock_out' => $this->faker->dateTimeBetween($clockIn, 'now'),
    ];
}

}
