<?php

namespace App\Console\Commands;

use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemServiceInterface;
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

    public function handle(ToolMetricaApiUniqueItemServiceInterface $apiService)
    {
        // set token
        $apiService->setToken(Config::get('toolmetrica.root_token'));
        try {
        //    $getAllWorkplaces = W


            $array = [
                "aaaa","bbbb","cccc"
            ];

            dd($apiService->getUniqueItemsStatus($array));

        }  catch (\Exception $e) {
            Log::error('Sync unique item statuses : ' .  $e->getMessage());
        }
    }
}
