<?php

namespace App\Dto\Contact;

class ContactInviteDto extends ContactDto
{
    private ?array $workplace;
    private ?array $team;
    private ?array $uniqueItem;

    /**
     * @return array|null
     */
    public function getWorkPlace(): ?array
    {
        return $this->workplace;
    }

    /**
     * @param array|null $workplace
     * @return $this
     */
    public function setWorkPlace(?array $workplace): self
    {
        $this->workplace = $workplace;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getTeam(): ?array
    {
        return $this->team;
    }

    /**
     * @param array|null $team
     * @return $this
     */
    public function setTeam(?array $team): self
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getUniqueItem(): ?array
    {
        return $this->uniqueItem;
    }

    /**
     * @param array|null $uniqueItem
     * @return $this
     */
    public function setUniqueItem(?array $uniqueItem): self
    {
        $this->uniqueItem = $uniqueItem;
        return $this;
    }

    public static function createFromRequest(array $data): self
    {
        return (new self())
            ->setWorkPlace($data['workplace'] ?? null)
            ->setTeam($data['team'] ?? null)
            ->setUniqueItem($data['uniqueItem'] ?? null);
    }
}
