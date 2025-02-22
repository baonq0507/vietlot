<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GameKenno;
class CreateGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    //thêm tham số vào command
    protected $signature = 'app:create-game {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new game';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //lấy tên game từ tham số
        $name = $this->argument('name');
        $step = str_contains($name, '1p') ? 1 : (str_contains($name, '3p') ? 3 : (str_contains($name, '5p') ? 5 : 1));
        //tạo game mới
        $now = now();

        for ($i = 0; $i < 20; $i++) {
            $endTime = $now->copy()->addMinutes($step);
            $num1 = rand(0, 9);
            $num2 = rand(0, 9);
            $num3 = rand(0, 9);
            $num4 = rand(0, 9);
            $num5 = rand(0, 9);
            $total = $num1 + $num2 + $num3 + $num4 + $num5;
            $result = [];
            if(str_contains($name, 'xucxac')){
                $total = $num1 + $num2 + $num3;
                $result = [$total, $num1, $num2, $num3];
            }else if(str_contains($name, 'kenno')){
                $result = [$total, $num1, $num2, $num3, $num4, $num5];
            } else if (str_contains($name, 'xoso')) {
                // taok kết quả xổ số 3p
                $db = [rand(10000, 99999)];
                $giai1 = [rand(10000, 99999)];
                $giai2 = [rand(10000, 99999), rand(10000, 99999)];
                $giai3 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
                $giai4 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
                $giai5 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
                $giai6 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
                $giai7 = [rand(11, 99), rand(11, 99), rand(11, 99), rand(11, 99)];

                $result = [$db, $giai1, $giai2, $giai3, $giai4, $giai5, $giai6, $giai7];

            }
            GameKenno::create([
                'type' => $name,
                'description' => $name,
                'start_time' => $now,
                'end_time' => $endTime,
                'status' => 'not_started',
                'result' => $result,
                'code' => rand(100000, 999999)
            ]);
            $now = $now->addMinutes($step);
        }
    }
}
