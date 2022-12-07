<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UniqueItemResource;
use App\Models\UniqueItem;

class UniqueItemController extends Controller
{
    public function setItemInside($mac, $inside) {
        $item = UniqueItem::where('mac', $mac)->firstOrFail();
        $item->is_inside = $inside == 1;
        $item->save();
    }
}
