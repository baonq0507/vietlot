<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'amount', 'type', 'status', 'balance', 'description', 'bank_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Banks::class)->orWhere(function($query) {
            return $query->belongsTo(UserBank::class);
        });
    }
}
