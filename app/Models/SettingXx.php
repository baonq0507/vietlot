<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingXx extends Model
{
    protected $fillable = ['type', 'reward_win', 'reward_win_2', 'reward_win_3', 'reward_win_2_every', 'reward_win_3_every'];
}
