<?php

namespace App\Queries\Team;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

interface TeamQueryInterface
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder;
}
