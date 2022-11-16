<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user' => [
                'name' => $this->resource->getFirstName(),
                'lastName' => $this->resource->getLastName(),
                'email' => $this->resource->getEmail(),
                'access_token' => $this->resource->getToken()
            ]
        ];
    }
}
