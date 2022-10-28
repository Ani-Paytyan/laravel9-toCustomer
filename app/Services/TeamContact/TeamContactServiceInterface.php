<?php

namespace App\Services\TeamContact;

use App\Dto\TeamContact\TeamContactCreateDto;
use App\Dto\TeamContact\TeamContactUpdateDto;
use App\Models\TeamContact;

interface TeamContactServiceInterface
{
    public function create(TeamContactCreateDto $dto);

    public function update(TeamContactUpdateDto $dto, TeamContact $teamContact): bool;

    public function destroy(TeamContact $teamContact): bool;
}
