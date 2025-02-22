<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\UserGame;
use App\Models\GameKenno;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Validator;

class Xoso5pPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static string $view = 'filament.pages.xoso5p-page';

    protected static ?string $navigationLabel = 'Sét Kèo Xổ số 5P';

    protected static ?string $navigationGroup = 'Quản lý trò chơi';

    public $userGames;
    public $currentCode;
    public $gameId;
    public $gameRunning;
    public $diffTime;
    public $listGame;
    public $result;
    public $resultGame;
    public $game;
    public function mount()
    {
        $this->gameRunning = $this->getGameRunning();
        $this->userGames = $this->getUserGames($this->gameRunning->id);
        $this->diffTime = $this->diffTime();
        $this->listGame = $this->getListGame();
        $this->result = $this->gameRunning->result;
        $this->game = $this->listGame[0];
    }

    public function getListGame()
    {
        return GameKenno::where('status', 'completed')
            ->where('type', 'xoso5p')
            ->orderBy('start_time', 'asc')
            ->limit(20)
            ->get();
    }

    public function getGameRunning()
    {
        return GameKenno::where('status', 'running')
            ->where('type', 'xoso5p')
            ->first();
    }

    //diff time
    public function diffTime()
    {
        $now = now();
        $endTime = $this->gameRunning->end_time;
        $diff = $now->diff($endTime);
        $minutes = $diff->i;
        $seconds = $diff->s;
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function getTitle(): string
    {
        return 'Xổ số 5P';
    }

    public function getUserGames($id)
    {
        return UserGame::where('game_id', operator: $id)->get();
    }

    //change current code
    public function changeCurrentCode($code)
    {
        $this->currentCode = $code;
    }

    public function changeGameId($id)
    {
        $this->gameId = $id;
        $this->userGames = $this->getUserGames($this->gameId);
        $this->gameRunning = $this->getGameRunning();
        $this->result = $this->gameRunning->result;
        $this->listGame = $this->getListGame();
    }


    public function changeResult()
    {
        foreach ($this->result as $level => $prizes) {
            foreach ($prizes as $prize => $value) {
                $this->resultGame[$level][$prize] = $value;
            }
        }
        $this->gameRunning->result = $this->resultGame;
        $this->gameRunning->save();
        $this->gameRunning = $this->getGameRunning();
        $this->userGames = $this->getUserGames($this->gameRunning->id);
        $this->diffTime = $this->diffTime();
        $this->listGame = $this->getListGame();
        $this->result = $this->gameRunning->result;
        Notification::make()
            ->title('Cập nhật kết quả thành công')
            ->success()
            ->send();
    }

    public function randomResult()
    {
        $db = [rand(10000, 99999)];
        $giai1 = [rand(10000, 99999)];
        $giai2 = [rand(10000, 99999), rand(10000, 99999)];
        $giai3 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
        $giai4 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
        $giai5 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
        $giai6 = [rand(10000, 99999), rand(10000, 99999), rand(10000, 99999)];
        $giai7 = [rand(11, 99), rand(11, 99), rand(11, 99), rand(11, 99)];

        $result = [$db, $giai1, $giai2, $giai3, $giai4, $giai5, $giai6, $giai7];

        $this->gameRunning->result = $result;
        $this->gameRunning->save();
        Notification::make()
            ->title('Cập nhật kết quả thành công')
            ->success()
            ->send();
        $this->gameRunning = $this->getGameRunning();
        $this->userGames = $this->getUserGames($this->gameRunning->id);
        $this->diffTime = $this->diffTime();
        $this->listGame = $this->getListGame();
        $this->result = $this->gameRunning->result;
    }

    public function changeGame($id)
    {
        $this->game = GameKenno::find($id);
    }
}
