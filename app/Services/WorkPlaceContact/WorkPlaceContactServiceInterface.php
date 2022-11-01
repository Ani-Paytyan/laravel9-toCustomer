<?php

namespace App\Services\WorkPlaceContact;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Models\Contact;
use App\Models\WorkPlace;

interface WorkPlaceContactServiceInterface
{
    /**
     * @param WorkPlace $workPlace
     * @param WorkPlaceContactCreateDto $dto
     * @return void
     */
    public function storeWorkPlaceEmployees(WorkPlace $workPlace, WorkPlaceContactCreateDto $dto): void;

    /**
     * @param Contact $employee
     * @param WorkPlaceContactCreateDto $dto
     * @return void
     */
    public function storeEmployeeWorkplaces(Contact $employee, WorkPlaceContactCreateDto $dto): void;

    public function destroy(WorkPlace $workPlace, Contact $employee): bool;
}
