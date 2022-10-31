<?php

namespace App\Services\WorkDays;

use App\Models\WorkDays;
use Illuminate\Support\Str;

class WorkDaysService implements WorkDaysServiceInterface
{
    /**
     * @param array $workDays
     * @param $companyID
     * @return void
     */
    public function storeCompanyWorkdays(array $workDays, $companyID): void
    {
        foreach ($workDays as $workDay) {
            WorkDays::updateOrCreate([
                'uuid' => $workDay->getId(),
                'company_id' => $companyID
            ], [
                'uuid' => Str::uuid()->toString(),
                'company_id' => $companyID,
                'day_of_week' => $workDay->getDay(),
                'is_active' => $workDay->getIsActive(),
                'from' => $workDay->getFrom(),
                'to' => $workDay->getTo(),
            ]);
        }
    }

    /**
     * @param array $workDays
     * @param $workplaceID
     * @return void
     */
    public function storeWorkPlaceWorkdays(array $workDays, $workplaceID): void
    {
        foreach ($workDays as $workDay) {
            WorkDays::updateOrCreate([
                'uuid' => $workDay->getId(),
                'workplace_id' => $workplaceID
            ], [
                'uuid' => Str::uuid()->toString(),
                'workplace_id' => $workplaceID,
                'day_of_week' => $workDay->getDay(),
                'is_active' => $workDay->getIsActive(),
                'from' => $workDay->getFrom(),
                'to' => $workDay->getTo(),
            ]);
        }
    }

    /**
     * @param $companyID
     * @return bool
     */
    public function deleteCompanyWorkdays($companyID): bool
    {
        return WorkDays::where('company_id', $companyID)->delete();
    }

    /**
     * @param $workplaceID
     * @return bool
     */
    public function deleteWorkPlaceWorkdays($workplaceID): bool
    {
        return WorkDays::where('workplace_id', $workplaceID)->delete();
    }
}
