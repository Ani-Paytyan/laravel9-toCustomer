<?php

namespace App\Queries\Employee;

use App\Models\Team;
use App\Models\UniqueItem;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;

interface EmployeeQueryInterface
{
    /**
     * @param WorkPlace $workplace
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToWorkPlaceQuery(WorkPlace $workplace, string $companyId): Builder;

    /**
     * @param UniqueItem $uniqueItem
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToUniqueItemQuery(UniqueItem $uniqueItem, string $companyId): Builder;

    /**
     * @param Team $team
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToTeamQuery(Team $team, string $companyId): Builder;
}
