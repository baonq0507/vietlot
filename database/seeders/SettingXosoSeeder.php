<?php

namespace Database\Seeders;

use App\Models\SettingXoso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingXosoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settingXosos = [
            [
                'type' => 'xoso3p',
                'lo_thuong' => 99,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
            [
                'type' => 'xoso5p',
                'lo_thuong' => 99,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
            [
                'type' => 'xsmb',
                'lo_thuong' => 99,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
            [
                'type' => 'xsmn',
                'lo_thuong' => 99,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
            [
                'type' => 'xsmt',
                'lo_thuong' => 99,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
            [
                'type' => 'de_dac_biet',
                'lo_thuong' => 105,
                'ba_cang' => 835,
                'db' => 99,
                'lo_xien_2' => 8,
                'lo_xien_3' => 40,
                'lo_xien_4' => 100,
            ],
        ];

        foreach ($settingXosos as $settingXoso) {
            SettingXoso::create($settingXoso);
        }
    }
}
