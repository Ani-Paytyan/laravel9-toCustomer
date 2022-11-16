<?php

namespace App\Services\ToolMetricaApi\UniqueItem;

use App\Dto\ToolMetrica\ToolMetricaApiUniqueItemServiceDto;

interface ToolMetricaApiUniqueItemServiceInterface
{
    /**
     * @param $array
     * @return array|null
     */
    public function getUniqueItemsStatus($array): ?array;
}
