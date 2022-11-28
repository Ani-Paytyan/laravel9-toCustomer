<?php

namespace App\Services\Facades;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
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
     * @param IwmsApiWorkPlaceDto $apiWorkPlaceDto
     * @return WorkPlace|bool
     */
    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): WorkPlace|bool
    {
        // send data to api
        $res = $this->apiWorkPlaceService->create($apiWorkPlaceDto);
        // if success from api we save data in DB
        if ($res) {
           $workPlaceDto = (new WorkPlaceDto())
                ->setId($res->getId())
                ->setCompanyId($res->getCompanyId())
                ->setName($res->getName())
                ->setAddress($res->getAddress())
                ->setZip($res->getZip())
                ->setCity($res->getCity())
                ->setNumber($res->getNumber());

            return $this->workPlaceService->create($workPlaceDto);
        }

        return false;
    }

    /**
     * @param IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto
     * @param WorkPlace $workplace
     * @return bool
     */
    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto, WorkPlace $workplace): bool
    {
        // send data to api
        $res = $this->apiWorkPlaceService->update($apiWorkPlaceEditDto);
        // if success from api we update data in DB
        if ($res) {
            $workPlaceEditDto = (new WorkPlaceEditDto())
                ->setId($res->getId())
                ->setName($res->getName())
                ->setAddress($res->getAddress())
                ->setZip($res->getZip())
                ->setCity($res->getCity())
                ->setNumber($res->getNumber());

            return $this->workPlaceService->update($workPlaceEditDto, $workplace);
        }

        return false;
    }

    /**
     * @param WorkPlace $workplace
     * @return bool
     */
    public function restore(WorkPlace $workplace): bool
    {
        $res = $this->apiWorkPlaceService->restore($workplace->uuid);

        if ($res) {
            return $this->workPlaceService->restore($workplace);
        }

        return false;
    }

    /**
     * @param WorkPlace $workplace
     * @return bool
     */
    public function destroy(WorkPlace $workplace): bool
    {
        $res = $this->apiWorkPlaceService->destroy($workplace->uuid);

        if ($res) {
            return $this->workPlaceService->destroy($workplace);
        }

        return false;
    }
}
