<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    protected $fillable = ['user_id', 'game_id', 'money', 'choose', 'status', 'total_money', 'result', 'total_win'];

    protected $casts = [
        'choose' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(GameKenno::class);
    }


}
