<?php

namespace App\Services\ToolMetricaApi\UniqueItem;

use App\Dto\ToolMetrica\ToolMetricaApiUniqueItemServiceDto;
use App\Services\ToolMetricaApi\AbstractToolMetricaApi;

class ToolMetricaApiUniqueItemService extends AbstractToolMetricaApi implements ToolMetricaApiUniqueItemServiceInterface
{
    private const ITEMS_STATUS_URL =  'api/v1/items/status';

    /**
     * @param $array
     * @return array|null
     */
    public function getUniqueItemsStatus($array): ?array
    {
        $items = [];
        $response = $this->getRequestBuilder()->post(self::ITEMS_STATUS_URL, [
            'devices' => $array
        ]);

        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            foreach ($result as $key => $value) {
                $items[] = ToolMetricaApiUniqueItemServiceDto::createFromApiResponse($key, $value);
            }

            return $items;
        }

        return null;
    }
}
