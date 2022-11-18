<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Http\Requests\Employee\EmployeeCreateRequest;
use App\Http\Requests\Employee\EmployeeEditRequest;
use App\Models\Contact;
use App\Models\Team;
use App\Models\TeamContact;
use App\Models\WorkPlace;
use App\Models\UniqueItem;
use App\Services\Facades\IwmsContactFacade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class EmployeeController extends Controller
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $userId = $this->user->getId();
        $statusDeleted = IwmsApiContactDto::STATUS_DELETED;

        $employees = Contact::where('company_id', $this->companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->orderBy(DB::raw('ISNULL(last_name), last_name'), 'ASC')
            ->paginate(20);

        return view('employees.index', compact('employees',  'userId', 'statusDeleted'));
    }

    /**
     *
     * Invite a contact view
     * @return Application|Factory|View
     */
    public function create()
    {
        Gate::authorize('invite-employee');

        $roles = [
            IwmsApiUserDto::ROLE_ADMIN => IwmsApiUserDto::ROLE_ADMIN,
            IwmsApiUserDto::ROLE_MANAGER => IwmsApiUserDto::ROLE_MANAGER,
            IwmsApiUserDto::ROLE_WORKER => IwmsApiUserDto::ROLE_WORKER,
        ];

        return view('employees.invite', compact('roles'));
    }

    public function show(Contact $employee)
    {
        $workPlaces = $employee->workplaces()->orderBy('name', 'ASC')->paginate(10);

        $uniqueItems = $employee->uniqueItems()
            ->join('items', 'items.uuid', '=', 'unique_items.item_id')
            ->orderBy('items.name')
            ->paginate(10);

        $teams = $employee->teams()->orderBy('name', 'ASC')->paginate(10);

        return view('employees.show', compact('employee', 'workPlaces', 'uniqueItems', 'teams'));
    }

    /**
     * @param EmployeeCreateRequest $request
     * @param IwmsContactFacade $iwmsContactFacade
     * @return RedirectResponse
     */
    public function store(EmployeeCreateRequest $request, IwmsContactFacade $iwmsContactFacade): RedirectResponse
    {
        Gate::authorize('invite-employee');

        $iwmsApiContactDto = IwmsApiContactDto::createFromRequest($request->all(), $this->companyId);

        if ($iwmsContactFacade->invite($iwmsApiContactDto)) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.invite_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.invite_error'));
    }

    /**
     * @param Contact $employee
     * @return Application|Factory|View
     */
    public function edit(Contact $employee)
    {
        Gate::authorize('edit-employee');

        $roles = [
            IwmsApiUserDto::ROLE_ADMIN => IwmsApiUserDto::ROLE_ADMIN,
            IwmsApiUserDto::ROLE_MANAGER => IwmsApiUserDto::ROLE_MANAGER,
            IwmsApiUserDto::ROLE_WORKER => IwmsApiUserDto::ROLE_WORKER,
        ];

        // ability to change the role of all contacts of contacts, except for super-admins
        $canEditRole = $employee->role !== IwmsApiUserDto::ROLE_SUPER_ADMIN;

        // get workplaces
        $workPlaces = $employee->workplaces()->orderBy('name', 'ASC')->get();
        $workPlaceList = WorkPlace::where('company_id', $this->companyId)
            ->whereNotIn('uuid', $workPlaces->pluck('uuid')->toArray())
            ->orderBy('name', 'ASC')
            ->pluck('name','uuid')
            ->toArray();

        // get unique items
        $uniqueItemContacts = $employee->uniqueItems()->orderBy('name', 'ASC')->get();
        $uniqueItemList = UniqueItem::with('item')->whereHas('workPlace', function (Builder $query) {
            $query->where('company_id', $this->companyId);
        })
            ->whereNotIn('uuid', $uniqueItemContacts->pluck('uuid')->toArray())
            ->orderBy('article', 'ASC')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['uuid'] => $item['name'] ?? $item->item->name . ' -  ' . $item['article']];
            })->toArray();

        // get employee team
        $teams = $employee->teams()->orderBy('name', 'ASC')->get();
        $teamRoles = TeamContact::getRoles();
        $teamsList = Team::where('company_id', $this->companyId)
            ->whereNotIn('uuid', $teams->pluck('uuid')->toArray())
            ->orderBy('name', 'ASC')
            ->pluck('name','uuid')
            ->toArray();

        return view('employees.edit', compact(
            'employee',
            'roles',
            'canEditRole',
            'workPlaces',
            'workPlaceList',
            'uniqueItemContacts',
            'uniqueItemList',
            'teams',
            'teamRoles',
            'teamsList'
        ));
    }

    /**
     * @param EmployeeEditRequest $request
     * @param IwmsContactFacade $iwmsContactFacade
     * @param Contact $employee
     * @return RedirectResponse
     */
    public function update(EmployeeEditRequest $request, IwmsContactFacade $iwmsContactFacade, Contact $employee): RedirectResponse
    {
        Gate::authorize('edit-employee');

        $iwmsApiContactEditDto = IwmsApiContactEditDto::createFromRequest($request->all(), $employee->uuid);

        if ($iwmsContactFacade->update($iwmsApiContactEditDto, $employee)) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.update_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.update_error'));
    }

    /**
     * @param IwmsContactFacade $iwmsContactFacade
     * @param Contact $employee
     * @return RedirectResponse
     */
    public function destroy(IwmsContactFacade $iwmsContactFacade, Contact $employee): RedirectResponse
    {
        Gate::authorize('destroy-employee');

        if ($iwmsContactFacade->destroy($employee)) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.delete_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.delete_error'));
    }
}
