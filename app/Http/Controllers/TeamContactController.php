<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamContact\TeamContactStoreRequest;
use App\Http\Requests\TeamContact\TeamContactUpdateRequest;
use App\Models\TeamContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TeamContactController extends Controller
{
    /**
     * @param TeamContactStoreRequest $request
     * @return JsonResponse
     */
    public function store(TeamContactStoreRequest $request): JsonResponse
    {
        $data = $request->only('contact_id', 'team_id', 'role');

        $result = TeamContact::withTrashed()->updateOrCreate([
            'contact_id' => trim($data['contact_id']),
            'team_id' => trim($data['team_id']),
        ], [
            'uuid' => Str::uuid()->toString(),
            'role' => trim($data['role']),
            'deleted_at' => null
        ]);

        if ($result) {
            return response()->json([
                'data' => $result,
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
     * @return JsonResponse
     */
    public function update(TeamContactUpdateRequest $request, TeamContact $teamContact): JsonResponse
    {
        $data = $request->only('role');

        $result = $teamContact->update([
            'role' => trim($data['role'])
        ]);

        if ($result) {
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

    public function destroy(TeamContact $teamContact): JsonResponse
    {
        if ($teamContact->delete()) {
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
