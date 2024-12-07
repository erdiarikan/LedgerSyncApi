<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Address */
class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'addressable' => $this->addressable,
            'type' => $this->type,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'address_line_3' => $this->address_line_3,
            'address_line_4' => $this->address_line_4,
            'address_line_5' => $this->address_line_5,
            'city' => $this->city,
            'region' => $this->region,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'attention_to' => $this->attention_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
