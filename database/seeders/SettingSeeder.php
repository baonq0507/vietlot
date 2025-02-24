<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'min_bet' => 10,
            'max_bet' => 1000000,
            'min_withdraw' => 100000,
            'max_withdraw' => 1000000,
            'min_deposit' => 100000,
            'max_deposit' => 1000000,
        ]);
    }
}
