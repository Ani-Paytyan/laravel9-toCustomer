<?php

namespace App\Services\WorkPlaceContact;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Models\WorkPlaceContact;

interface WorkPlaceContactServiceInterface
{
    public function create(WorkPlaceContactCreateDto $dto);

    public function destroy(WorkPlaceContact $workPlaceContact): bool;
}
