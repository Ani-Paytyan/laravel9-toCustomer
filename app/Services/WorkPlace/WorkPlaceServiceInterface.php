<?php

namespace App\Services\WorkPlace;

interface WorkPlaceServiceInterface
{
    /**
     * @param array $workPlaces
     * @return void
     */
    public function sync(array $workPlaces): void;
}
