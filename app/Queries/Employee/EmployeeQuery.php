<?php

namespace App\Queries\Employee;

use App\Models\Contact;
use App\Models\Team;
use App\Models\UniqueItem;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;

class EmployeeQuery
{
    /**
     * @param WorkPlace $workplace
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToWorkPlaceQuery(WorkPlace $workplace, string $companyId): Builder
    {
        return Contact::where('company_id', $companyId)->whereDoesntHave('workplaces', function (Builder $query) use ($workplace) {
            $query->where('workplace_id', $workplace->uuid);
        });
    }

    /**
     * @param UniqueItem $uniqueItem
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToUniqueItemQuery(UniqueItem $uniqueItem, string $companyId): Builder
    {
        return Contact::where('company_id', $companyId)->whereDoesntHave('uniqueItems', function (Builder $query) use ($uniqueItem) {
            $query->where('unique_item_id', $uniqueItem->uuid);
        });
    }

    /**
     * @param Team $team
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToTeamQuery(Team $team, string $companyId): Builder
    {
        return Contact::where('company_id', $companyId)->whereDoesntHave('teams', function (Builder $query) use ($team) {
            $query->where('team_id', $team->uuid);
        });
    }
}
