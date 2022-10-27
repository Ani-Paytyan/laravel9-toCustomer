<?php

namespace App\Services\WorkPlaceContact;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Models\WorkPlaceContact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WorkPlaceContactService implements WorkPlaceContactServiceInterface
{
    /**
     * @param WorkPlaceContactCreateDto $dto
     * @return Builder|Model|\Illuminate\Database\Query\Builder
     */
    public function create(WorkPlaceContactCreateDto $dto)
    {
        return WorkPlaceContact::withTrashed()->updateOrCreate([
            'contact_id' => $dto->getContactId(),
            'workplace_id' => $dto->getWorkPlaceId(),
        ], [
            'uuid' => Str::uuid()->toString(),
            'deleted_at' => null
        ]);
    }

    public function destroy(WorkPlaceContact $workPlaceContact): bool
    {
        return $workPlaceContact->delete();
    }
}
