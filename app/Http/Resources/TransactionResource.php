<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
          'reference' => $this->reference,
          'price' => $this->price,
          'paid' => (bool)$this->paid,
          'service' =>  new ServiceResource($this->service),
        ];
    }
}
