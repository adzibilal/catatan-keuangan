<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 