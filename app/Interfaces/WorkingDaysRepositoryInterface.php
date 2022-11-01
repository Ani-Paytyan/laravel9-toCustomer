<?php

namespace App\Interfaces;

interface WorkingDaysRepositoryInterface
{
    public function getCompanyWorkingDays($id);
    public function getWorkPlaceWorkingDays($id);
}
