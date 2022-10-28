<?php

namespace App\Dto\TeamContact;

use App\Http\Requests\TeamContact\TeamContactUpdateRequest;

class TeamContactUpdateDto
{
    private string $role;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param TeamContactUpdateRequest $request
     * @return static
     */
    public static function createFromRequest(TeamContactUpdateRequest $request): self
    {
        return (new self())
            ->setRole($request->get('role'));
    }
}
