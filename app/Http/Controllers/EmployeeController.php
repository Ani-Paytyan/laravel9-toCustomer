<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Http\Requests\Employee\EmployeeEditRequest;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Traits\PaginatorTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class EmployeeController extends Controller
{
    use PaginatorTrait;

    public function __construct(
        protected IwmsApiContactServiceInterface $apiContactService
    )
    {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        if ($currentUser) {
            $companyId = $currentUser->getCompany()->getId() ?? '';
        }

        $employees = $this->apiContactService->getContacts($companyId ?? '', $request->page ?? 1);

        $paginator = $this->getPaginator($request, $employees);

        return view('employees.index', compact('employees', 'paginator'));
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

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        Gate::authorize('edit-employee');

        return view('employees.edit', compact('id'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('invite-employee');

        $currentUser = Auth::user();
        $result = $this->apiContactService->invite(
            IwmsApiContactDto::createForApiInvite($request->only(['email', 'role']), $currentUser->getCompany()->getId())
        );

        if ($result) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.invite_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.invite_error'));
    }

    /**
     * @param EmployeeEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(EmployeeEditRequest $request, $id): RedirectResponse
    {
        Gate::authorize('edit-employee');

        $data = IwmsApiContactEditDto::createFromFormRequest(
            $request->only(['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'zip']), $id
        );

        $result = $this->apiContactService->update($data);

        if ($result) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.update_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.update_error'));
    }

    /**
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Gate::authorize('destroy-employee');

        if ($this->apiContactService->destroy($id)) {
            return redirect()->route('employees.index')->with('toast_success', __('page.employees.delete_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('page.employees.delete_error'));
    }
}
