<?php

namespace App\Dto\UniqueItemContact;

use App\Http\Requests\UniqueItem\UniqueItemStoreRequest;

class UniqueItemContactCreateDto
{
    private string $contact_id;
    private string $unique_item_id;

    /**
     * @return string|null
     */
    public function getContactId(): ?string
    {
        return $this->contact_id;
    }

    public function setContactId(?string $contact_id): self
    {
        $this->contact_id = $contact_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUniqueItemId(): ?string
    {
        return $this->unique_item_id;
    }

    public function setUniqueItemId(?string $unique_item_id): self
    {
        $this->unique_item_id = $unique_item_id;

        return $this;
    }

    /**
     * @param UniqueItemStoreRequest $request
     * @return static
     */
    public static function createFromRequest(UniqueItemStoreRequest $request): self
    {
        return (new self())
            ->setContactId($request->get('contact_id') ?? '')
            ->setUniqueItemId($request->get('unique_item_id') ?? '');
    }
}
