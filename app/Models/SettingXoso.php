<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingXoso extends Model
{
    protected $fillable = [
        'type',
        'lo_thuong',
        'ba_cang',
        'db',
        'lo_xien_2',
        'lo_xien_3',
        'lo_xien_4',
    ];
}
