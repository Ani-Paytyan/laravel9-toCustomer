<?php

namespace App\Services\AdditionalWorkingDay;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;

class AdditionalWorkingDayService implements AdditionalWorkingDayServiceInterface
{

    public function storeWorkPlaceWorkdays(AdditionalWorkingDayCreateDto $dto): void
    {
        dd($dto);
        // TODO: Implement storeWorkPlaceWorkdays() method.
    }

    public function deleteWorkPlaceWorkdays($workplaceID): bool
    {
        // TODO: Implement deleteWorkPlaceWorkdays() method.
    }
}
