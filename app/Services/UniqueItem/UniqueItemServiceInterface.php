<?php

namespace App\Services\UniqueItem;

interface UniqueItemServiceInterface
{
    /**
     * @param array $items
     * @return void
     */
    public function sync(array $items): void;
}
