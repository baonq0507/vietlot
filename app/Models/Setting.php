<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'min_bet',
        'max_bet',
        'min_withdraw',
        'max_withdraw',
        'min_deposit',
        'max_deposit',
        'cskh',
    ];
}
