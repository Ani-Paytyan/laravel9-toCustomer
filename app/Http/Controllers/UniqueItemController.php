<?php

namespace App\Http\Controllers;

use App\Models\UniqueItem;
use App\Traits\ContactTrait;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class UniqueItemController extends Controller
{
    use ContactTrait;

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
        $uniqueItems = UniqueItem::with('item')->paginate(20);

        return view('unique-items.index', compact('uniqueItems'));
    }

    /**
     * @param UniqueItem $uniqueItem
     * @return Application|Factory|View
     */
    public function show(UniqueItem $uniqueItem)
    {
        $uniqueItemContacts = $uniqueItem->contacts()
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->orderBy(DB::raw('ISNULL(last_name), last_name'), 'ASC');

        $contactList = $this->getContactList($this->companyId, $uniqueItemContacts->get()->pluck('uuid')->toArray());

        $uniqueItemContacts = $uniqueItemContacts->paginate(10);

        return view('unique-items.show', compact('uniqueItem', 'uniqueItemContacts', 'contactList'));
    }
}
