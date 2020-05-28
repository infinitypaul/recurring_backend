<?php

namespace App;

use App\Casts\AmountCast;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'price' => AmountCast::class,
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
