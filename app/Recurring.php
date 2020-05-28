<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurring extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'plan' => 'array',
        'subscribe' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
