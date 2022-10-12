<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Http\Requests\Employee\EmployeeEditRequest;
use App\Models\User;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Traits\PaginatorTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $superAdmin = false;
        $currentUser = Auth::user();
        if ($currentUser) {
            $companyId = $currentUser->getCompany()->getId() ?? '';
            $superAdmin = $currentUser->getRole() == User::ROLE_SUPER_ADMIN;
        }

        $employees = $this->apiContactService->getContacts($companyId ?? '', $request->page ?? 1);

        $paginator = $this->getPaginator($request, $employees);

        return view('employees.index', compact('employees', 'paginator', 'superAdmin'));
    }

    /**
     *
     * Invite a contact view
     * @return Application|Factory|View
     */
    public function create()
    {
        $roles = [
            User::ROLE_ADMIN,
            User::ROLE_MANAGER,
            User::ROLE_WORKER,
        ];

        return view('employees.invite', compact('roles'));
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('employees.edit', compact('id'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $currentUser = Auth::user();
        $result = $this->apiContactService->invite(
            IwmsApiContactDto::createForApiInvite($request->only(['email', 'role']), $currentUser->getCompany()->getId())
        );

        if ($result) {
            return redirect()->route('employees.index')->with('toast_success', __('employees.invite_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('employees.invite_error'));
    }

    /**
     * @param EmployeeEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(EmployeeEditRequest $request, $id): RedirectResponse
    {
        $data = IwmsApiContactEditDto::createFromFormRequest(
            $request->only(['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'zip']), $id
        );

        if ($this->apiContactService->update($data)) {
            return redirect()->route('employees.index')->with('toast_success', __('employees.update_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('employees.update_error'));
    }

    /**
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        if ($this->apiContactService->destroy($id)) {
            return redirect()->route('employees.index')->with('toast_success', __('employees.delete_successfully'));
        }

        return redirect()->route('employees.index')->with('toast_error', __('employees.delete_error'));
    }
}
