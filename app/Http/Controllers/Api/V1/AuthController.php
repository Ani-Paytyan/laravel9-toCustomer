<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\Auth\AuthCreateApiTokenDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Resources\UserLoginResource;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param AuthLoginRequest $request
     * @param AuthServiceInterface $authService
     * @return UserLoginResource|JsonResponse
     */
    public function login(AuthLoginRequest $request, AuthServiceInterface $authService)
    {
        if (Auth::attempt($request->only('email', 'password', 'push_token'))) {
           $user = Auth::user();
           $token = $authService->createApiToken($user, AuthCreateApiTokenDto::createFromRequest($request));

            return (new UserLoginResource($user))->additional([
                'message' => trans('auth.success'),
                'access_token' => $token->token,
                'push_token' => $request->get('push_token'),
            ]);
        }

        return response()->json([
            'error' => trans('auth.unauthorized')
        ], 401);
    }
}
