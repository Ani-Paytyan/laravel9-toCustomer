<?php

namespace App\Dto\Team;

use App\Http\Requests\Team\TeamUpdateRequest;

class TeamUpdateDto
{
    private string $id;
    private string $name;
    private ?string $description;

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

    public static function createFromRequest(TeamUpdateRequest $request, $id): self
    {
        return (new self())
            ->setId($id)
            ->setName($request->get('name'))
            ->setDescription($request->get('description'));
    }
}
