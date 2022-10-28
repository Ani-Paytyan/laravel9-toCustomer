<?php

namespace App\Dto\Team;

use App\Http\Requests\Team\TeamStoreRequest;

class TeamCreateDto
{
    private string $name;
    private ?string $description;
    private string $companyId;

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

    public static function createFromRequest(TeamStoreRequest $request, $companyId): self
    {
        return (new self())
            ->setName($request->get('name'))
            ->setCompanyId($companyId)
            ->setDescription($request->get('description'));
    }
}
