<?php

namespace App\Services\WorkPlace;

use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;
use App\Models\WorkPlace;

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
     * @param WorkPlaceDto $workPlaceDto
     * @return Workplace
     */
    public function create(WorkPlaceDto $workPlaceDto): WorkPlace
    {
        return WorkPlace::create([
            'uuid' => $workPlaceDto->getId(),
            'company_id' => $workPlaceDto->getCompanyId(),
            'name' => $workPlaceDto->getName(),
            'address' => $workPlaceDto->getAddress() ?? '',
            'zip' => $workPlaceDto->getZip(),
            'number' => $workPlaceDto->getNumber(),
            'city' => $workPlaceDto->getCity()
        ]);
    }


    /**
     * @param WorkPlaceEditDto $workPlaceEditDto
     * @param WorkPlace $workplace
     * @return bool
     */
    public function update(WorkPlaceEditDto $workPlaceEditDto, WorkPlace $workplace): bool
    {
        return $workplace->update([
            'name' => $workPlaceEditDto->getName(),
            'address' => $workPlaceEditDto->getAddress(),
            'zip' => $workPlaceEditDto->getZip(),
            'number' => $workPlaceEditDto->getNumber(),
            'city' => $workPlaceEditDto->getCity()
        ]);
    }

    /**
     * @param WorkPlace $workplace
     * @return bool
     */
    public function destroy(WorkPlace $workplace): bool
    {
        // detach all work place contacts
        $workplace->contacts()->detach();

        return $workplace->delete();
    }
}
