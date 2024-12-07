<?php

namespace App\Http\Resources;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Contact */
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contactable' => $this->contactable,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'status' => $this->status,
            'contact_created_at' => $this->contact_created_at,
            'contact_updated_at' => $this->contact_updated_at,
            'is_supplier' => $this->is_supplier,
            'is_customer' => $this->is_customer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
