<?php

namespace App\Services\WorkPlace;

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
                'deleted_at' => null
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idWorkPlaces)) {
            WorkPlace::withTrashed()->whereNotIn('uuid', $idWorkPlaces)->delete();
        }
    }
}
