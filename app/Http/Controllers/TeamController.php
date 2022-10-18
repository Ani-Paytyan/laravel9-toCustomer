<?php

namespace App\Http\Controllers;

use App\Dto\Team\TeamUpdateDto;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;
use App\Services\Team\TeamServiceInterface;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderByDesc('created_at')->paginate(20);

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(TeamStoreRequest $request, TeamServiceInterface $teamService)
    {

    }

    public function edit($id)
    {
        $team = Team::where('id',$id)->firstOrFail();

        return view('teams.edit', compact('team'));
    }

    public function update(TeamUpdateRequest $request, TeamServiceInterface $teamService, $id)
    {
        $updateDto = TeamUpdateDto::createFromRequest($request, $id);
        $teamService->update($updateDto);

    }

    public function destroy(TeamServiceInterface $teamService, $id)
    {
        if ($teamService->delete($id)) {
            //
        }
    }
}
