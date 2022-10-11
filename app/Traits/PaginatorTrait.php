<?php

namespace App\Traits;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait PaginatorTrait
{
    /**
     * @param Request $request
     * @param IwmsApiPaginationResponseDto $responseDto
     * @return LengthAwarePaginator
     */
    private function getPaginator(Request $request, IwmsApiPaginationResponseDto $responseDto): LengthAwarePaginator
    {
        $items = $responseDto->getResults();

        $page = $responseDto->getCurrentPage();
        $perPage = $responseDto->getPerPage();
        $offset = ($page - 1) * $perPage;
        $items = array_slice($items, $offset, $perPage); // the array that we actually pass to the paginator is sliced

        return new LengthAwarePaginator($items, count($items), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
    }
}
