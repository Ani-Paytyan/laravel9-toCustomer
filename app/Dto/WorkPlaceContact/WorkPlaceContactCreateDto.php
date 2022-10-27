<?php

namespace App\Dto\WorkPlaceContact;

use App\Http\Requests\WorkPlaceContact\WorkPlaceContactStoreRequest;

class WorkPlaceContactCreateDto
{
    private string $contact_id;
    private string $workplace_id;

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
    public function getWorkPlaceId(): string
    {
        return $this->workplace_id;
    }

    public function setWorkPlaceId(string $workplace_id): self
    {
        $this->workplace_id = $workplace_id;

        return $this;
    }

    /**
     * @param WorkPlaceContactStoreRequest $request
     * @return static
     */
    public static function createFromRequest(WorkPlaceContactStoreRequest $request): self
    {
        return (new self())
            ->setContactId($request->get('contact_id'))
            ->setWorkPlaceId($request->get('workplace_id'));
    }
}
