<?php

namespace App\Services\IwmsApi\Company;

use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiCompanyService extends AbstractIwmsApi implements IwmsApiCompanyServiceInterface
{
    private const COMPANIES_URL =  'companies';

    /**
     * @param int|null $page
     * @return mixed
     */
    public function getCompanies(?int $page = 1): mixed
    {
        $result = null;
        $response = $this->getRequestBuilder()->get(self::COMPANIES_URL, ['currentPage' => $page]);
        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);
        }

        return $result;
    }
}
