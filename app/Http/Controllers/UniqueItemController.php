<?php

namespace App\Http\Controllers;

use App\Models\UniqueItem;
use App\Queries\Employee\EmployeeQueryInterface;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UniqueItemController extends Controller
{
    const PAGE = 10;

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
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $uniqueItems = UniqueItem::select('unique_items.*')
            ->join('items', 'items.uuid', '=', 'unique_items.item_id')
            ->orderBy('items.name')
            ->whereHas('workPlace', function (Builder $query) {
                $query->where('company_id', $this->companyId);
            });

        $uniqueItems = ($request->get('limit')) ? $uniqueItems->paginate($request->get('limit'))
            : $uniqueItems->paginate(self::PAGE);

        return view('unique-items.index', compact('uniqueItems'));
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
