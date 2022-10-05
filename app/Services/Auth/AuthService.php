<?php

namespace App\Services\Auth;

use App\Dto\Auth\LoginDto;
use App\Dto\IwmsApi\IwmsApiLoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Services\IwmsApi\Auth\IwmsApiAuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            ->setDevice('device')
            ->setIp('127.0.0.1')
            ->setMac('00:00:5e:00:53:af')
            ->setSystem('system')
        );

        Session::put('user', serialize($iwmsUser));

        return $iwmsUser;
    }

    public function logout(): void
    {
        $this->iwmsApiAuthService->logout();
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
}