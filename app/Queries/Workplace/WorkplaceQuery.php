<?php

namespace App\Queries\Workplace;

use App\Models\Contact;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;

class WorkplaceQuery
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder
    {
        return Workplace::where('company_id', $companyId)->whereDoesntHave('contacts', function (Builder $query) use ($contact) {
            $query->where('contact_id', $contact->uuid);
        });
    }
}
