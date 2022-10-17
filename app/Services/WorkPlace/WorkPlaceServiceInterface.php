<?php

namespace App\Services\WorkPlace;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;

interface WorkPlaceServiceInterface
{
    /**
     * @param array $workPlaces
     * @return void
     */
    public function sync(array $workPlaces): void;

    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto);

    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto);

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
