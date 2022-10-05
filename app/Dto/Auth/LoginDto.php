<?php

namespace App\Dto\Auth;

use App\Http\Requests\Auth\AuthLoginRequest;

class LoginDto
{
    private string $email;
    private string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public static function createFromRequest(AuthLoginRequest $loginRequest): self
    {
        return (new self())
            ->setEmail($loginRequest->get('email'))
            ->setPassword($loginRequest->get('password'));
    }
}