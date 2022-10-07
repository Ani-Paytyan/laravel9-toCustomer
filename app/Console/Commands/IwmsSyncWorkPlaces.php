<?php

namespace App\Console\Commands;

use App\Services\IwmsApi\IwmsApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(IwmsApiService $apiService)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        $this->info('start getting workplaces...');
        // get all workplaces
    }
}
