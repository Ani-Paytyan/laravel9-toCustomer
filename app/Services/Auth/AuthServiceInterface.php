<?php

namespace App\Services\Auth;

use App\Dto\Auth\AuthCreateApiTokenDto;
use App\Dto\Auth\LoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;

interface AuthServiceInterface
{
    public function login(LoginDto $dto): IwmsApiUserDto;

    public function logout(): void;

    public function getCurrentUser(): ?IwmsApiUserDto;

    public function createApiToken(IwmsApiUserDto $user, AuthCreateApiTokenDto $dto);
}
