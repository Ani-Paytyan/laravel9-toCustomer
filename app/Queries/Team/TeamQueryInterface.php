<?php

namespace App\Queries\Team;

use App\Dto\Team\TeamSearchDto;
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

    /**
     * @param TeamSearchDto $dto
     * @return Builder
     */
    public function getSearchTeamQuery(TeamSearchDto $dto): Builder;

    /**
     * @param string $companyId
     * @return Builder
     */
    public function getAllTeams(string $companyId): Builder;
}
