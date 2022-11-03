<?php

namespace App\Services\UniqueItemContact;

use App\Dto\UniqueItemContact\UniqueItemContactCreateDto;
use App\Models\Contact;
use App\Models\UniqueItem;

interface UniqueItemContactServiceInterface
{
    public function storeUniqueItemEmployees(UniqueItem $uniqueItem, UniqueItemContactCreateDto $dto): void;

    public function storeEmployeeUniqueItems(Contact $employee, UniqueItemContactCreateDto $dto): void;

    public function destroy(UniqueItem $uniqueItem, Contact $employee): bool;
}
