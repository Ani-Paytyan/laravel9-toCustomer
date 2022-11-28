<?php

namespace App\Services\IwmsApi\WorkPlace;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceDto;
use App\Dto\IwmsApi\WorkPlace\IwmsApiWorkPlaceEditDto;
use App\Dto\WorkPlace\WorkPlaceDto;
use App\Dto\WorkPlace\WorkPlaceEditDto;
use App\Models\Company;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiWorkPlaceService extends AbstractIwmsApi implements IwmsApiWorkPlaceServiceInterface
{
    private const WORK_PLACE_GET_URL =  'workplaces';
    private const WORK_PLACE_CREATE_URL =  'workplaces/create';
    private const WORK_PLACE_UPDATE_URL =  'workplaces/update';
    private const WORK_PLACE_DELETE_URL =  'workplaces/delete';

    /**
     * @param string $companyId
     * @param int|null $page
     * @return IwmsApiPaginationResponseDto|null
     */
    public function getWorkPlaces(string $companyId, ?int $page = 1): ?IwmsApiPaginationResponseDto
    {
        $workPlaces = [];
        $response = $this->getRequestBuilder()->get(self::WORK_PLACE_GET_URL, [
            'company_id' => $companyId,
            'currentPage' => $page
        ]);
        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $workPlace) {
                $workPlaces[] = IwmsApiWorkPlaceDto::createFromApiResponse($workPlace, $companyId);
            }

            $result['results'] = $workPlaces;

            return IwmsApiPaginationResponseDto::createFromApiResponse($result);
        }

        return null;
    }

    /**
     * @param IwmsApiWorkPlaceDto $apiWorkPlaceDto
     * @return IwmsApiWorkPlaceDto|null
     */
    public function create(IwmsApiWorkPlaceDto $apiWorkPlaceDto): ?IwmsApiWorkPlaceDto
    {
        $response = $this->getRequestBuilder()->post(self::WORK_PLACE_CREATE_URL, [
            'company_id' => $apiWorkPlaceDto->getCompanyId(),
            'name' => $apiWorkPlaceDto->getName(),
            'address' => $apiWorkPlaceDto->getAddress(),
            'zip' => $apiWorkPlaceDto->getZip(),
            'city' => $apiWorkPlaceDto->getCity(),
            'number' => $apiWorkPlaceDto->getNumber()
        ]);

        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            return IwmsApiWorkPlaceDto::createFromApiResponse($result['results'], $apiWorkPlaceDto->getCompanyId());
        }

        return null;
    }

    /**
     * @param IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto
     * @return IwmsApiWorkPlaceEditDto|null
     */
    public function update(IwmsApiWorkPlaceEditDto $apiWorkPlaceEditDto): ?IwmsApiWorkPlaceEditDto
    {
        $response = $this->getRequestBuilder()->put(self::WORK_PLACE_UPDATE_URL, [
            'id' => $apiWorkPlaceEditDto->getId(),
            'name' => $apiWorkPlaceEditDto->getName(),
            'address' => $apiWorkPlaceEditDto->getAddress(),
            'zip' => $apiWorkPlaceEditDto->getZip(),
            'city' => $apiWorkPlaceEditDto->getCity(),
            'number' => $apiWorkPlaceEditDto->getNumber()
        ]);

        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            return IwmsApiWorkPlaceEditDto::createFromApiResponse($result['results']);
        }

        return null;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $response = $this->getRequestBuilder()->delete(self::WORK_PLACE_DELETE_URL, ['id' => $id]);

        return $response && $response->status() === 200;
    }
}
