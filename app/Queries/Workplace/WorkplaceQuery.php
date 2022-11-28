<?php

namespace App\Queries\Workplace;

use App\Dto\WorkPlace\WorkPlaceSearchDto;
use App\Models\Contact;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;

class WorkplaceQuery implements WorkplaceQueryInterface
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

    /**
     * @param WorkPlaceSearchDto $dto
     * @return Builder
     */
    public function getSearchWorkplaceQuery(WorkPlaceSearchDto $dto): Builder
    {
        $query = Workplace::query();

        if ($dto->getName() !== null) {
            $query->where('name', 'like', "%{$dto->getName()}%");
        }

        if ($dto->getAddress() !== null) {
            $query->where('address', 'like', "%{$dto->getAddress()}%");
        }

        if ($dto->getCity() !== null) {
            $query->where('city', 'like', "%{$dto->getCity()}%");
        }

        if ($dto->getCompanyId() !== null) {
            $query->where('company_id', '=', $dto->getCompanyId());
        }

        return $query;
    }
}
