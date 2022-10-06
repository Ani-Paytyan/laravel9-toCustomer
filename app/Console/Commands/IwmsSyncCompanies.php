<?php
namespace App\Console\Commands;

use App\Services\IwmsApi\IwmsApiService;
use Illuminate\Console\Command;
use App\Services\IwmsApi\Company\IwmsApiCompanyService;
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


    public function handle(IwmsApiService $apiService, IwmsApiCompanyService $companyService)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        $this->info('start getting companies...');
        // get all companies
        $companies = $apiService->getCompanies();

        if (empty($companies)) {
            $this->error('Empty companies...');
            Log::error('Empty companies... ' . self::CLASS);

            return;
        }

        try {
            // sync companies
            $companyService->sync($companies);

            $this->info('finish updating companies...');
        }  catch (\Exception $e) {
            Log::error('Sync companies : ' .  $e->getMessage());
            $this->error($e->getMessage());
        }
    }
}
