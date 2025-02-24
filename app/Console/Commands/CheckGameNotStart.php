<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GameKenno;
use Illuminate\Support\Facades\Artisan;
class CheckGameNotStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-game-not-start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $kenno1p = $this->getGameNotStarted('kenno1p');
        $kenno3p = $this->getGameNotStarted('kenno3p');
        $kenno5p = $this->getGameNotStarted('kenno5p');
        $xucxac3p = $this->getGameNotStarted('xucxac3p');
        $xucxac5p = $this->getGameNotStarted('xucxac5p');
        $xoso3p = $this->getGameNotStarted('xoso3p');
        $xoso5p = $this->getGameNotStarted('xoso5p');

        if(!$kenno1p){
            $this->info('create kennop1');
            Artisan::call('app:create-game', ['name' => 'kenno1p']);
        }
        if(!$kenno3p){
            Artisan::call('app:create-game', ['name' => 'kenno3p']);
        }
        if(!$kenno5p){
            Artisan::call('app:create-game', ['name' => 'kenno5p']);
        }
        if(!$xucxac3p){
            Artisan::call('app:create-game', ['name' => 'xucxac3p']);
        }
        if(!$xucxac5p){
            Artisan::call('app:create-game', ['name' => 'xucxac5p']);
        }
        if(!$xoso3p){
            Artisan::call('app:create-game', ['name' => 'xoso3p']);
        }
        if(!$xoso5p){
            Artisan::call('app:create-game', ['name' => 'xoso5p']);
        }
    }

    private function getGameNotStarted($type)
    {
        return GameKenno::where('start_time', '>', now())
        ->orderBy('id', 'desc')
        ->where('type', $type)
        ->first();
    }
}
