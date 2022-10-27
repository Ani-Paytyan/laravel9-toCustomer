<?php

namespace App\Services\IwmsApi\Item;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiItemServiceInterface
{
    public function getItems(?int $page): ?IwmsApiPaginationResponseDto;
}
