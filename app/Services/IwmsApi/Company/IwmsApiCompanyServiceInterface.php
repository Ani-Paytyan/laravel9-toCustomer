<?php

namespace App\Services\IwmsApi\Company;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiCompanyServiceInterface
{
    public function getCompanies(?int $page): IwmsApiPaginationResponseDto;
}
