<?php

namespace App\Dto\IwmsApi;

class IwmsApiCompanyDto
{
    private string $id;
    private string $name;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setId($data['id'])
            ->setName($data['name']);
    }
}