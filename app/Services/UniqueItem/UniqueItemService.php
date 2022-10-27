<?php

namespace App\Services\UniqueItem;

use App\Models\UniqueItem;

class UniqueItemService implements UniqueItemServiceInterface
{
    public function sync(array $items): void
    {
        $idItems = [];
        foreach ($items as $item) {
            $idItems[] = $item->getId();
            // update or create item
            UniqueItem::withTrashed()->updateOrCreate([
                'uuid' => $item->getId()
            ], [
                'name' => $item->getName(),
                'article' => $item->getArticle(),
                'item_id' => $item->getItemId(),
                'workplace_id' => $item->getWorkPlaceId(),
                'deleted_at' => null
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idItems)) {
            UniqueItem::withTrashed()->whereNotIn('uuid', $idItems)->delete();
        }
    }
}
