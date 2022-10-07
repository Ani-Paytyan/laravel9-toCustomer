<?php

namespace App\Services\IwmsApi\WorkPlace;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Dto\IwmsApi\IwmsApiWorkPlaceDto;
use App\Models\Company;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiWorkPlaceService extends AbstractIwmsApi implements IwmsApiWorkPlaceServiceInterface
{
    private const WORK_PLACE_GET_URL =  'workplaces';

    public function getWorkPlaces(?int $page = 1): IwmsApiPaginationResponseDto
    {
        $companies = Company::pluck('uuid');
        $result = null;
        $workPlaces = [];

        foreach ($companies as $id) {
            $response = $this->getRequestBuilder()->get(self::WORK_PLACE_GET_URL, [
                'company_id' => $id,
                'currentPage' => $page
            ]);
            if ($response && $response->status() === 200) {
                $result = json_decode($response->getBody()->getContents(), true);
                foreach ($result['results'] as $workPlace) {
                    $workPlaces[] = IwmsApiWorkPlaceDto::createFromApiResponse($workPlace, $id);
                }

                $result['results'] = $workPlaces;
            }
        }

        return IwmsApiPaginationResponseDto::createFromApiResponse($result);
    }
}
