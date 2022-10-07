<?php

namespace App\Services\IwmsApi\WorkPlace;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiWorkPlaceServiceInterface
{
    public function getWorkPlaces(?int $page): IwmsApiPaginationResponseDto;
}
