<?php

namespace App\Http\Controllers;

use App\Dto\UniqueItem\UniqueItemSearchDto;
use App\Models\Item;
use App\Models\UniqueItem;
use App\Queries\Employee\EmployeeQueryInterface;
use App\Queries\UniqueItem\UniqueItemQueryInterface;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UniqueItemController extends Controller
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
     * @param UniqueItemQueryInterface $uniqueItemQuery
     * @return Application|Factory|View
     */
    public function index(Request $request, UniqueItemQueryInterface $uniqueItemQuery)
    {
        // get all items
        $items = Item::select('uuid', 'name')
            ->pluck('name', 'uuid')
            ->toArray();

        $dto = UniqueItemSearchDto::createFromRequest($request, $this->companyId);

        $uniqueItems = $uniqueItemQuery->getSearchUniqueItemQuery($dto)->with(['item' => function ($query)  {
            $query->orderBy('items.name', 'asc');
        }])->paginate(20);

        return view('unique-items.index', compact('items', 'uniqueItems'));
    }

    /**
     * @param UniqueItem $uniqueItem
     * @param EmployeeQueryInterface $employeeQuery
     * @return Application|Factory|View
     */
    public function show(UniqueItem $uniqueItem, EmployeeQueryInterface $employeeQuery)
    {
        $uniqueItemContacts = $uniqueItem->contacts()
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->orderBy(DB::raw('ISNULL(last_name), last_name'), 'ASC')
            ->paginate(10);

        $contactList = $employeeQuery->getNotAssignedToUniqueItemQuery($uniqueItem, $this->companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->select('uuid', 'first_name', 'last_name', 'email')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item['uuid'] => ($item['first_name'] && $item['last_name']) ? $item->getFullNameAttribute() : $item['email']
                ];
            })->toArray();

        return view('unique-items.show', compact('uniqueItem', 'uniqueItemContacts', 'contactList'));
    }
}
