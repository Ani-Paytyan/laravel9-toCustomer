<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/user/info",
     *     summary="Get user information",
     *     tags={"User information"},
     *     description="Index method of user",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(allOf={
     *             @OA\Schema(@OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/UserResource"),
     *             )),
     *         })
     *     ),
     *     @OA\Response(response=422, ref="#/components/responses/ValidationFailedResponse"),
     * )
     */
    public function index(): UserResource
    {
        return new UserResource(Auth::user());
    }
}
