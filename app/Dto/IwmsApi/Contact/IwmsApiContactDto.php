<?php

namespace App\Dto\IwmsApi\Contact;

class IwmsApiContactDto
{
    const STATUS_ACTIVE = "Active";
    const STATUS_INVITED = "Invited";
    const STATUS_DELETED = "Deleted";

    private string $id;
    private string $role;
    private string $email;
    private ?string $phone;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $full_name;
    private string $status;
    private ?string $portal_access;
    private ?string $company_id;
    private ?string $address;
    private ?string $city;
    private ?string $zip;
    private bool $isDeleted;

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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return $this
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string|null $first_name
     * @return $this
     */
    public function setFirstName(?string $first_name): self
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     * @return $this
     */
    public function setLastName(?string $last_name): self
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    /**
     * @param string|null $full_name
     * @return $this
     */
    public function setFullName(?string $full_name): self
    {
        $this->full_name = $full_name;
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
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPortalAccess(): ?string
    {
        return $this->portal_access;
    }

    /**
     * @param string|null $portal_access
     * @return $this
     */
    public function setPortalAccess(?string $portal_access): self
    {
        $this->portal_access = $portal_access;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->company_id;
    }

    /**
     * @param string|null $company_id
     * @return $this
     */
    public function setCompanyId(?string $company_id): self
    {
        $this->company_id = $company_id;
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
            ->setCompanyId($data['company_id'])
            ->setRole($data['role'])
            ->setPhone($data['phone'])
            ->setEmail($data['email'])
            ->setAddress($data['address'])
            ->setFirstName($data['first_name'])
            ->setLastName($data['last_name'])
            ->setCity($data['city'])
            ->setZip($data['zip'])
            ->setFullName($data['full_name'])
            ->setStatus($data['status'])
            ->setIsDeleted($data['status'])
            ->setPortalAccess($data['portal_access']);
    }

    public static function createFromApiInviteResponse(array $data, $companyId): self
    {
        return (new self())
            ->setId($data['id'])
            ->setCompanyId($companyId)
            ->setRole($data['role'])
            ->setEmail($data['email']);
    }

    public static function createFromRequest(array $data, $id): self
    {
        return (new self())
            ->setCompanyId($id)
            ->setRole($data['role'])
            ->setEmail($data['email']);
    }
}
