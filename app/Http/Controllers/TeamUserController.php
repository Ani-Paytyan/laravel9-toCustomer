<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamUser\TeamUserStoreRequest;
use App\Http\Requests\TeamUser\TeamUserUpdateRequest;
use App\Models\TeamUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TeamUserController extends Controller
{
    /**
     * @param TeamUserStoreRequest $request
     * @return JsonResponse
     */
    public function store(TeamUserStoreRequest $request): JsonResponse
    {
        $data = $request->only('user_id', 'team_id', 'role');

        $result = TeamUser::withTrashed()->updateOrCreate([
            'user_id' => trim($data['user_id']),
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
                'message' => __('page.user.created_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.user.created_error')
        ]);
    }

    /**
     * @param TeamUserUpdateRequest $request
     * @param TeamUser $teamUser
     * @return JsonResponse
     */
    public function update(TeamUserUpdateRequest $request, TeamUser $teamUser): JsonResponse
    {
        $data = $request->only('role');

        $result = $teamUser->update([
            'role' => trim($data['role'])
        ]);

        if ($result) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.user.updated_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.user.updated_error')
        ]);
    }

    public function destroy(TeamUser $teamUser): JsonResponse
    {
        if ($teamUser->delete()) {
            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.user.deleted_successfully')
            ]);
        }

        return response()->json([
            'data' => [],
            'status' => 'error',
            'message' => __('page.user.deleted_error')
        ]);
    }
}
