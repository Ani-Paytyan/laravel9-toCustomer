<?php

namespace App\Repositories;

use App\Interfaces\WorkingDaysRepositoryInterface;
use App\Models\WorkDays;

class WorkingDaysRepository implements WorkingDaysRepositoryInterface
{

    public function getCompanyWorkingDays($id)
    {
        $getCompanyWorkDays = WorkDays::where('company_id', $id)->orderBy('day_of_week', 'asc')->get();
        if ($getCompanyWorkDays->count() === 0) {
            $getCompanyWorkDays = WorkDays::whereNull('company_id')
                ->whereNull('workplace_id')
                ->orderBy('day_of_week', 'asc')
                ->get();
        }

        return $getCompanyWorkDays;
    }


    public function getWorkPlaceWorkingDays($id)
    {
        $getWorkPlaceWorkDays = WorkDays::where('workplace_id', $id)->orderBy('day_of_week', 'asc')->get();
        if ($getWorkPlaceWorkDays->count() === 0) {
            $getWorkPlaceWorkDays = WorkDays::whereNull('company_id')
                ->whereNull('workplace_id')
                ->orderBy('day_of_week', 'asc')
                ->get();
        }

        return $getWorkPlaceWorkDays;
    }
}
