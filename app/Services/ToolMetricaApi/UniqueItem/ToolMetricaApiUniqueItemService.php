<?php

namespace App\Services\ToolMetricaApi\UniqueItem;

use App\Services\ToolMetricaApi\AbstractToolMetricaApi;

class ToolMetricaApiUniqueItemService extends AbstractToolMetricaApi implements ToolMetricaApiUniqueItemServiceInterface
{
    private const ITEMS_STATUS_URL =  'api/v1/items/status';

    public function getUniqueItemsStatus($array)
    {
        $response = $this->getRequestBuilder()->post(self::ITEMS_STATUS_URL, [
            'devices' => $array
        ]);

        if ($response && $response->status() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        return null;
    }
}
