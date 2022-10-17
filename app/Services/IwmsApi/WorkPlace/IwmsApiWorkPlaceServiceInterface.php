<?php

namespace App\Services\IwmsApi\WorkPlace;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;

interface IwmsApiWorkPlaceServiceInterface
{
    /**
     * @param int|null $page
     * @return IwmsApiPaginationResponseDto
     */
    public function getWorkPlaces(?int $page): IwmsApiPaginationResponseDto;

    /**
     * @param IwmsApiWorkPlaceDto $apiWorkPlaceDto
     * @return bool
     */
    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): bool;

    /**
     * @param IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto
     * @return bool
     */
    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
