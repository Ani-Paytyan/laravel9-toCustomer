<?php

namespace App\Services\IwmsApi\Item;

use App\Dto\IwmsApi\Item\IwmsApiItemDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiItemService extends AbstractIwmsApi implements IwmsApiItemServiceInterface
{
    private const ITEMS_URL =  'items';

    public function getItems(?int $page): ?IwmsApiPaginationResponseDto
    {
        $items = [];
        $response = $this->getRequestBuilder()->get(self::ITEMS_URL, ['currentPage' => $page]);

        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $item) {
                $items[] = IwmsApiItemDto::createFromApiResponse($item);
            }

            $result['results'] = $items;

            return IwmsApiPaginationResponseDto::createFromApiResponse($result);
        }

        return null;
    }
}
