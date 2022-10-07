<?php
namespace App\Console\Commands;

use App\Dto\IwmsApi\IwmsApiCompanyDto;
use App\Services\Company\CompanyService;
use App\Services\IwmsApi\Company\IwmsApiCompanyService;
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


    public function handle(IwmsApiCompanyService $apiService, CompanyService $companyService)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        $this->info('start getting companies...');
        $companies = $this->getCompaniesWithPagination($apiService);

        try {
            // sync companies
            $companyService->sync($companies);

            $this->info('finish updating companies...');
        }  catch (\Exception $e) {
            Log::error('Sync companies : ' .  $e->getMessage());
            $this->error($e->getMessage());
        }
    }

    /**
     * @param IwmsApiCompanyService $apiService
     * @return array
     */
    public function getCompaniesWithPagination(IwmsApiCompanyService $apiService): array
    {
        $companies = [];
        // get companies
        $result = $apiService->getCompanies();
        if ($result) {
            $pageCount = $result['_meta']['pageCount'];
            $companiesDto[] = $this->getCompaniesDto($result['results']);

            if ($pageCount > 1) {
                for ($i = 2; $i <= $pageCount; $i++) {
                    $resultOtherPages = $apiService->getCompanies($i);
                    if ($resultOtherPages) {
                        $companiesDto[] = $this->getCompaniesDto($resultOtherPages['results']);
                    }
                }
            }

            $companies = array_merge([], ...$companiesDto);
        }

        return $companies;
    }

    /**
     * @param $companies
     * @return array
     */
    public function getCompaniesDto($companies): array
    {
        $companiesDto = [];
        foreach ($companies as $company) {
            $companiesDto[] = IwmsApiCompanyDto::createFromApiResponse($company);
        }

        return $companiesDto;
    }
}
