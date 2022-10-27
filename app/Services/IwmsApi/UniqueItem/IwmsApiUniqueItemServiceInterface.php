<?php

namespace App\Services\IwmsApi\UniqueItem;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiUniqueItemServiceInterface
{
    public function getItems(?int $page): ?IwmsApiPaginationResponseDto;
}
