<?php

namespace App\Console\Commands;

use App\Exceptions\Iwms\IwmsApiError;
use App\Models\Company;
use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceServiceInterface;
use App\Services\WorkPlace\WorkPlaceServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Exception;

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
        // get all companies
        $companies = Company::withTrashed()->pluck('uuid');
        $workPlaces = [];
        // get contacts
        foreach ($companies as $company) {
            try {
                // get workPlaces
                $result = $apiService->getWorkPlaces($company, 1);
                if ($result) {
                    $pageCount = $result->getTotalPages();
                    $workPlaces[] = $result->getResults();

                    if ($pageCount > 1) {
                        for ($i = 2; $i <= $pageCount; $i++) {
                            $resultOtherPages = $apiService->getWorkPlaces($i);
                            if ($resultOtherPages) {
                                $workPlaces[] = $resultOtherPages->getResults();
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                if (get_class($e) === IwmsApiError::class) {
                    Log::error("IwmsSyncWorkPlaces - Code: " . $e->getCode() . " File:" . $e->getFile() .  " Message: " . $e->getMessage());
                    $this->error($e->getMessage());
                } else {
                    throw $e;
                }
            }
        }

        return array_merge([], ...$workPlaces);
    }
}
