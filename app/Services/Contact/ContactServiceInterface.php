<?php

namespace App\Services\Contact;

use App\Dto\Contact\ContactDto;
use App\Dto\Contact\ContactEditDto;
use App\Models\Contact;

interface ContactServiceInterface
{
    public function sync(array $contacts): void;

    /**
     * @param ContactDto $contactDto
     * @return Contact
     */
    public function create(ContactDto $contactDto): Contact;

    /**
     * @param ContactEditDto $contactEditDto
     * @param Contact $contact
     * @return bool
     */
    public function update(ContactEditDto $contactEditDto, Contact $contact): bool;

    /**
     * @param Contact $contact
     * @return bool
     */
    public function restore(Contact $contact): bool;

    /**
     * @param Contact $contact
     * @return bool
     */
    public function destroy(Contact $contact): bool;
}
