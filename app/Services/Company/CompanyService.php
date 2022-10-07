<?php

namespace App\Services\Company;

use App\Models\Company;

class CompanyService implements CompanyServiceInterface
{
    /**
     * @param array $companies
     * @return void
     */
    public function sync(array $companies)
    {
        $idCompanies = [];
        foreach ($companies as $company) {
            $idCompanies[] = $company->id;
            // update or create company
            Company::withTrashed()->updateOrCreate([
                'uuid' => $company->id
            ], [
                'name' => $company->name,
                'type' => $company->type,
                'address' => $company->address ?? '',
                'deleted_at' => null
            ]);
        }
        // delete from db if not listed via API
        if (!empty($idCompanies)) {
            Company::withTrashed()->whereNotIn('uuid', $idCompanies)->delete();
        }
    }
}
