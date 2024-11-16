<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Clock;
use App\Models\BreakTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーを1件作成
        User::factory(78)->create()->each(function ($user) 
        {
            // 各ユーザーに関連するClockデータを作成
            $clocks = Clock::factory(3)->create([  // ここで3件のClockデータを生成
                'user_id' => $user->id,
            ]);

            // 各Clockデータに関連するBreakTimeデータを作成
            foreach ($clocks as $clock) {
                BreakTime::factory(2)->create([  // 各Clockに対して2件のBreakTimeを生成
                    'clock_id' => $clock->id,
                ]);
            }
        });
    }
}
