<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'beds' => $this->beds,
            'baths' => $this->baths,
            'area' => $this->area,
            'city' => $this->city,
            'code' => $this->code,
            'street' => $this->street,
            'street_nr' => $this->street_nr,
        ];
    }
}
