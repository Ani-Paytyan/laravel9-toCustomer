<?php

namespace App\Http\Controllers;

use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
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
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        Gate::authorize('edit-employees');

        return view('employees.edit', compact('id'));
    }

    /**
     * @param EmployeeEditRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(EmployeeEditRequest $request, $id): RedirectResponse
    {
        Gate::authorize('edit-employees');

        $data = IwmsApiContactEditDto::createFromFormRequest(
            $request->only(['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'zip']), $id
        );

        $result = $this->apiContactService->update($data);

        if ($result) {
            return redirect()->route('employees.index')->with('success', __('page.employees.update_successfully'));
        }

        return redirect()->route('employees.index')->with('error', __('page.employees.update_error'));
    }
}
