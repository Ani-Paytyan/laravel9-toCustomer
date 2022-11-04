<?php

namespace App\Services\UniqueItemContact;

use App\Dto\UniqueItemContact\UniqueItemContactCreateDto;
use App\Models\Contact;
use App\Models\UniqueItem;
use Illuminate\Support\Str;

class UniqueItemContactService implements UniqueItemContactServiceInterface
{
    /**
     * @param UniqueItem $uniqueItem
     * @param UniqueItemContactCreateDto $dto
     * @return void
     */
    public function storeUniqueItemEmployees(UniqueItem $uniqueItem, UniqueItemContactCreateDto $dto): void
    {
        $uniqueItem->contacts()->attach($dto->getContactId(), ["uuid" => Str::uuid()->toString()]);
    }

    /**
     * @param Contact $employee
     * @param UniqueItemContactCreateDto $dto
     * @return void
     */
    public function storeEmployeeUniqueItems(Contact $employee, UniqueItemContactCreateDto $dto): void
    {
        $employee->uniqueItems()->attach($dto->getUniqueItemId(), ["uuid" => Str::uuid()->toString()]);
    }

    /**
     * @param UniqueItem $uniqueItem
     * @param Contact $employee
     * @return bool
     */
    public function destroy(UniqueItem $uniqueItem, Contact $employee): bool
    {
        return $uniqueItem->contacts()->detach($employee);
    }
}
