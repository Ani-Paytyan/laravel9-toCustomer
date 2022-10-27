<?php

namespace App\Services\Item;

interface ItemServiceInterface
{
    /**
     * @param array $items
     * @return void
     */
    public function sync(array $items): void;
}
