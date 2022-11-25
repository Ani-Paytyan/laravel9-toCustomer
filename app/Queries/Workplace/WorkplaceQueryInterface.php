<?php

namespace App\Queries\Workplace;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

interface WorkplaceQueryInterface
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder;
}
