<?php

namespace App\Http\Controllers;

use App\Dto\Team\TeamCreateDto;
use App\Dto\Team\TeamUpdateDto;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;
use App\Services\Team\TeamServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TeamController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $teams = Team::orderBy('name', 'ASC')->paginate(20);

        return view('teams.index', compact('teams'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * @param TeamStoreRequest $request
     * @param TeamServiceInterface $teamService
     * @return RedirectResponse
     */
    public function store(TeamStoreRequest $request, TeamServiceInterface $teamService): RedirectResponse
    {
        $storeDto = TeamCreateDto::createFromRequest($request);

        if ($teamService->create($storeDto)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.created_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.created_error'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $team = Team::find($id);

        return view('teams.edit', compact('team'));
    }

    /**
     * @param TeamUpdateRequest $request
     * @param TeamServiceInterface $teamService
     * @param $id
     * @return RedirectResponse
     */
    public function update(TeamUpdateRequest $request, TeamServiceInterface $teamService, $id): RedirectResponse
    {
        $updateDto = TeamUpdateDto::createFromRequest($request, $id);

        if ($teamService->update($updateDto)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.updated_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.updated_error'));
    }

    public function destroy(TeamServiceInterface $teamService, $id): RedirectResponse
    {
        if ($teamService->destroy($id)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.deleted_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.deleted_error'));
    }
}
