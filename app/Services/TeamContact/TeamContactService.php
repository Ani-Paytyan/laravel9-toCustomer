<?php

namespace App\Services\TeamContact;

use App\Dto\TeamContact\TeamContactCreateDto;
use App\Dto\TeamContact\TeamContactUpdateDto;
use App\Models\TeamContact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamContactService implements TeamContactServiceInterface
{
    /**
     * @param TeamContactCreateDto $dto
     * @return Builder|Model|\Illuminate\Database\Query\Builder
     */
    public function create(TeamContactCreateDto $dto): Model|Builder|\Illuminate\Database\Query\Builder
    {
        return TeamContact::withTrashed()->updateOrCreate([
            'contact_id' => $dto->getContactId(),
            'team_id' => $dto->getTeamId(),
        ], [
            'uuid' => Str::uuid()->toString(),
            'role' => $dto->getRole(),
            'deleted_at' => null
        ]);
    }

    public function update(TeamContactUpdateDto $dto, TeamContact $teamContact): bool
    {
        return $teamContact->update([
            'role' => $dto->getRole()
        ]);
    }

    public function destroy(TeamContact $teamContact): bool
    {
        return $teamContact->delete();
    }
}
