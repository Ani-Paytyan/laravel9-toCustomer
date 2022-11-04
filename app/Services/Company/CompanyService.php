<?php

namespace App\Services\Company;

use App\Models\Company;

class CompanyService implements CompanyServiceInterface
{
    /**
     * @param array $companies
     * @return void
     */
    public function sync(array $companies): void
    {
        $idCompanies = [];
        foreach ($companies as $company) {
            $idCompanies[] = $company->getId();
            // update or create company
            Company::withTrashed()->updateOrCreate([
                'uuid' => $company->getId()
            ], [
                'name' => $company->getName(),
                'type' => $company->getType(),
                'address' => $company->getAddress() ?? '',
                'deleted_at' => $company->getIsDeleted() ? now() : null
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idCompanies)) {
            Company::withTrashed()->whereNotIn('uuid', $idCompanies)->delete();
        }
    }
}
