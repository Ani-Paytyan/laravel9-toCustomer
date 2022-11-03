<?php

namespace App\Traits;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Models\Contact;
use DB;

trait ContactTrait
{
    public function getContactList($companyId, $contactsId)
    {
        return Contact::where('company_id', $companyId)
            ->orderBy(DB::raw('ISNULL(first_name), first_name'), 'ASC')
            ->where('status' , '!=' , IwmsApiContactDto::STATUS_DELETED)
            ->whereNotIn('uuid', $contactsId)
            ->select('uuid', 'first_name', 'last_name', 'email')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item['uuid'] => ($item['first_name'] && $item['last_name']) ? $item->getFullNameAttribute() : $item['email']
                ];
            })->toArray();
    }
}
