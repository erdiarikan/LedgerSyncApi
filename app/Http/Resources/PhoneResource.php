<?php

namespace App\Http\Resources;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Phone */
class PhoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'phoneable' => $this->phoneable,
            'type' => $this->type,
            'number' => $this->number,
            'area_code' => $this->area_code,
            'country_code' => $this->country_code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
