<?php

namespace App\Dto\IwmsApi;

class IwmsApiCompanyDto
{
    private string $id;
    private string $name;
    private ?string $address;
    private string $type;
    private bool $isDeleted;

    const STATUS_DELETED = "Deleted";

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

    /**
     * @return bool
     */
    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setIsDeleted(string $status): self
    {
        $this->isDeleted = false;

        if ($status === self::STATUS_DELETED) {
            $this->isDeleted = true;
        }

        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setType($data['type'])
            ->setIsDeleted($data['status'])
            ->setAddress($data['address']);
    }
}
