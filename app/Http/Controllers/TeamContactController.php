<?php

namespace App\Http\Controllers;

use App\Dto\TeamContact\TeamContactCreateDto;
use App\Dto\TeamContact\TeamContactUpdateDto;
use App\Http\Requests\TeamContact\TeamContactStoreRequest;
use App\Http\Requests\TeamContact\TeamContactUpdateRequest;
use App\Models\TeamContact;
use App\Services\TeamContact\TeamContactServiceInterface;
use Illuminate\Http\JsonResponse;

class TeamContactController extends Controller
{
    /**
     * @param TeamContactStoreRequest $request
     * @param TeamContactServiceInterface $teamContactService
     * @return JsonResponse
     */
    public function store(TeamContactStoreRequest $request, TeamContactServiceInterface $teamContactService): JsonResponse
    {
        $teamContactCreateDto = TeamContactCreateDto::createFromRequest($request);

        if ($teamContactService->create($teamContactCreateDto)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.contact.created_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.contact.created_error')
        ]);
    }

    /**
     * @param TeamContactUpdateRequest $request
     * @param TeamContact $teamContact
     * @param TeamContactServiceInterface $teamContactService
     * @return JsonResponse
     */
    public function update(TeamContactUpdateRequest $request, TeamContact $teamContact, TeamContactServiceInterface $teamContactService): JsonResponse
    {
        $teamContactUpdateDto = TeamContactUpdateDto::createFromRequest($request);

        if ($teamContactService->update($teamContactUpdateDto, $teamContact)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.contact.updated_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.contact.updated_error')
        ]);
    }

    /**
     * @param TeamContact $teamContact
     * @param TeamContactServiceInterface $teamContactService
     * @return JsonResponse
     */
    public function destroy(TeamContact $teamContact, TeamContactServiceInterface $teamContactService): JsonResponse
    {
        if ($teamContactService->destroy($teamContact)) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.contact.deleted_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.contact.deleted_error')
        ]);
    }
}
