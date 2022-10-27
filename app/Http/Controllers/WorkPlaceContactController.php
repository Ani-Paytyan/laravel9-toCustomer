<?php

namespace App\Http\Controllers;

use App\Dto\WorkPlaceContact\WorkPlaceContactCreateDto;
use App\Http\Requests\WorkPlaceContact\WorkPlaceContactStoreRequest;
use App\Models\WorkPlaceContact;
use App\Services\WorkPlaceContact\WorkPlaceContactServiceInterface;
use Illuminate\Http\JsonResponse;

class WorkPlaceContactController extends Controller
{
    /**
     * @param WorkPlaceContactStoreRequest $request
     * @param WorkPlaceContactServiceInterface $workPlaceContactService
     * @return JsonResponse
     */
    public function store(
        WorkPlaceContactStoreRequest $request,
        WorkPlaceContactServiceInterface $workPlaceContactService
    ): JsonResponse
    {
        $dto = WorkPlaceContactCreateDto::createFromRequest($request);

        if ($workPlaceContactService->create($dto)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.workplace.created_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.workplace.created_error')
        ]);
    }

    /**
     * @param WorkPlaceContact $workPlaceContact
     * @param WorkPlaceContactServiceInterface $workPlaceContactService
     * @return JsonResponse
     */
    public function destroy(WorkPlaceContactServiceInterface $workPlaceContactService, WorkPlaceContact $workPlaceContact): JsonResponse
    {
        if ($workPlaceContactService->destroy($workPlaceContact)) {
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
