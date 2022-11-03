<?php

namespace App\Services\AdditionalWorkingDay;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;
use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayUpdateDto;
use App\Models\AdditionalWorkingDay;

interface AdditionalWorkingDayServiceInterface
{

    /**
     * @param AdditionalWorkingDayCreateDto $dto
     */
    public function storeWorkPlaceWorkdays(AdditionalWorkingDayCreateDto $dto);

    /**
     * @param AdditionalWorkingDayUpdateDto $dto
     * @param AdditionalWorkingDay $additionalWorkingDay
     */
    public function updateWorkPlaceWorkdays(AdditionalWorkingDayUpdateDto $dto, AdditionalWorkingDay $additionalWorkingDay);

    /**
     * @param AdditionalWorkingDay $additionalWorkingDay
     * @return bool
     */
    public function deleteWorkPlaceWorkdays(AdditionalWorkingDay $additionalWorkingDay): bool;
}
