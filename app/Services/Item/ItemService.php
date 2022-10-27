<?php

namespace App\Services\Item;

use App\Models\Item;

class ItemService implements ItemServiceInterface
{
    /**
     * @param array $companies
     * @return void
     */
    public function sync(array $items): void
    {
        $idItems = [];
        foreach ($items as $item) {
            $idItems[] = $item->getId();
            // update or create item
            Item::withTrashed()->updateOrCreate([
                'uuid' => $item->getId()
            ], [
                'name' => $item->getName(),
                'serial_number' => $item->getSerialNumber(),
                'deleted_at' => null
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idItems)) {
            Item::withTrashed()->whereNotIn('uuid', $idItems)->delete();
        }
    }
}
