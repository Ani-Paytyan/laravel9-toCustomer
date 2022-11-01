<?php

namespace App\Services\AdditionalWorkingDay;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;

interface AdditionalWorkingDayServiceInterface
{
    /**
     * @param AdditionalWorkingDayCreateDto $dto
     * @return void
     */
    public function storeWorkPlaceWorkdays(AdditionalWorkingDayCreateDto $dto): void;

    /**
     * @param $workplaceID
     * @return bool
     */
    public function deleteWorkPlaceWorkdays($workplaceID): bool;
}
