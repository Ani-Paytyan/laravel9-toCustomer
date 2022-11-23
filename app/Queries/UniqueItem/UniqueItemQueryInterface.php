<?php

namespace App\Queries\UniqueItem;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

interface UniqueItemQueryInterface
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder;
}
