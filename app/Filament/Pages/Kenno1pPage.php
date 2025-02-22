<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\UserGame;
use App\Models\GameKenno;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
class Kenno1pPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static string $view = 'filament.pages.kenno1p-page';

    protected static ?string $navigationLabel = 'Sét Kèo Kenno 1P';

    protected static ?string $navigationGroup = 'Quản lý trò chơi';

    public $userGames;
    public $currentCode;
    public $gameId;
    public $gameRunning;
    public $diffTime;
    public $listGame;
    public $result;
    public $resultGame;
    public function mount()
    {
        $this->gameRunning = $this->getGameRunning();
        $this->userGames = $this->getUserGames($this->gameRunning->id);
        $this->diffTime = $this->diffTime();
        $this->listGame = $this->getListGame();
        $this->result = "";
        $this->resultGame = [];
    }

    public function getListGame()
    {
        return GameKenno::where('status', 'not_started')
            ->where('type', 'kenno1p')
            ->orderBy('start_time', 'asc')
            ->limit(20)
            ->get();
    }

    public function getGameRunning()
    {
        return GameKenno::where('status', 'running')
            ->where('type', 'kenno1p')
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
        return 'Kenno 1P';
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
        $this->listGame = $this->getListGame();
    }
    protected function getViewData(): array
    {
        return [
            'class' => 'gap-y-1',
        ];
    }

    public function changeResult()
    {
        $result = explode(',', $this->result);
        if (count($result) !== 5) {
            Notification::make()
                ->title('Vui lòng nhập đủ 5 số, cách nhau bằng dấu phẩy')
                ->danger()
                ->send();
            return;
        }
        $total = array_sum($result);
        $result = array_merge([$total], $result);
        $game = GameKenno::find($this->gameId);
        $game->result = $result;
        $game->save();
        $this->result = "";
        Notification::make()
            ->title('Cập nhật kết quả thành công')
            ->success()
            ->send();
    }

    public function changeResultGame($id)
    {

        $result = explode(',', $this->resultGame[$id]);
        if (count($result) !== 5) {
            Notification::make()
                ->title('Vui lòng nhập đủ 5 số, cách nhau bằng dấu phẩy')
                ->danger()
                ->send();
            return;
        }

        $total = array_sum($result);
        $result = array_merge([$total], $result);
        $game = GameKenno::find($id);
        $game->result = $result;
        $game->save();
        $this->resultGame[$id] = "";
        $this->listGame = $this->getListGame();
        Notification::make()
            ->title('Cập nhật kết quả thành công')
            ->success()
            ->send();
    }
}
