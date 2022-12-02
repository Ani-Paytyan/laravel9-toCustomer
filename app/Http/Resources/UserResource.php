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
 *         property="id",
 *         title="Id",
 *         example="1276bcff-d002-429d-b522-3c4594914407",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="name",
 *         title="Name",
 *         example="Name",
 *     ),
 *
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         title="Email Address",
 *         example="test@example.com",
 *     ),
 *
 *     @OA\Property(
 *         type="string",
 *         property="role",
 *         title="Role",
 *         example="Admin",
 *     ),
 *
 *     @OA\Property(
 *         type="string",
 *         property="companyId",
 *         title="CompanyId",
 *         example="1276bcff-d002-429d-b522-3c4594914407",
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
            'id' => $this?->resource?->getId(),
            'name' => $this?->resource?->getFirstName(),
            'email' => $this?->resource?->getEmail(),
            'role' => $this?->resource?->getRole(),
            'company_id' => $this?->resource?->getCompany()?->getId(),
        ];
    }
}
