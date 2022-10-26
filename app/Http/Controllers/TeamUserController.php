<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamUser\TeamUserStoreRequest;
use App\Http\Requests\TeamUser\TeamUserUpdateRequest;
use App\Models\Contact;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->companyId = Auth::user()->getCompany()->getId();

            return $next($request);
        });
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function employeeTeams($id)
    {
        $contact = Contact::where('uuid', $id)->firstOrFail();
        $userTeams = TeamUser::with('team')->where('user_id', $contact->uuid)->get();
        // get all team ids from table TeamUser if isset client
        $teamsIds = $userTeams->pluck('team_id')->toArray();
        $roles = TeamUser::getRoles();

        $teamsList = Team::where('company_id', $this->companyId)
            ->whereNotIn('uuid', $teamsIds)
            ->orderBy('name', 'ASC')
            ->pluck('name','uuid')
            ->toArray();

        return view('teams.employee-teams', compact('contact','userTeams', 'roles', 'teamsList'));
    }

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
