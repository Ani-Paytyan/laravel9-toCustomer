<?php
namespace App\Console\Commands;

use App\Services\Company\CompanyServiceInterface;
use App\Services\IwmsApi\Company\IwmsApiCompanyServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class IwmsSyncCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync companies and contractors from the IWMS';


    public function handle(IwmsApiCompanyServiceInterface $apiService, CompanyServiceInterface $companyService)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        // sync companies
        try {
            $this->info('start updating companies...');
            $companyService->sync($this->getCompaniesWithPagination($apiService));
            $this->info('finish updating companies...');
        }  catch (\Exception $e) {
            Log::error('Sync companies : ' .  $e->getMessage());
        }
    }

    /**
     * @param IwmsApiCompanyServiceInterface $apiService
     * @return array
     */
    public function getCompaniesWithPagination(IwmsApiCompanyServiceInterface $apiService): array
    {
        // get companies
        $result = $apiService->getCompanies();
        $pageCount = $result->getTotalPages();
        $companies[] = $result->getResults();

        if ($pageCount > 1) {
            for ($i = 2; $i <= $pageCount; $i++) {
                $resultOtherPages = $apiService->getCompanies($i);
                $companies[] = $resultOtherPages->getResults();
            }
        }

        return array_merge([], ...$companies);
    }
}
