<?php

namespace App\Services\Team;
use App\Dto\Team\TeamCreateDto;
use App\Dto\Team\TeamUpdateDto;
use App\Models\Team;

interface TeamServiceInterface
{
    public function create(TeamCreateDto $dto): Team;

    public function update(TeamUpdateDto $dto): bool;

    public function destroy(string $id): bool;

}
