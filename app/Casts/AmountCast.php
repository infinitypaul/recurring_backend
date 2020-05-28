<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AmountCast implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return ($value/100);
    }
}
