<?php

namespace App\Queries\Team;

use App\Models\Contact;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;

class TeamQuery
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder
    {
        return Team::where('company_id', $companyId)->whereDoesntHave('contacts', function (Builder $query) use ($contact) {
            $query->where('contact_id', $contact->uuid);
        });
    }
}
