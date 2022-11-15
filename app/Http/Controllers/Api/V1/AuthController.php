<?php

namespace App\Http\Controllers\Api\V1;

use App\Dto\Auth\AuthCreateApiTokenDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    /**
     * @param AuthLoginRequest $request
     * @param AuthServiceInterface $authService
     * @return JsonResponse
     */
    public function login(AuthLoginRequest $request, AuthServiceInterface $authService): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password', 'push_token'))) {
           $user = Auth::user();
           $token = $authService->createApiToken($user, AuthCreateApiTokenDto::createFromRequest($request));

           return response()->json([
                'message' => trans('auth.success'),
                'data' => [
                    'user' => [
                        'name' => $user->getFirstName(),
                        'lastName' => $user->getLastName(),
                        'email' => $user->getEmail(),
                        'access_token' => $user->getToken()
                    ],
                    'access_token' => $token->token ?? '',
                    'push_token' => $request->get('push_token'),
                ]
            ]);
        }

        return response()->json([
            'error' => trans('auth.unauthorized')
        ], 401);
    }
}
