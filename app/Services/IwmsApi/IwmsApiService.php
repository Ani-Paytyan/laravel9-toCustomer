<?php

namespace App\Services\IwmsApi;

use Illuminate\Support\Facades\Config;

class IwmsApiService extends AbstractIwmsApi
{
    private const COMPANIES_URL =  'companies';

    /**
     * @return array
     */
    public function getCompanies(): array
    {
        $companies = [];
        $response = $this->getRequestBuilder()->get(Config::get('iwms.api_base_url') . self::COMPANIES_URL);
        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            if (isset($result['results']) && !empty($result['results'])) {
                $companies = $result['results'];
            }
        }

        return $companies;
    }
}
