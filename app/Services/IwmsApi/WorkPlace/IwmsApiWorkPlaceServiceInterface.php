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
     * @return IwmsApiWorkPlaceDto|null
     */
    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): ?IwmsApiWorkPlaceDto;

    /**
     * @param IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto
     * @return IwmsApiWorkPlaceEditDto|null
     */
    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto): ?IwmsApiWorkPlaceEditDto;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
