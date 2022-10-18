<?php

namespace App\Services\IwmsApi\WorkPlace;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;

interface IwmsApiWorkPlaceServiceInterface
{
    /**
     * @param int|null $page
     * @return IwmsApiPaginationResponseDto
     */
    public function getWorkPlaces(?int $page): IwmsApiPaginationResponseDto;

    /**
     * @param WorkPlaceDto $workPlaceDto
     * @return IwmsApiWorkPlaceDto|null
     */
    public function create(WorkPlaceDto $workPlaceDto): ?IwmsApiWorkPlaceDto;

    /**
     * @param WorkPlaceEditDto $workPlaceEditDto
     * @return IwmsApiWorkPlaceEditDto|null
     */
    public function update(WorkPlaceEditDto $workPlaceEditDto): ?IwmsApiWorkPlaceEditDto;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
