<?php

namespace App\Services\Team;

use App\Dto\Team\TeamCreateDto;
use App\Dto\Team\TeamUpdateDto;
use App\Models\Team;

class TeamService implements TeamServiceInterface
{

    public function create(TeamCreateDto $dto): Team
    {
        // TODO: Implement create() method.
    }

    public function update(TeamUpdateDto $dto): Team
    {
        // TODO: Implement update() method.
    }

    public function delete(Team $team): bool
    {
        // TODO: Implement delete() method.
    }
}
