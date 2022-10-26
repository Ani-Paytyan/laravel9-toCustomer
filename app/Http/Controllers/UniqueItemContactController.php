<?php

namespace App\Http\Controllers;


use App\Http\Requests\UniqueItem\UniqueItemStoreRequest;
use App\Models\UniqueItemContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UniqueItemContactController extends Controller
{
    /**
     * @param UniqueItemStoreRequest $request
     * @return JsonResponse
     */
    public function store(UniqueItemStoreRequest $request): JsonResponse
    {
        $data = $request->only('contact_id', 'unique_item_id');

        $result = UniqueItemContact::withTrashed()->updateOrCreate([
            'contact_id' => trim($data['contact_id']),
            'unique_item_id' => trim($data['unique_item_id']),
        ], [
            'uuid' => Str::uuid()->toString(),
            'deleted_at' => null
        ]);

        if ($result) {
            return response()->json([
                'data' => $result,
                'status' => 'success',
                'message' => __('page.unique-item.created_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.unique-item.created_error')
        ]);
    }

    public function destroy(UniqueItemContact $uniqueItemContact): JsonResponse
    {
        if ($uniqueItemContact->delete()) {
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
}
