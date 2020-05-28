<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name  = explode(' ', $this->name);
        return [
            'firstName' => ucwords($name[0]),
            'lastName' => $name[1] ?? '',
            'email' => $this->email,
            'auth_code' => $this->auth_code ? true :  false
        ];
    }
}
