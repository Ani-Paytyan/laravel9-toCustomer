<?php

namespace App\Queries\UniqueItem;

use App\Models\Contact;
use App\Models\UniqueItem;
use Illuminate\Database\Eloquent\Builder;

class UniqueItemQuery
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder
    {
        return UniqueItem::with('item')->whereHas('workPlace', static function (Builder $query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->whereDoesntHave('contacts', function (Builder $query) use ($contact) {
            $query->where('contact_id', $contact->uuid);
        });
    }
}
