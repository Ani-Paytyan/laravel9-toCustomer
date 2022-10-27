<?php

namespace App\Console\Commands;

use App\Services\IwmsApi\UniqueItem\IwmsApiUniqueItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class IwmsSyncUniqueItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:unique-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync unique items from the IWMS';

    public function handle(IwmsApiUniqueItemServiceInterface $apiService, UniqueItemServiceInterface $service)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        // sync unique items
        try {
            $this->info('start updating unique items...');
            $service->sync($this->getItemsWithPagination($apiService));
            $this->info('finish updating unique items...');
        }  catch (\Exception $e) {
            $this->error($e);
            Log::error('Sync items : ' .  $e->getMessage());
        }
    }

    /**
     * @param IwmsApiUniqueItemServiceInterface $apiService
     * @return array
     */
    public function getItemsWithPagination(IwmsApiUniqueItemServiceInterface $apiService): array
    {
        // get unique items
        $items = [];
        $result = $apiService->getItems(1);
        if ($result) {
            $pageCount = $result->getTotalPages();
            $items[] = $result->getResults();

            if ($pageCount > 1) {
                for ($i = 2; $i <= $pageCount; $i++) {
                    $resultOtherPages = $apiService->getItems($i);
                    if ($resultOtherPages) {
                        $items[] = $resultOtherPages->getResults();
                    }
                }
            }
        }

        return array_merge([], ...$items);
    }
}
