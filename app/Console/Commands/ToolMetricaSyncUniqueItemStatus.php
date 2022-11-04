<?php

namespace App\Console\Commands;

use App\Interfaces\WorkingDaysRepositoryInterface;
use App\Models\WorkPlace;
use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
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

    public function handle(ToolMetricaApiUniqueItemServiceInterface $apiService, WorkingDaysRepositoryInterface $workingDaysRepository)
    {
        // set token
        $apiService->setToken(Config::get('toolmetrica.root_token'));
        try {

            $now = Carbon::now();
            $dayOfTheWeek = $now->dayOfWeek;
            $date = $now->format('Y-m-d');
            $time = $now->format('H:i');
            if ($dayOfTheWeek === 0) {
                $dayOfTheWeek = 7;
            }

            $getAllWorkplaces = WorkPlace::with('additionalWorkingDays', 'uniqueItems')
                ->get();

            foreach ($getAllWorkplaces as $workPlace) {
                $workingDay = $workingDaysRepository->getWorkPlaceWorkingDays($workPlace->uuid)
                    ->where('day_of_week',$dayOfTheWeek)
                    ->where('is_active', true);

                //dd($workPlace->additionalWorkingDays()->where('date', $date));
                dd($workPlace->additionalWorkingDays());

                if (!$workingDay) {
                    // $workPlace->additionalWorkingDays()
                }
            }

          //  dd($getAllWorkplaces);


            $array = [
                "aaaa","bbbb","cccc"
            ];

            dd($apiService->getUniqueItemsStatus($array));

        }  catch (\Exception $e) {
            Log::error('Sync unique item statuses : ' .  $e->getMessage());
        }
    }
}
