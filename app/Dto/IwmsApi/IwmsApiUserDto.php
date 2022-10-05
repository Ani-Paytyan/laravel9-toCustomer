<?php

namespace App\Dto\IwmsApi;

use Illuminate\Contracts\Auth\Authenticatable;

class IwmsApiUserDto implements Authenticatable
{
    private string $id;
    private string $email;
    private string $role;
    private string $firstName;
    private string $lastName;
    private string $token;

    private IwmsApiCompanyDto $company;

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getCompany(): IwmsApiCompanyDto
    {
        return $this->company;
    }

    public function setCompany(IwmsApiCompanyDto $company): static
    {
        $this->company = $company;
        return $this;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getId();
    }

    public function getAuthPassword()
    {
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }


    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setEmail($data['user']['email'])
            ->setRole($data['user']['role'])
            ->setId($data['user']['id'])
            ->setFirstName($data['user']['first_name'])
            ->setLastName($data['user']['last_name'])
            ->setCompany(IwmsApiCompanyDto::createFromApiResponse($data['user']['company']))
            ->setToken($data['token']);
    }
}