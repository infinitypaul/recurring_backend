<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
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
            'access_token' => $this['token'],
            'user' => new UserResource(auth()->user())

        ];
    }
}
