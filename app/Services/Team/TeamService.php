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
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);

    }

    /**
     * @param TeamUpdateDto $dto
     * @return bool
     */
    public function update(TeamUpdateDto $dto): bool
    {
        return Team::findOrFail($dto->getId())->update([
            'name' => $dto->getName(),
            'description' => $dto->getDescription(),
        ]);
    }

    /**
     * @param string $id
     * @return bool
     */

    public function destroy(string $id): bool
    {
        return Team::destroy($id);
    }
}
