<?php

namespace App\Http\Controllers;

use App\Services\Contact\ContactServiceInterface;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;

class EmployeeController extends Controller
{
    protected IwmsApiContactServiceInterface $apiContactService;
    protected ContactServiceInterface $contactService;

    public function __construct(IwmsApiContactServiceInterface $apiContactService, ContactServiceInterface $contactService)
    {
        $this->apiContactService = $apiContactService;
        $this->contactService = $contactService;
    }

    public function index()
    {
       $employees = $this->contactService->getContactsWithPagination($this->apiContactService);

        return view('employees.index', compact('employees'));
    }
}
