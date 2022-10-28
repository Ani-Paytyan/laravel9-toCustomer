<?php

namespace App\Dto\TeamContact;

use App\Http\Requests\TeamContact\TeamContactStoreRequest;

class TeamContactCreateDto
{
    private string $contact_id;
    private string $team_id;
    private string $role;

    /**
     * @return string
     */
    public function getContactId(): string
    {
        return $this->contact_id;
    }

    public function setContactId(string $contact_id): self
    {
        $this->contact_id = $contact_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTeamId(): string
    {
        return $this->team_id;
    }

    public function setTeamId(string $team_id): self
    {
        $this->team_id = $team_id;

        return $this;
    }

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
     * @param TeamContactStoreRequest $request
     * @return static
     */
    public static function createFromRequest(TeamContactStoreRequest $request): self
    {
        return (new self())
            ->setContactId($request->get('contact_id'))
            ->setTeamId($request->get('team_id'))
            ->setRole($request->get('role'));
    }
}
