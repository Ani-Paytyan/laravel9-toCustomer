<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\UniqueItem;
use App\Models\UniqueItemContact;
use DB;
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

    public function index()
    {
        $uniqueItems = UniqueItem::with('item')->paginate(20);

        return view('unique-items.index', compact('uniqueItems'));
    }

    public function show(UniqueItem $uniqueItem)
    {
        $uniqueItemContacts = UniqueItemContact::with('user')->where('unique_item_id', $uniqueItem->uuid)->get();

        $contactList = Contact::where('company_id', $this->companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->whereNotIn('uuid', $uniqueItemContacts->pluck('user_id')->toArray())
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
