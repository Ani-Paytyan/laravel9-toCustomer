<?php

namespace App\Services\IwmsApi\Company;

use App\Dto\IwmsApi\IwmsApiCompanyDto;

interface IwmsApiCompanyServiceInterface
{
    public function getCompanies(?int $page);
}
