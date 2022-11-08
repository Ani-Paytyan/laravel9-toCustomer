<?php

namespace App\Dto\IwmsApi;

class IwmsApiCompanyDto
{
    private string $id;
    private string $name;
    private ?string $address;
    private string $type;
    private string $status;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        if ($status === self::STATUS_DELETED) {
            $this->setIsDeleted(true);
        }

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
     * @param bool $isDeleted
     * @return $this
     */
    public function setIsDeleted(bool $isDeleted = false): self
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setType($data['type'])
            ->setStatus($data['status'])
            ->setAddress($data['address']);
    }
}
