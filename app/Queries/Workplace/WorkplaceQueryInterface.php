<?php

namespace App\Queries\Workplace;

use App\Dto\WorkPlace\WorkPlaceSearchDto;
use App\Models\Contact;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;

interface WorkplaceQueryInterface
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder;

    /**
     * @param WorkPlaceSearchDto $dto
     * @return Builder
     */
    public function getSearchWorkplaceQuery(WorkPlaceSearchDto $dto): Builder;

    /**
     * @param string $companyId
     * @return Builder
     */
    public function getAllWorkplaces(string $companyId): Builder;
}
