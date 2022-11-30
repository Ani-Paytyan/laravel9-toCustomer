<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Dto\WorkPlace\WorkPlaceSearchDto;
use App\Http\Requests\WorkPlace\WorkPlaceCreateRequest;
use App\Http\Requests\WorkPlace\WorkPlaceEditRequest;
use App\Models\WorkPlace;
use App\Queries\Employee\EmployeeQueryInterface;
use App\Queries\Workplace\WorkplaceQueryInterface;
use App\Services\Facades\IwmsWorkPlaceFacade;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class WorkPlaceController extends Controller
{
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
     * @param Request $request
     * @param WorkplaceQueryInterface $workplaceQuery
     * @return Application|Factory|View
     */
    public function index(Request $request, WorkplaceQueryInterface $workplaceQuery)
    {
        $dto = WorkPlaceSearchDto::createFromRequest($request, $this->companyId);

        $workPlaces = $workplaceQuery->getSearchWorkplaceQuery($dto)
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

    /**
     * @param WorkPlace $workplace
     * @param EmployeeQueryInterface $employeeQuery
     * @return Application|Factory|View
     */
    public function show(WorkPlace $workplace, EmployeeQueryInterface $employeeQuery)
    {
        // get workplace contacts
        $workPlaceContacts = $workplace->contacts()
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->orderBy(DB::raw('ISNULL(last_name), last_name'), 'ASC')
            ->paginate(10);

        // get all contacts Not Assigned To Work Place
        $contactList = $employeeQuery->getNotAssignedToWorkPlaceQuery($workplace, $this->companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item['uuid'] => ($item['first_name'] && $item['last_name']) ? $item->getFullNameAttribute() : $item['email']
                ];
            })->toArray();

        // get workplace unique items
        $uniqueItems = $workplace->uniqueItems()->paginate(10);

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
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.created_successfully', ['name' => $iwmsApiWorkPlaceDto->getName()]));
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

        if ($iwmsWorkPlaceFacade->destroy($workplace)) {
            return redirect()->route('workplaces.index')->with('toast_success', __('page.workplaces.archived_successfully'));
        }

        return redirect()->route('workplaces.index')->with('toast_error', __('page.workplaces.archived_error'));
    }

    /**
     * @return Application|Factory|View
     */
    public function archive()
    {
        $workPlaces = WorkPlace::where('company_id', $this->companyId)
            ->onlyTrashed()
            ->orderBy('name', 'ASC')
            ->paginate(20);

        return view('workplaces.archive', compact('workPlaces'));
    }

    public function archiveWorkPlace(WorkPlace $workPlace)
    {
        return view('workplaces.archive-show', compact('workPlace'));
    }

    /**
     * @param WorkPlace $workPlace
     * @param IwmsWorkPlaceFacade $iwmsWorkPlaceFacade
     * @return RedirectResponse
     */
    public function restore(WorkPlace $workPlace, IwmsWorkPlaceFacade $iwmsWorkPlaceFacade): RedirectResponse
    {
        if ($iwmsWorkPlaceFacade->restore($workPlace)) {
            return redirect()->route('workplaces.archive')->with('toast_success', __('page.workplaces.restored_successfully'));
        }

        return redirect()->route('workplaces.archive')->with('toast_error', __('page.workplaces.restored_error'));
    }

}
