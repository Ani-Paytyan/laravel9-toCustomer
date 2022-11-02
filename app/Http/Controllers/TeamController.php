<?php

namespace App\Http\Controllers;

use App\Dto\Team\TeamCreateDto;
use App\Dto\Team\TeamUpdateDto;
use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;
use App\Models\TeamContact;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Services\Team\TeamServiceInterface;
use App\Traits\ContactTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    use ContactTrait;

    protected $user;
    protected $companyId;

    public function __construct(
        protected IwmsApiContactServiceInterface $apiContactService,
    )
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            $this->companyId = Auth::user()->getCompany()->getId();

            return $next($request);
        });

    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $teams = Team::where('company_id', $this->companyId)->orderBy('name', 'ASC')->paginate(20);

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
        $storeDto = TeamCreateDto::createFromRequest($request, $this->companyId);

        if ($teamService->create($storeDto)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.created_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.created_error'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Team $team)
    {
        $roles = TeamContact::getRoles();
        $teamContacts = TeamContact::with('contact')->where('team_id', $team->uuid)->get();

        $contacts = $this->getContactList($this->companyId, $teamContacts->pluck('contact_id')->toArray());

        return view('teams.edit', compact('team', 'roles', 'teamContacts', 'contacts'));
    }

    /**
     * @param TeamUpdateRequest $request
     * @param TeamServiceInterface $teamService
     * @param $id
     * @return RedirectResponse
     */
    public function update(TeamUpdateRequest $request, TeamServiceInterface $teamService, Team $team): RedirectResponse
    {
        $updateDto = TeamUpdateDto::createFromRequest($request);

        if ($teamService->update($updateDto, $team)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.updated_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.updated_error'));
    }

    public function destroy(TeamServiceInterface $teamService, Team $team): RedirectResponse
    {
        if ($teamService->destroy($team)) {
            return redirect()->route('teams.index')->with('toast_success', __('page.teams.deleted_successfully'));
        }

        return redirect()->route('teams.index')->with('toast_error', __('page.teams.deleted_error'));
    }
}
