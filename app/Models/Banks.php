<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $fillable = [
        'bank_name',
        'bank_number',
        'bank_owner',
        'status',
    ];
}
