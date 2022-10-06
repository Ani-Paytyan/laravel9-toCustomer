<?php

namespace App\Services\IwmsApi\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Log;

class IwmsApiCompanyService implements IwmsApiCompanyServiceInterface
{
    /**
     * @param array $companies
     * @return void
     */
    public function sync(array $companies)
    {
        // if isset companies we checked
        if (!empty($companies)) {
            try {
                $idCompanies = [];
                foreach ($companies as $company) {
                    $idCompanies[] = $company['id'];
                    // update or create company
                    Company::withTrashed()->updateOrCreate([
                        'uuid' => $company['id']
                    ], [
                        'name' => $company['name'],
                        'type' => $company['type'],
                        'address' => $company['address'] ?? '',
                        'deleted_at' => null
                    ]);
                }
                // delete from db if not listed via API
                if (!empty($idCompanies)) {
                    Company::withTrashed()->whereNotIn('uuid', $idCompanies)->delete();
                }
            } catch (\Exception $e) {
                Log::error('Save and Update companies : ' .  $e->getMessage());
            }
        }
    }
}
