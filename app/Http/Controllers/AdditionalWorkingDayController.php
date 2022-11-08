<?php

namespace App\Http\Controllers;

use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayCreateDto;
use App\Dto\AdditionalWorkingDay\AdditionalWorkingDayUpdateDto;
use App\Models\AdditionalWorkingDay;
use App\Models\WorkPlace;
use App\Services\AdditionalWorkingDay\AdditionalWorkingDayServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;

class AdditionalWorkingDayController extends Controller
{
    public function storeWorkPlaceWorkdays(Request $request, WorkPlace $workPlace, AdditionalWorkingDayServiceInterface $workDaysService): JsonResponse
    {
        Gate::authorize('create-workplace-working-days');

        $additionalWorkingDayCreateDto = AdditionalWorkingDayCreateDto::createFromRequest($request->all(), $workPlace->uuid);

        if ($workDaysService->storeWorkPlaceWorkdays($additionalWorkingDayCreateDto)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.additional_working_days.created_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.additional_working_days.created_error')
        ]);
    }

    /**
     * @param Request $request
     * @param AdditionalWorkingDay $additionalWorkingDay
     * @param AdditionalWorkingDayServiceInterface $workDaysService
     * @return JsonResponse
     */
    public function updateWorkPlaceWorkdays(Request $request, AdditionalWorkingDay $additionalWorkingDay, AdditionalWorkingDayServiceInterface $workDaysService): JsonResponse
    {
        Gate::authorize('create-workplace-working-days');

        $additionalWorkingDayUpdateDto = AdditionalWorkingDayUpdateDto::createFromRequest($request->all(), $additionalWorkingDay->uuid);

        if ($workDaysService->updateWorkPlaceWorkdays($additionalWorkingDayUpdateDto, $additionalWorkingDay)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.additional_working_days.updated_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.additional_working_days.updated_error')
        ]);
    }

    /**
     * @param Request $request
     * @param AdditionalWorkingDay $additionalWorkingDay
     * @param AdditionalWorkingDayServiceInterface $workDaysService
     * @return JsonResponse
     */
    public function deleteWorkPlaceWorkdays(Request $request, AdditionalWorkingDay $additionalWorkingDay, AdditionalWorkingDayServiceInterface $workDaysService): JsonResponse
    {
        Gate::authorize('delete-workplace-working-days');

        if ($workDaysService->deleteWorkPlaceWorkdays($additionalWorkingDay)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.additional_working_days.deleted_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.additional_working_days.deleted_error')
        ]);
    }
}
