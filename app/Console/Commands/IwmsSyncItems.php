<?php

namespace App\Console\Commands;

use App\Services\Item\ItemServiceInterface;
use App\Services\IwmsApi\Item\IwmsApiItemServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class IwmsSyncItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync items from the IWMS';

    public function handle(IwmsApiItemServiceInterface $apiService, ItemServiceInterface $service)
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        // sync items
        try {
            $this->info('start updating items...');
            $service->sync($this->getItemsWithPagination($apiService));
            $this->info('finish updating items...');
        }  catch (\Exception $e) {
            $this->error($e);
            Log::error('Sync items : ' .  $e->getMessage());
        }
    }

    /**
     * @param IwmsApiItemServiceInterface $apiService
     * @return array
     */
    public function getItemsWithPagination(IwmsApiItemServiceInterface $apiService): array
    {
        // get items
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
