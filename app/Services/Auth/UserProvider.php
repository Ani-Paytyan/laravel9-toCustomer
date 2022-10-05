<?php

namespace App\Services\Auth;

use App\Dto\Auth\LoginDto;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as Contract;

class UserProvider implements Contract
{
    public function __construct(private AuthServiceInterface $authService)
    {
    }

    public function retrieveById($identifier)
    {
        $currentUser = $this->authService->getCurrentUser();

        if (
            !$currentUser
            || $identifier !== $currentUser->getId()
        ) {
            return null;
        }

        return $currentUser;
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (!isset($credentials['email']) || !isset($credentials['password'])) {
            return null;
        }

        $user = null;

        $user = $this->authService->login((new LoginDto())
            ->setEmail($credentials['email'])
            ->setPassword($credentials['password'])
        );

        return $user;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        try {
            $this->authService->login((new LoginDto())
                ->setEmail($user->getEmail())
                ->setPassword($credentials['password'])
            );

            $valid = true;
        } catch (\Exception) {
            $valid = false;
        }

        return $valid;
    }
}