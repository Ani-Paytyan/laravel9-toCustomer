<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\IwmsApiContactDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiContactService extends AbstractIwmsApi implements IwmsApiContactServiceInterface
{
    private const CONTACTS_GET_URL =  'contacts';

    public function getContacts(string $companyId, ?int $page = 1): IwmsApiPaginationResponseDto
    {
        $result = null;
        $contacts = [];
        $response = $this->getRequestBuilder()->get(self::CONTACTS_GET_URL, [
            'currentPage' => $page,
            'company_id' => $companyId,
        ]);
        if ($response && $response->status() === 200) {
            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $contact) {
                $contacts[] = IwmsApiContactDto::createFromApiResponse($contact);
            }

            $result['results'] = $contacts;
        }

        return IwmsApiPaginationResponseDto::createFromApiResponse($result);
    }
}
