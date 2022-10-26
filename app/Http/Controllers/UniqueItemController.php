<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\UniqueItem;
use App\Models\UniqueItemContact;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $uniqueItems = UniqueItem::with('item')->paginate(20);

        return view('unique-items.index', compact('uniqueItems'));
    }

    /**
     * @param UniqueItem $uniqueItem
     * @return Application|Factory|View
     */
    public function show(UniqueItem $uniqueItem)
    {
        $uniqueItemContacts = UniqueItemContact::with('contact')
            ->where('unique_item_id', $uniqueItem->uuid)->get();

        $contactList = Contact::where('company_id', $this->companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->whereNotIn('uuid', $uniqueItemContacts->pluck('contact_id')->toArray())
            ->select('uuid', 'first_name', 'last_name', 'email')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['uuid'] => $item['first_name'] && $item['last_name']
                    ? ($item->getFullNameAttribute())
                    : $item['email']];
            })->toArray();


        return view('unique-items.show', compact('uniqueItem', 'uniqueItemContacts', 'contactList'));
    }
}
