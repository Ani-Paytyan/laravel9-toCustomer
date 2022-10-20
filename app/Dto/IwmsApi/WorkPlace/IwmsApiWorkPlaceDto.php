<?php

namespace App\Dto\IwmsApi\WorkPlace;

class IwmsApiWorkPlaceDto
{
    private string $id;
    private string $name;
    private string $companyId;
    private ?string $address;
    private ?string $zip;
    private ?string $city;
    private ?string $number;
    private ?string $status;
    private ?string $sum_price;

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
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @param string $companyId
     * @return $this
     */
    public function setCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;

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

    public static function createFromApiResponse(array $data, string $companyId): self
    {
        return (new self())
            ->setId($data['id'])
            ->setCompanyId($companyId)
            ->setName($data['name'])
            ->setAddress($data['address'])
            ->setZip($data['zip'])
            ->setNumber($data['number'])
            ->setCity($data['city'])
            ->setStatus($data['status'])
            ->setSumPrice($data['sum_price']);
    }

    public static function createFromRequest(array $data, string $companyId): self
    {
        return (new self())
            ->setName($data['name'])
            ->setCompanyId($companyId)
            ->setAddress($data['address'])
            ->setZip($data['zip'])
            ->setCity($data['city'])
            ->setNumber($data['number']);
    }
}
