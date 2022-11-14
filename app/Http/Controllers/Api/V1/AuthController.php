<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password', 'push_token'))) {
           $user = Auth::user();

          // dd($user->createToken("API TOKEN")->plainTextToken);

           return response()->json([
                'message' => trans('auth.success'),
                'data' => [
                    'user' => [
                        'name' => $user->getFirstName(),
                        'lastName' => $user->getLastName(),
                        'email' => $user->getEmail(),
                    ],
                    'access_token' => $user->getToken(),
                    'push_token' => $request->get('push_token'),
                ]
            ]);
        }

        return response()->json([
            'error' => trans('auth.unauthorized')
        ], 401);
    }
}
