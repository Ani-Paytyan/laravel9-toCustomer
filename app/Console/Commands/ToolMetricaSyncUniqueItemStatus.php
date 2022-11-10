<?php

namespace App\Console\Commands;

use App\Models\AdditionalWorkingDay;
use App\Models\UniqueItem;
use App\Models\WorkDays;
use App\Models\WorkPlace;
use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemServiceInterface;
use App\Services\UniqueItem\UniqueItemServiceInterface;
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

    public function handle(ToolMetricaApiUniqueItemServiceInterface $apiService, UniqueItemServiceInterface $service)
    {
        // set token
        $apiService->setToken(Config::get('toolmetrica.root_token'));
        try {
            $now = Carbon::now();
          //  $now = Carbon::now()->addHours(8);
            $dayOfTheWeek = $now->dayOfWeek;
            $date = $now->format('Y-m-d');
            $time = $now->format('H:i');
            if ($dayOfTheWeek === 0) {
                $dayOfTheWeek = 7;
            }

            $defaultWorkDayIsActive = WorkDays::whereNull('company_id')
                ->whereNull('workplace_id')
                ->where('is_active', true)
                ->where('day_of_week', $dayOfTheWeek)
                ->whereTime('from', '<', $time)
                ->whereTime('to', '>', $time)
                ->first();

            $getAllWorkplaces = WorkPlace::with('additionalWorkingDays', 'uniqueItems', 'workDays')->get();

            $workPlaces = [];
            foreach ($getAllWorkplaces as $workPlace) {
                $workDay = $this->getWorkDay($workPlace, $defaultWorkDayIsActive, $dayOfTheWeek, $date, $time);
                // if
               // if (!$workDay) {
                    $workPlaces[] = $workPlace->uuid;
            //    }
            }

            $uniqueItems = UniqueItem::whereIn('workplace_id', $workPlaces)->pluck('uuid')->toArray();
            $array_chunk = array_chunk($uniqueItems,70);
            foreach ($array_chunk as $items) {
                $service->syncStatus($apiService->getUniqueItemsStatus($items));
            }
        }  catch (\Exception $e) {
            Log::error('Sync unique item statuses : ' .  $e->getMessage());
        }
    }

    public function getWorkDay($workPlace, $defaultWorkDayIsActive, $dayOfTheWeek, $date, $time)
    {
        $additionalWorkingDay = AdditionalWorkingDay::where('workplace_id', $workPlace->uuid)
            ->whereDate('date', $date)
            ->whereTime('from', '<', $time)
            ->whereTime('to', '>', $time)
            ->first();

        if (isset($additionalWorkingDay)) {
           //  return true;
        }

        $workDay = WorkDays::where('day_of_week', $dayOfTheWeek)
            ->where('workplace_id', $workPlace->uuid)
            ->first();

        // якщо відключений чекбокс значить вихідний і можемо провіряти дані
        if (isset($workDay) && $workDay->is_active == false) {
            return true;
        }
     //   dd(22222);

    //    dd($workDay::where('is_active', '=' , 1));

    //    dd($workDay->where('is_active', false) !== null);

        if (!$workDay) {
            if (!isset($defaultWorkDayIsActive)) {
                return true;
            }

            return false;
        }

      //  $activeDay = $workDay->where('is_active', true)->whereTime('from', '<', $time)->whereTime('to', '>', $time);
        $activeDay = $workDay->where('is_active', 1)->whereTime('from', '<', $time)->whereTime('to', '>', $time);

        return !isset($activeDay);
    }

    public function updateStatus()
    {
    }
}
