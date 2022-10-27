<?php

namespace App\Services\IwmsApi\UniqueItem;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Dto\IwmsApi\UniqueItem\IwmsApiUniqueItemDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiUniqueItemService extends AbstractIwmsApi implements IwmsApiUniqueItemServiceInterface
{
    private const ITEMS_URL =  'unique-items';

    public function getItems(?int $page): ?IwmsApiPaginationResponseDto
    {
        $items = [];
        $response = $this->getRequestBuilder()->get(self::ITEMS_URL, ['currentPage' => $page]);

        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $item) {
                $items[] = IwmsApiUniqueItemDto::createFromApiResponse($item);
            }

            $result['results'] = $items;

            return IwmsApiPaginationResponseDto::createFromApiResponse($result);
        }

        return null;
    }
}
