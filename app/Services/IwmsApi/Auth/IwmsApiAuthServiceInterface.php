<?php

namespace App\Services\IwmsApi\Auth;

use App\Dto\IwmsApi\IwmsApiLoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;

interface IwmsApiAuthServiceInterface
{
    public function login(IwmsApiLoginDto $dto): IwmsApiUserDto;

    public function logout(): void;
}