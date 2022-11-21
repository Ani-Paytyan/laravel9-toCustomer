<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\Auth\AuthCreateApiTokenDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @param AuthLoginRequest $request
     * @param AuthServiceInterface $authService
     * @return UserResource|JsonResponse
     *
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Api login",
     *     tags={"Login"},
     *     description="Method of login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(allOf={
     *             @OA\Schema(
     *              @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/UserResource"
     *             ),
     *              @OA\Property(
     *                 property="access_token",
     *                 type="string",
     *             ),
     *              @OA\Property(
     *                 property="push_token",
     *                 type="string",
     *                 example="6KuGyNKfO12E16iQfhprH5A00lrMnNje",
     *             )),
     *             @OA\Schema(ref="#/components/schemas/BaseResponseSchema"),
     *         })
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="The given data was invalid."
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      type="array",
     *                      @OA\Items(type="string", example="The email must be a valid email address.")
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="array",
     *                      @OA\Items(type="string", example="The password is wrong.")
     *                  ),
     *              )
     *          )
     *     ),
     * )
     */
    public function login(AuthLoginRequest $request, AuthServiceInterface $authService)
    {
        if (Auth::attempt($request->only('email', 'password', 'push_token'))) {
            $user = Auth::user();
            $token = $authService->createApiToken($user, AuthCreateApiTokenDto::createFromRequest($request));

            return (new UserResource($user))->additional([
                'message' => trans('auth.success'),
                'access_token' => $token->token,
                'push_token' => $request->get('push_token'),
            ]);
        }

        return response()->json([
            'error' => trans('auth.unauthorized')
        ], 422);
    }
}
