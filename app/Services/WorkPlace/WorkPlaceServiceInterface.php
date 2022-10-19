<?php

namespace App\Services\WorkPlace;

use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;
use App\Models\WorkPlace;

interface WorkPlaceServiceInterface
{
    /**
     * @param array $workPlaces
     * @return void
     */
    public function sync(array $workPlaces): void;

    public function create(WorkPlaceDto $workPlaceDto): WorkPlace;

    public function update(WorkPlaceEditDto $workPlaceEditDto): WorkPlace;

    /**
     * @param WorkPlace $workplace
     * @return bool
     */
    public function destroy(WorkPlace $workplace): bool;
}
