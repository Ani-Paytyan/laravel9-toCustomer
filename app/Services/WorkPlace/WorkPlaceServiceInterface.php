<?php

namespace App\Services\WorkPlace;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Models\WorkPlace;

interface WorkPlaceServiceInterface
{
    /**
     * @param array $workPlaces
     * @return void
     */
    public function sync(array $workPlaces): void;

    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): WorkPlace;

    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto): WorkPlace;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
