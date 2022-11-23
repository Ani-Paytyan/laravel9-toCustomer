<?php

namespace App\Dto\IwmsApi\WorkPlace;

class IwmsApiWorkPlaceEditDto
{
    private string $id;
    private ?string $name;
    private ?string $address;
    private ?string $zip;
    private ?string $city;
    private ?string $number;
    private ?string $companyId;
    private ?string $status;
    private ?string $sum_price;
    private ?string $description;
    private bool $isDeleted = false;

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

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
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * @return $this
     */
    public function setZip(?string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return $this
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     * @return $this
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }

    /**
     * @param string|null $companyId
     * @return $this
     */
    public function setCompanyId(?string $companyId): self
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return $this
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        if ($status === self::STATUS_DELETED) {
            $this->setIsDeleted(true);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSumPrice(): ?string
    {
        return $this->sum_price;
    }

    /**
     * @param string|null $sum_price
     * @return $this
     */
    public function setSumPrice(?string $sum_price): self
    {
        $this->sum_price = $sum_price;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
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
            ->setSumPrice($data['sum_price'])
            ->setAddress($data['address'])
            ->setZip($data['zip'])
            ->setCity($data['city'])
            ->setNumber($data['number'])
            ->setDescription($data['description'])
            ->setStatus($data['status']);
    }

    public static function createFromRequest(array $data, string $id): self
    {
        return (new self())
            ->setId($id)
            ->setName($data['name'])
            ->setAddress($data['address'])
            ->setZip($data['zip'])
            ->setCity($data['city'])
            ->setDescription($data['description'])
            ->setNumber($data['number']);
    }
}
