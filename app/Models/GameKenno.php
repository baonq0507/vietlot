<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameKenno extends Model
{
    protected $table = 'game_kenno';
    protected $fillable = [
        'type',
        'description',
        'start_time',
        'end_time',
        'result',
        'status',
        'code',
    ];

    protected $casts = [
        'result' => 'array',
    ];

    public function settingKenno()
    {
        return $this->hasOne(SettingKenno::class, 'type', 'type');
    }
}
