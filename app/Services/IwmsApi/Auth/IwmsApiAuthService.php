<?php

namespace App\Services\IwmsApi\Auth;

use App\Dto\IwmsApi\IwmsApiLoginDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiAuthService extends AbstractIwmsApi implements IwmsApiAuthServiceInterface
{
    public function login(IwmsApiLoginDto $dto): IwmsApiUserDto
    {
        $response = $this->getRequestBuilder()->post('login', [
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword(),
            'ip' => $dto->getIp(),
            'mac' => $dto->getMac(),
            'device' => $dto->getDevice(),
            'system' => '123',
        ]);

        return IwmsApiUserDto::createFromApiResponse($response->json());
    }

    public function logout(string $authUserToken): void
    {
        $this->setUserToken($authUserToken);
        $this->getRequestBuilder()->post('logout');
    }
}
