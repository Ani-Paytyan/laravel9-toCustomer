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

    /**
     * @param WorkPlaceDto $workPlaceDto
     * @return WorkPlace
     */
    public function create(WorkPlaceDto $workPlaceDto): WorkPlace;

    /**
     * @param WorkPlaceEditDto $workPlaceEditDto
     * @param WorkPlace $workplace
     * @return bool
     */
    public function update(WorkPlaceEditDto $workPlaceEditDto, WorkPlace $workplace): bool;

    /**
     * @param WorkPlace $workplace
     * @return bool
     */

    public function restore(WorkPlace $workplace): bool;

    /**
     * @param WorkPlace $workplace
     * @return bool
     */
    public function destroy(WorkPlace $workplace): bool;
}
