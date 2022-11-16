<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Http\Requests\WorkPlace\WorkPlaceCreateRequest;
use App\Http\Requests\WorkPlace\WorkPlaceEditRequest;
use App\Models\UniqueItem;
use App\Models\WorkPlace;
use App\Services\Facades\IwmsWorkPlaceFacade;
use App\Traits\ContactTrait;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class WorkPlaceController extends Controller
{
    use ContactTrait;

    protected $user;
    protected $companyId;

    public function __construct()
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
        $workPlaces = WorkPlace::where('company_id', $this->companyId)
            ->with('uniqueItems')
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('workplaces.index', compact('workPlaces'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        Gate::authorize('create-workplace');

        return view('workplaces.create');
    }

    public function show(WorkPlace $workplace)
    {
        $workPlaceContacts = $workplace->contacts()
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->orderBy(DB::raw('ISNULL(last_name), last_name'), 'ASC');

        $contactList = $this->getContactList($this->companyId, $workPlaceContacts->get()->pluck('uuid')->toArray());
        // get all workplace unique items
        $uniqueItems = UniqueItem::with('contacts')
            ->whereHas('workPlace', function (Builder $query) {
                $query->where('company_id', $this->companyId);
            })
            ->where('workplace_id', $workplace->uuid)
            ->paginate(10);

        $workPlaceContacts = $workPlaceContacts->paginate(10);

        return view('workplaces.show', compact('workplace', 'workPlaceContacts', 'contactList', 'uniqueItems'));
    }

    /**
     * @param WorkPlaceCreateRequest $request
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @return RedirectResponse
     */
    public function store(WorkPlaceCreateRequest $request, IwmsWorkPlaceFacade $iwmsWorkPlaceFacade): RedirectResponse
    {
        Gate::authorize('create-workplace');

        $iwmsApiWorkPlaceDto = IwmsApiWorkPlaceDto::createFromRequest($request->all(), $this->companyId);

        if ($iwmsWorkPlaceFacade->create($iwmsApiWorkPlaceDto)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.created_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.created_error'));
    }

    /**
     * @param WorkPlace $workplace
     * @return View|Factory|Application
     */
    public function edit(WorkPlace $workplace): View|Factory|Application
    {
        Gate::authorize('edit-workplace');

        return view('workplaces.edit', compact('workplace'));
    }

    /**
     * @param WorkPlaceEditRequest $request
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @param WorkPlace $workplace
     * @return RedirectResponse
     */
    public function update(WorkPlaceEditRequest $request, IwmsWorkPlaceFacade $iwmsWorkPlaceFacade, WorkPlace $workplace): RedirectResponse
    {
        Gate::authorize('edit-workplace');

        $iwmsApiWorkPlaceEditDto = IwmsApiWorkPlaceEditDto::createFromRequest($request->all(), $workplace->uuid);

        if ($iwmsWorkPlaceFacade->update($iwmsApiWorkPlaceEditDto, $workplace)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.updated_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.updated_error'));
    }

    /**
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @param WorkPlace $workplace
     * @return RedirectResponse
     */
    public function destroy(IwmsWorkPlaceFacade $iwmsWorkPlaceFacade, WorkPlace $workplace): RedirectResponse
    {
        Gate::authorize('destroy-workplace');

        if ($iwmsWorkPlaceFacade->destroy($workplace, $workplace->uuid)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.deleted_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.deleted_error'));
    }
}
