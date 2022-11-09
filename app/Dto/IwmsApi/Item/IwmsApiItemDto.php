<?php

namespace App\Dto\IwmsApi\Item;

class IwmsApiItemDto
{
    private string $id;
    private string $name;
    private string $status;
    private ?string $serial_number;
    private bool $isDeleted = false;

    const STATUS_ACTIVE = "Active";
    const STATUS_DELETED = "Deleted";

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
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
     * @return string|null
     */
    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    /**
     * @param string|null $serial_number
     * @return $this
     */
    public function setSerialNumber(?string $serial_number): self
    {
        $this->serial_number = $serial_number;
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
            ->setStatus($data['status'])
            ->setSerialNumber($data['serial_number']);
    }
}
