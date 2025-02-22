<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingKenno;
class SettingKennoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingKenno::create([
            'type' => 'kenno1p',
            'reward_win' => 1.98,
        ]);
        SettingKenno::create([
            'type' => 'kenno3p',
            'reward_win' => 1.98,
        ]);
        SettingKenno::create([
            'type' => 'kenno5p',
            'reward_win' => 1.98,
        ]);
    }
}
