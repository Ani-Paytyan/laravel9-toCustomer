<?php

namespace App\Services\Team;

use App\Dto\Team\TeamCreateDto;
use App\Dto\Team\TeamUpdateDto;
use App\Models\Team;
use Illuminate\Support\Str;

class TeamService implements TeamServiceInterface
{

    /**
     * @param TeamCreateDto $dto
     * @return Team
     */
    public function create(TeamCreateDto $dto): Team
    {
        return Team::create([
            'uuid' => Str::uuid()->toString(),
            'company_id' => $dto->getCompanyId(),
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);

    }

    /**
     * @param TeamUpdateDto $dto
     * @return bool
     */
    public function update(TeamUpdateDto $dto, Team $team): bool
    {
        return $team->update([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);
    }

    /**
     * @param Team $team
     * @return bool
     */

    public function destroy(Team $team): bool
    {
        return $team->delete();
    }
}
