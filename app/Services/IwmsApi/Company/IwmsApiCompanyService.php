<?php

namespace App\Services\IwmsApi\Company;

use App\Dto\IwmsApi\IwmsApiCompanyDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiCompanyService extends AbstractIwmsApi implements IwmsApiCompanyServiceInterface
{
    private const COMPANIES_URL =  'companies';

    /**
     * @param int|null $page
     * @return IwmsApiPaginationResponseDto
     */
    public function getCompanies(?int $page = 1): IwmsApiPaginationResponseDto
    {
        $result = null;
        $companies = [];
        $response = $this->getRequestBuilder()->get(self::COMPANIES_URL, ['currentPage' => $page]);
        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $company) {
                $companies[] = IwmsApiCompanyDto::createFromApiResponse($company);
            }

            $result['results'] = $companies;
        }

        return IwmsApiPaginationResponseDto::createFromApiResponse($result);
    }
}
