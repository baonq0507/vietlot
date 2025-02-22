<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingXx;
class SettingXxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingXx::create([
            'type' => 'xucxac3p',
            'reward_win' => 2.2,
            'reward_win_2' => 2.9,
            'reward_win_2_every' => 1.98,
            'reward_win_3' => 4.8,
            'reward_win_3_every' => 2.9,
        ]);
        SettingXx::create([
            'type' => 'xucxac5p',
            'reward_win' => 2.2,
            'reward_win_2' => 2.9,
            'reward_win_2_every' => 1.98,
            'reward_win_3' => 4.8,
            'reward_win_3_every' => 2.9,
        ]);
    }
}
