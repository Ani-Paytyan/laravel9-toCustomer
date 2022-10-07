<?php

namespace App\Dto\IwmsApi;

class IwmsApiCompanyDto
{
    public string $id;
    public string $name;
    public ?string $address;
    public string $type;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return $this
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setType($data['type'])
            ->setAddress($data['address']);
    }
}
