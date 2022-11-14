<?php

namespace App\Console\Commands;

use App\Models\UniqueItem;
use App\Models\WorkPlace;
use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class ToolMetricaSyncUniqueItemStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:unique-item-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync unique item statuses from the Tool Metrica';

    public function handle(ToolMetricaApiUniqueItemServiceInterface $apiService, UniqueItemServiceInterface $service)
    {
        // set token
        $apiService->setToken(Config::get('toolmetrica.root_token'));
        try {
            $this->info('start updating statuses...');

            $getAllWorkplaces = WorkPlace::pluck('uuid')->toArray();

            $uniqueItems = UniqueItem::whereIn('workplace_id', $getAllWorkplaces)->pluck('uuid')->toArray();
            $array_chunk = array_chunk($uniqueItems,70);
            foreach ($array_chunk as $items) {
                $getUniqueItemsStatus = $apiService->getUniqueItemsStatus($items);
                if ($getUniqueItemsStatus) {
                    $service->syncStatus($getUniqueItemsStatus);
                }
            }

            $this->info('finish updating statuses...');
        }  catch (\Exception $e) {
            Log::error('Sync unique item statuses : ' .  $e->getMessage());
        }
    }
}
