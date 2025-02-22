<?php

namespace App\Filament\Widgets;

use App\Models\UserGame;
use App\Models\User;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalDeposit extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tổng tiền đặt cược', UserGame::where('status', 'success')->sum('money'))
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('Tổng tiền thắng', UserGame::where('status', 'success')->sum('total_win'))
                ->icon('heroicon-o-trophy'),
            Stat::make('Tổng cược', UserGame::where('status', 'success')->sum('total_money'))
                ->icon('heroicon-o-banknotes'),
            Stat::make('Tổng người chơi', User::count())
                ->icon('heroicon-o-users'),
            Stat::make('Tổng tiền nạp', Transaction::where('type', 'deposit')->where('status', 'success')->sum('amount'))
                ->icon('heroicon-o-arrow-trending-up'),
            Stat::make('Tổng tiền rút', Transaction::where('type', 'withdraw')->where('status', 'success')->sum('amount'))
                ->icon('heroicon-o-arrow-trending-down'),
        ];
    }
}
