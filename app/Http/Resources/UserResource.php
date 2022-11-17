<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->resource->getFirstName(),
            'lastName' => $this->resource->getLastName(),
            'email' => $this->resource->getEmail(),
        ];
    }
}
