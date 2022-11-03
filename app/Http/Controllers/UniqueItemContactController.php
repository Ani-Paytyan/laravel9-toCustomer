<?php

namespace App\Http\Controllers;


use App\Dto\UniqueItemContact\UniqueItemContactCreateDto;
use App\Http\Requests\UniqueItem\UniqueItemStoreRequest;
use App\Models\Contact;
use App\Models\UniqueItem;
use App\Services\UniqueItemContact\UniqueItemContactServiceInterface;
use Illuminate\Http\JsonResponse;

class UniqueItemContactController extends Controller
{
    /**
     * @param UniqueItem $uniqueItem
     * @param UniqueItemStoreRequest $request
     * @param UniqueItemContactServiceInterface $uniqueItemContactService
     * @return JsonResponse
     */
    public function storeUniqueItemEmployees(
        UniqueItem $uniqueItem,
        UniqueItemStoreRequest $request,
        UniqueItemContactServiceInterface $uniqueItemContactService
    ) : JsonResponse
    {
        $dto = UniqueItemContactCreateDto::createFromRequest($request);

        $uniqueItemContactService->storeUniqueItemEmployees($uniqueItem, $dto);

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => __('page.unique-item.created_successfully')
        ]);
    }

    /**
     * @param Contact $employee
     * @param UniqueItemStoreRequest $request
     * @param UniqueItemContactServiceInterface $uniqueItemContactService
     * @return JsonResponse
     */
    public function storeEmployeeUniqueItems(
        Contact $employee,
        UniqueItemStoreRequest $request,
        UniqueItemContactServiceInterface $uniqueItemContactService
    ): JsonResponse
    {
        $dto = UniqueItemContactCreateDto::createFromRequest($request);

        $uniqueItemContactService->storeEmployeeUniqueItems($employee, $dto);

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => __('page.unique-item.created_unique_successfully')
        ]);
    }
    /**
     * @param Contact $employee
     * @param UniqueItem $uniqueItem
     * @param UniqueItemContactServiceInterface $uniqueItemContactService
     * @return JsonResponse
     */
    public function deleteUniqueItemEmployees(
        UniqueItem $uniqueItem,
        Contact $employee,
        UniqueItemContactServiceInterface $uniqueItemContactService
    ): JsonResponse
    {
        if ($uniqueItemContactService->destroy($uniqueItem, $employee)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.unique-item.deleted_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.unique-item.deleted_error')
        ]);
    }

    /**
     * @param UniqueItem $uniqueItem
     * @param Contact $employee
     * @param UniqueItemContactServiceInterface $uniqueItemContactService
     * @return JsonResponse
     */
    public function deleteEmployeeUniqueItems(
        Contact $employee,
        UniqueItem $uniqueItem,
        UniqueItemContactServiceInterface $uniqueItemContactService
    ): JsonResponse
    {
        if ($uniqueItemContactService->destroy($uniqueItem, $employee)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.unique-item.deleted_unique_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.unique-item.deleted_unique_error')
        ]);
    }

}
