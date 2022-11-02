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
            if ($workDay->getDefault()) {
                WorkDays::create([
                    'uuid' => Str::uuid()->toString(),
                    'company_id' => $companyID,
                    'day_of_week' => $workDay->getDay(),
                    'is_active' => $workDay->getIsActive(),
                    'from' => $workDay->getFrom(),
                    'to' => $workDay->getTo(),
                ]);
            } else {
                $arrayToUpdate = [
                    'day_of_week' => $workDay->getDay(),
                    'is_active' => $workDay->getIsActive(),
                    'from' => $workDay->getFrom(),
                    'to' => $workDay->getTo(),
                ];

                if (!$workDay->getIsActive()) {
                    $arrayToUpdate = ['is_active' => 0];
                }

                WorkDays::updateOrCreate(['uuid' => $workDay->getId()], $arrayToUpdate);
            }
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
            if ($workDay->getDefault()) {
                WorkDays::create([
                    'uuid' => Str::uuid()->toString(),
                    'workplace_id' => $workplaceID,
                    'day_of_week' => $workDay->getDay(),
                    'is_active' => $workDay->getIsActive(),
                    'from' => $workDay->getFrom(),
                    'to' => $workDay->getTo(),
                ]);
            } else {
                $arrayToUpdate = [
                    'day_of_week' => $workDay->getDay(),
                    'is_active' => $workDay->getIsActive(),
                    'from' => $workDay->getFrom(),
                    'to' => $workDay->getTo(),
                ];

                if (!$workDay->getIsActive()) {
                    $arrayToUpdate = ['is_active' => 0];
                }

                WorkDays::updateOrCreate(['uuid' => $workDay->getId()], $arrayToUpdate);
            }
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
