<?php

namespace App\Services\WorkPlaceContact;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Models\Contact;
use App\Models\WorkPlace;
use Illuminate\Support\Str;

class WorkPlaceContactService implements WorkPlaceContactServiceInterface
{

    /**
     * @param WorkPlace $workPlace
     * @param WorkPlaceContactCreateDto $dto
     * @return void
     */
    public function storeWorkPlaceEmployees(WorkPlace $workPlace, WorkPlaceContactCreateDto $dto): void
    {
        $workPlace->contacts()->attach($dto->getContactId(), ["uuid" => Str::uuid()->toString()]);
    }

    /**
     * @param Contact $employee
     * @param WorkPlaceContactCreateDto $dto
     * @return void
     */
    public function storeEmployeeWorkplaces(Contact $employee, WorkPlaceContactCreateDto $dto): void
    {
        $employee->workplaces()->attach($dto->getWorkPlaceId(), ["uuid" => Str::uuid()->toString()]);
    }

    /**
     * @param WorkPlace $workPlace
     * @param Contact $employee
     * @return bool
     */
    public function destroy(WorkPlace $workPlace, Contact $employee): bool
    {
        return $workPlace->contacts()->detach($employee);
    }
}
