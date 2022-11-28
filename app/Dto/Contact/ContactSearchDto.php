<?php

namespace App\Dto\Contact;

use Illuminate\Http\Request;

class ContactSearchDto
{
    private string $company_id;
    private ?array $role;
    private ?array $status;
    private ?string $email;
    private ?string $first_name;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
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
     * @return array|null
     */
    public function getStatus(): ?array
    {
        return $this->status;
    }

    /**
     * @param array|null $status
     * @return $this
     */
    public function setStatus(?array $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getRole(): ?array
    {
        return $this->role;
    }

    /**
     * @param array|null $role
     * @return $this
     */
    public function setRole(?array $role): self
    {
        $this->role = $role;
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

    public static function createFromRequest(Request $request, $companyId): self
    {
        return (new self())
            ->setCompanyId($companyId)
            ->setFirstName($request->get('name'))
            ->setEmail($request->get('email'))
            ->setRole($request->get('role'))
            ->setStatus($request->get('status'));
    }
}
