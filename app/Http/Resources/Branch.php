<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Branch extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->addres,
            'map' => $this->map,
            'tel' => $this->tel,
            'email' => $this->email,
        ];
    }
}
