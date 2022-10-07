<?php

namespace App\Console\Commands;

use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceServiceInterface;
use App\Services\WorkPlace\WorkPlaceServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class IwmsSyncWorkPlaces extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:workplaces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync workplaces from the IWMS';


    public function handle(IwmsApiWorkPlaceServiceInterface $apiService, WorkPlaceServiceInterface $workPlaceService)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        // sync workplaces
        try {
            $this->info('start getting workplaces...');
            $workPlaceService->sync($this->getWorkPlacesWithPagination($apiService));
            $this->info('finish updating workplaces...');
        }  catch (\Exception $e) {
            Log::error('Sync workplaces : ' .  $e->getMessage());
        }
    }

    /**
     * @param IwmsApiWorkPlaceServiceInterface $apiService
     * @return array
     */
    public function getWorkPlacesWithPagination(IwmsApiWorkPlaceServiceInterface $apiService): array
    {
        // get workPlaces
        $result = $apiService->getWorkPlaces();
        $pageCount = $result->getTotalPages();
        $workPlaces[] = $result->getResults();

        if ($pageCount > 1) {
            for ($i = 2; $i <= $pageCount; $i++) {
                $resultOtherPages = $apiService->getWorkPlaces($i);
                $workPlaces[] = $resultOtherPages->getResults();
            }
        }

        return array_merge([], ...$workPlaces);
    }
}
