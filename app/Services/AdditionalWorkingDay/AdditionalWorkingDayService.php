<?php

namespace App\Services\AdditionalWorkingDay;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;
use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayUpdateDto;
use App\Models\AdditionalWorkingDay;
use Illuminate\Support\Str;

class AdditionalWorkingDayService implements AdditionalWorkingDayServiceInterface
{

    public function storeWorkPlaceWorkdays(AdditionalWorkingDayCreateDto $dto)
    {
        return AdditionalWorkingDay::create([
            'uuid' => Str::uuid()->toString(),
            'workplace_id' => $dto->getWorkplaceId(),
            'date' => $dto->getDate(),
            'from' => $dto->getFrom(),
            'to' => $dto->getTo(),
        ]);
    }

    /**
     * @param AdditionalWorkingDayUpdateDto $dto
     * @param AdditionalWorkingDay $additionalWorkingDay
     * @return bool
     */
    public function updateWorkPlaceWorkdays(AdditionalWorkingDayUpdateDto $dto, AdditionalWorkingDay $additionalWorkingDay): bool
    {
        return $additionalWorkingDay->update([
            'date' => $dto->getDate(),
            'from' => $dto->getFrom(),
            'to' => $dto->getTo(),
        ]);
    }

    /**
     * @param AdditionalWorkingDay $additionalWorkingDay
     * @return bool
     */
    public function deleteWorkPlaceWorkdays(AdditionalWorkingDay $additionalWorkingDay): bool
    {
        return $additionalWorkingDay->delete();
    }
}
