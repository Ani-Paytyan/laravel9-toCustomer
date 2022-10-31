<?php

namespace App\Services\WorkDays;

interface WorkDaysServiceInterface
{
    /**
     * @param array $workDays
     * @param $companyID
     * @return void
     */
    public function storeCompanyWorkdays(array $workDays, $companyID): void;

    /**
     * @param array $workDays
     * @param $workplaceID
     * @return void
     */
    public function storeWorkPlaceWorkdays(array $workDays, $workplaceID): void;

    /**
     * @param $companyID
     * @return bool
     */
    public function deleteCompanyWorkdays($companyID): bool;

    /**
     * @param $workplaceID
     * @return bool
     */
    public function deleteWorkPlaceWorkdays($workplaceID): bool;
}
