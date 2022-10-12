<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthServiceInterface;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Traits\PaginatorTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    use PaginatorTrait;

    protected IwmsApiContactServiceInterface $apiContactService;
    protected AuthServiceInterface $authService;

    public function __construct(IwmsApiContactServiceInterface $apiContactService, AuthServiceInterface $authService)
    {
        $this->apiContactService = $apiContactService;
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $currentUser = $this->authService->getCurrentUser();
        if ($currentUser) {
            $companyId = $currentUser->getCompany()->getId() ?? '';
        }

        $employees = $this->apiContactService->getContacts($companyId ?? '', $request->page ?? 1);

        $paginator = $this->getPaginator($request, $employees);

        return view('employees.index', compact('employees', 'paginator'));
    }
}
