<?php

namespace App\Services\Facades;

use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;
use App\Models\WorkPlace;
use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceServiceInterface;
use App\Services\WorkPlace\WorkPlaceServiceInterface;

class IwmsWorkPlaceFacade
{
    public function __construct(
        protected IwmsApiWorkPlaceServiceInterface $apiWorkPlaceService,
        protected WorkPlaceServiceInterface $workPlaceService
    )
    {
    }

    /**
     * @param WorkPlaceDto $workPlaceDto
     * @return WorkPlace|bool
     */
    public function create(WorkPlaceDto $workPlaceDto): WorkPlace|bool
    {
        // send data to api
        $res = $this->apiWorkPlaceService->create($workPlaceDto);
        // if success from api we save data in DB
        if ($res) {
            return $this->workPlaceService->create($res);
        }

        return false;
    }

    /**
     * @param WorkPlaceEditDto $workPlaceEditDto
     * @return WorkPlace|bool
     */
    public function update(WorkPlaceEditDto $workPlaceEditDto): WorkPlace|bool
    {
        // send data to api
        $res = $this->apiWorkPlaceService->update($workPlaceEditDto);
        // if success from api we update data in DB
        if ($res) {
            return $this->workPlaceService->update($res);
        }

        return false;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $res = $this->apiWorkPlaceService->destroy($id);

        if ($res) {
            return $this->workPlaceService->destroy($id);
        }

        return false;
    }
}
