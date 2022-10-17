<?php

namespace App\Services\WorkPlace;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Models\WorkPlace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WorkPlaceService implements WorkPlaceServiceInterface
{
    /**
     * @param array $workPlaces
     * @return void
     */
    public function sync(array $workPlaces): void
    {
        $idWorkPlaces = [];
        foreach ($workPlaces as $workPlace) {
            $idWorkPlaces[] = $workPlace->getId();
            // update or create workPlace
            WorkPlace::withTrashed()->updateOrCreate([
                'uuid' => $workPlace->getId()
            ], [
                'name' => $workPlace->getName(),
                'company_id' => $workPlace->getCompanyId(),
                'address' => $workPlace->getAddress() ?? '',
                'deleted_at' => null,
                'zip' => $workPlace->getZip(),
                'number' => $workPlace->getNumber(),
                'city' => $workPlace->getCity(),
                'status' => $workPlace->getStatus(),
                'sum_price' => $workPlace->getSumPrice()
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idWorkPlaces)) {
            WorkPlace::withTrashed()->whereNotIn('uuid', $idWorkPlaces)->delete();
        }
    }

    /**
     * @param IwmsApiWorkPlaceDto $apiWorkPlaceDto
     * @return Workplace
     */
    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): WorkPlace
    {
        return WorkPlace::create([
            'uuid' => $apiWorkPlaceDto->getId(),
            'company_id' => $apiWorkPlaceDto->getCompanyId(),
            'name' => $apiWorkPlaceDto->getName(),
            'address' => $apiWorkPlaceDto->getAddress() ?? '',
            'zip' => $apiWorkPlaceDto->getZip(),
            'number' => $apiWorkPlaceDto->getNumber(),
            'city' => $apiWorkPlaceDto->getCity(),
            'status' => $apiWorkPlaceDto->getStatus(),
            'sum_price' => $apiWorkPlaceDto->getSumPrice()
        ]);
    }

    /**
     * @param IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto
     * @return Workplace|Builder|Model|\Illuminate\Database\Query\Builder
     */
    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto)
    {
        // update or create workPlace
        return WorkPlace::withTrashed()->updateOrCreate([
            'uuid' => $apiWorkPlaceEditDto->getId()
        ], [
            'name' => $apiWorkPlaceEditDto->getName(),
            'address' => $apiWorkPlaceEditDto->getAddress(),
            'zip' => $apiWorkPlaceEditDto->getZip(),
            'number' => $apiWorkPlaceEditDto->getNumber(),
            'city' => $apiWorkPlaceEditDto->getCity(),
            'status' => $apiWorkPlaceEditDto->getStatus(),
            'sum_price' => $apiWorkPlaceEditDto->getSumPrice()
        ]);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return WorkPlace::destroy($id);
    }
}
