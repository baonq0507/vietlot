<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GameKenno;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createGameKenno1p();
        $this->createGameKenno3p();
        $this->createGameKenno5p();
        $this->createGameXucXac3();
        $this->createGameXucXac5();
        $this->createGameXoso3p();
        $this->createGameXoso5p();
        $this->command->info('Game Kenno 1p, 3p, 5p, xucxac3, xucxac5, xoso3p, xoso5p created successfully');
    }

    private function createGameKenno1p()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(1);
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $num3 = rand(0, 9);
            $num4 = rand(0, 9);
            $num5 = rand(0, 9);
            $total = $num1 + $num2 + $num3 + $num4 + $num5;
            GameKenno::create([
                'type' => 'kenno1p',
                'description' => 'kenno1p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => [$total, $num1, $num2, $num3, $num4, $num5],
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(1);
        }
    }

    private function createGameKenno3p()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(3);
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $num3 = rand(0, 9);
            $num4 = rand(0, 9);
            $num5 = rand(0, 9);
            $total = $num1 + $num2 + $num3 + $num4 + $num5;
            GameKenno::create([
                'type' => 'kenno3p',
                'description' => 'kenno3p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => [$total, $num1, $num2, $num3, $num4, $num5],
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(3);
        }
    }

    private function createGameKenno5p()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(5);
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $num3 = rand(0, 9);
            $num4 = rand(0, 9);
            $num5 = rand(0, 9);
            $total = $num1 + $num2 + $num3 + $num4 + $num5;
            GameKenno::create([
                'type' => 'kenno5p',
                'description' => 'kenno5p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => [$total, $num1, $num2, $num3, $num4, $num5],
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(5);
        }
    }

    private function createGameXucXac3()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(3);
            $num1 = rand(1, 6);
            $num2 = rand(1, 6);
            $num3 = rand(1, 6);
            $total = $num1 + $num2 + $num3;
            GameKenno::create([
                'type' => 'xucxac3p',
                'description' => 'xucxac3p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => [$total, $num1, $num2, $num3],
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(3);
        }
    }

    private function createGameXucXac5()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(5);
            $num1 = rand(1, 6);
            $num2 = rand(1, 6);
            $num3 = rand(1, 6);
            $total = $num1 + $num2 + $num3;
            GameKenno::create([
                'type' => 'xucxac5p',
                'description' => 'xucxac5p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => [$total, $num1, $num2, $num3],
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(5);
        }
    }

    private function createGameXoso3p()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(3);
            $db = [rand(10000, 99999)];
            $giai1 = [rand(10000, 99999)];
            $giai2 = [rand(10000, 99999), rand(10000, 99999)];
            $giai3 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai4 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai5 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai6 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai7 = [rand(11, 99), rand(11, 99), rand(11, 99), rand(11, 99)];

            $result = [$db, $giai1, $giai2, $giai3, $giai4, $giai5, $giai6, $giai7];

            GameKenno::create([
                'type' => 'xoso3p',
                'description' => 'xoso3p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => $result,
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(3);
        }
    }

    private function createGameXoso5p()
    {
        $now = now();
        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes(5);
            $db = [rand(10000, 99999)];
            $giai1 = [rand(10000, 99999)];
            $giai2 = [rand(10000, 99999), rand(10000, 99999)];
            $giai3 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai4 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai5 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai6 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
            $giai7 = [rand(11, 99), rand(11, 99), rand(11, 99), rand(11, 99)];

            $result = [$db, $giai1, $giai2, $giai3, $giai4, $giai5, $giai6, $giai7];

            GameKenno::create([
                'type' => 'xoso5p',
                'description' => 'xoso5p',
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => $result,
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes(5);
        }
    }
}
