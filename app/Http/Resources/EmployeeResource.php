<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Employee Resource",
 *     type="object",
 *     schema="EmployeeResource",
 *
 *     @OA\Property(
 *         type="string",
 *         property="id",
 *         title="Id",
 *         example="1276bcff-d002-429d-b522-3c4594914407",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="first_name",
 *         title="First Name",
 *         example="Name",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="last_name",
 *         title="Last Name",
 *         example="Last Name",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="phone",
 *         title="Phone Number",
 *         example="7774744774",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="address",
 *         title="Address",
 *         example="United States",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         title="Email Address",
 *         example="test@example.com",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="role",
 *         title="Role",
 *         example="Admin",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="company_id",
 *         title="Company Id",
 *         example="1276bcff-d002-429d-b522-3c4594914407",
 *     ),
 * )
 */
class EmployeeResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid,
            'first_name' => $this->first_name ?? '',
            'last_name' => $this->last_name ?? '',
            'phone' => $this->phone ?? '',
            'address' => $this->address ?? '',
            'email' => $this->email ?? '',
            'role' => $this->role ?? '',
            'company_id' => $this->company_id ?? '',
        ];
    }
}
