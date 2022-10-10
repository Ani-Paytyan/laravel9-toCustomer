<?php

namespace App\Dto\IwmsApi;

class IwmsApiWorkPlaceDto
{
    private string $id;
    private string $name;
    private string $companyId;
    private ?string $address;

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

    public static function createFromApiResponse(array $data, string $companyId): self
    {
        return (new self())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setCompanyId($companyId)
            ->setAddress($data['address']);
    }
}
