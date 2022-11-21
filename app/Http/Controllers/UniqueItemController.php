<?php

namespace App\Http\Controllers;

use App\Models\UniqueItem;
use App\Queries\Employee\EmployeeQuery;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $uniqueItems = UniqueItem::select('unique_items.*')
            ->join('items', 'items.uuid', '=', 'unique_items.item_id')
            ->orderBy('items.name')
            ->whereHas('workPlace', function (Builder $query) {
                $query->where('company_id', $this->companyId);
            })
            ->paginate(20);

        return view('unique-items.index', compact('uniqueItems'));
    }

    /**
     * @param UniqueItem $uniqueItem
     * @param EmployeeQuery $employeeQuery
     * @return Application|Factory|View
     */
    public function show(UniqueItem $uniqueItem, EmployeeQuery $employeeQuery)
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
