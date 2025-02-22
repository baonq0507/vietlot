<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'phone',
        'password',
        'balance',
        'role',
        'last_login_at',
        'ip_address',
        'user_agent',
        'is_locked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    //total withdraw
    public function getTotalWithdrawAttribute()
    {
        return (float) $this->transactions()->where('type', 'withdraw')
        ->where('status', 'success')
        ->sum('amount');
    }

    public function getTotalDepositAttribute()
    {
        return (float) $this->transactions()->where('type', 'deposit')
        ->where('status', 'success')
        ->sum('amount');
    }

    public function getTotalRewardAttribute()
    {
        return (float) $this->transactions()->where('type', 'reward')
        ->where('status', 'success')
        ->sum('amount');
    }

    public function getTotalWinAttribute()
    {
        return $this->userGames()->where('result', 'win')
        ->sum('total_win');
    }

    public function getTotalBetAttribute()
    {
        return $this->userGames()->sum('total_money');
    }

    public function userGames()
    {
        return $this->hasMany(UserGame::class);
    }

    public function userBanks()
    {
        return $this->hasMany(UserBank::class);
    }
}
