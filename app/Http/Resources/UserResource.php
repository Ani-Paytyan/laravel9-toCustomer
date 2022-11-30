<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="User Resource",
 *     type="object",
 *     schema="UserResource",
 *
 *     @OA\Property(
 *         type="string",
 *         property="name",
 *         title="Name",
 *         example="Name",
 *     ),
 *
 *     @OA\Property(
 *         type="string",
 *         property="lastName",
 *         title="Last Name",
 *         example="LastName",
 *     ),
 *
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         title="Email Address",
 *         example="test@example.com",
 *     ),
 * )
 */
class UserResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->getFirstName(),
            'lastName' => $this->resource->getLastName(),
            'email' => $this->resource->getEmail(),
        ];
    }
}
