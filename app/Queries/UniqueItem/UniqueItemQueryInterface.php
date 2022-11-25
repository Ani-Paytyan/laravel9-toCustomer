<?php

namespace App\Queries\UniqueItem;

use App\Dto\UniqueItem\UniqueItemSearchDto;
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

    /**
     * @param UniqueItemSearchDto $dto
     * @return Builder
     */
    public function getSearchUniqueItemQuery(UniqueItemSearchDto $dto): Builder;
}
