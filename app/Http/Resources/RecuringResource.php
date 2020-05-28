<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RecuringResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'plan' => ucwords($this->plan['interval']),
            'payment_date' => Carbon::parse($this->subscribe['next_payment_date'])->toDayDateTimeString()
        ];
    }
}
