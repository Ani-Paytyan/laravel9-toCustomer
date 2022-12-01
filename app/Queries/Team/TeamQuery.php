<?php

namespace App\Queries\Team;

use App\Dto\Team\TeamSearchDto;
use App\Models\Contact;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;

class TeamQuery implements TeamQueryInterface
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

    public function getSearchTeamQuery(TeamSearchDto $dto): Builder
    {
        $query = Team::query();

        if ($dto->getCompanyId() !== null) {
            $query->where('company_id', '=', $dto->getCompanyId());
        }

        if ($dto->getName() !== null) {
            $query->where('name', 'like', "%{$dto->getName()}%");
        }

        if ($dto->getDescription() !== null) {
            $query->where('description', 'like', "%{$dto->getDescription()}%");
        }

        return $query;
    }

    /**
     * @param string $companyId
     * @return Builder
     */
    public function getAllTeams(string $companyId): Builder
    {
        return Team::where('company_id', $companyId);
    }
}
