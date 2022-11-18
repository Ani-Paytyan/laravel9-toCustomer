<?php

namespace App\Services\Auth;

use App\Dto\Auth\AuthCreateApiTokenDto;
use App\Dto\Auth\LoginDto;
use App\Dto\IwmsApi\IwmsApiLoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Models\AccessTokens;
use App\Services\IwmsApi\Auth\IwmsApiAuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private IwmsApiAuthServiceInterface $iwmsApiAuthService
    )
    {
    }

    public function login(LoginDto $dto): IwmsApiUserDto
    {
        // TODO: set real data
        $iwmsUser = $this->iwmsApiAuthService->login((new IwmsApiLoginDto())
            ->setEmail($dto->getEmail())
            ->setPassword($dto->getPassword())
            ->setDevice(request()->header('User-Agent'))
            ->setIp(request()->header('HTTP_X_REAL_IP') ?? request()->ip())
            ->setMac('00:00:5e:00:53:af')
            ->setSystem('system')
        );

        Session::put('user', serialize($iwmsUser));

        return $iwmsUser;
    }

    public function logout(): void
    {
        $this->iwmsApiAuthService->logout(Auth::user()->getToken());
        Session::remove('user');
    }

    public function getCurrentUser(): ?IwmsApiUserDto
    {
        $serialized = Session::get('user');

        if (!$serialized) {
            return null;
        }

        return unserialize($serialized);
    }

    public function createApiToken(IwmsApiUserDto $user, AuthCreateApiTokenDto $dto)
    {
        $token = unique_random('access_tokens', 'token', 32);

        return AccessTokens::create([
            'uuid' => Str::uuid()->toString(),
            'user_id' => $user->getId(),
            'user_data' => serialize($user),
            'token' => $token,
            'push_token' => $dto->getPushToken(),
            'last_use_at' => now()
        ]);
    }

    public function getUserByApiToken(string $token): ?IwmsApiUserDto
    {
        /** @var AccessTokens $accessToken */
        $accessToken = AccessTokens::where('token', $token)->first();

        return !$accessToken?->user_data ? null : unserialize($accessToken->user_data);
    }
}
