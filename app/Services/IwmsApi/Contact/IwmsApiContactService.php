<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiContactService extends AbstractIwmsApi implements IwmsApiContactServiceInterface
{
    private const CONTACTS_GET_URL =  'contacts';
    private const CONTACTS_UPDATE_URL =  'contacts/update';

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

    /**
     * @param IwmsApiContactEditDto $iwmsApiContactEditDto
     * @return bool
     */
    public function update(IwmsApiContactEditDto $iwmsApiContactEditDto): bool
    {
        $response = $this->getRequestBuilder()->put(self::CONTACTS_UPDATE_URL, [
            'id' => $iwmsApiContactEditDto->getId(),
            'first_name' => $iwmsApiContactEditDto->getFirstName(),
            'last_name' => $iwmsApiContactEditDto->getLastName(),
            'phone' => $iwmsApiContactEditDto->getPhone(),
            'address' => $iwmsApiContactEditDto->getAddress(),
            'city' => $iwmsApiContactEditDto->getCity(),
            'zip' => $iwmsApiContactEditDto->getZip(),
        ]);

        return $response && $response->status() === 200;
    }
}
