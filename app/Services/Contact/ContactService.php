<?php

namespace App\Services\Contact;

use App\Dto\Contact\ContactDto;
use App\Dto\Contact\ContactEditDto;
use App\Models\Contact;

class ContactService implements ContactServiceInterface
{
    public function sync(array $contacts): void
    {
        $idContacts = [];
        foreach ($contacts as $contact) {
            $idContacts[] = $contact->getId();
            // update or create Contacts
            Contact::withTrashed()->updateOrCreate([
                'uuid' => $contact->getId()
            ], [
                'company_id' => $contact->getCompanyId(),
                'first_name' => $contact->getFirstName(),
                'last_name' => $contact->getLastName(),
                'email' => $contact->getEmail(),
                'role' => $contact->getRole(),
                'phone' => $contact->getPhone(),
                'address' => $contact->getAddress() ?? '',
                'city' => $contact->getCity(),
                'zip' => $contact->getZip(),
                'status' => $contact->getStatus(),
                'deleted_at' => null,
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idContacts)) {
            Contact::withTrashed()->whereNotIn('uuid', $idContacts)->delete();
        }
    }

    public function create(ContactDto $contactDto): Contact
    {
        return Contact::create([
            'uuid' => $contactDto->getId(),
            'company_id' => $contactDto->getCompanyId(),
            'email' => $contactDto->getEmail(),
            'role' => $contactDto->getRole(),
        ]);
    }

    public function update(ContactEditDto $contactEditDto, Contact $contact): bool
    {
        return $contact->update([
            'first_name' => $contactEditDto->getFirstName(),
            'last_name' => $contactEditDto->getLastName(),
            'address' => $contactEditDto->getAddress(),
            'email' => $contactEditDto->getEmail(),
            'role' => $contactEditDto->getRole(),
            'phone' => $contactEditDto->getPhone(),
            'zip' => $contactEditDto->getZip(),
            'city' => $contactEditDto->getCity(),
            'status' => $contactEditDto->getStatus(),
            'company_id' => $contactEditDto->getCompanyId(),
        ]);
    }

    public function destroy(Contact $contact): bool
    {
        // detach all work place contacts
        $contact->workplaces()->detach();

        return $contact->delete();
    }
}
