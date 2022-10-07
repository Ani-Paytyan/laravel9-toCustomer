<?php

namespace App\Services\Company;

interface CompanyServiceInterface
{
    /**
     * @param array $companies
     * @return void
     */
    public function sync(array $companies): void;
}
