<?php

namespace App\Http\Controllers;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Http\Requests\WorkPlaceContact\WorkPlaceContactStoreRequest;
use App\Models\Contact;
use App\Models\WorkPlace;
use App\Services\WorkPlaceContact\WorkPlaceContactServiceInterface;
use Illuminate\Http\JsonResponse;

class WorkPlaceContactController extends Controller
{
    public function storeWorkPlaceEmployees(
        WorkPlace $workPlace,
        WorkPlaceContactStoreRequest $request,
        WorkPlaceContactServiceInterface $workPlaceContactService
    ) : JsonResponse
    {
        $dto = WorkPlaceContactCreateDto::createFromRequest($request);

        $workPlaceContactService->storeWorkPlaceEmployees($workPlace, $dto);

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => __('page.workplace.created_successfully')
        ]);
    }

    public function storeEmployeeWorkplaces(
        Contact $employee,
        WorkPlaceContactStoreRequest $request,
        WorkPlaceContactServiceInterface $workPlaceContactService
    ) : JsonResponse
    {
        $dto = WorkPlaceContactCreateDto::createFromRequest($request);

        $workPlaceContactService->storeEmployeeWorkplaces($employee, $dto);

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => __('page.workplace.created_workplace_successfully')
        ]);
    }

    /**
     * @param Contact $employee
     * @param WorkPlace $workPlace
     * @param WorkPlaceContactServiceInterface $workPlaceContactService
     * @return JsonResponse
     */
    public function deleteEmployeeWorkplaces(
        Contact $employee,
        WorkPlace $workPlace,
        WorkPlaceContactServiceInterface $workPlaceContactService
    ): JsonResponse
    {
        if ($workPlaceContactService->destroy($workPlace, $employee)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.workplace.deleted_workplace_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.workplace.deleted_workplace_error')
        ]);
    }

    public function deleteWorkPlaceEmployees(
        WorkPlace $workPlace,
        Contact $employee,
        WorkPlaceContactServiceInterface $workPlaceContactService
    ): JsonResponse
    {
        if ($workPlaceContactService->destroy($workPlace, $employee)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.workplace.deleted_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.workplace.deleted_error')
        ]);
    }
}
