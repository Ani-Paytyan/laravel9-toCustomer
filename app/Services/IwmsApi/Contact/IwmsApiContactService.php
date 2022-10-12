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
    private const CONTACTS_DELETE_URL =  'contacts/delete';
    private const CONTACTS_INVITE_URL =  'contacts/invite';

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

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        $response = $this->getRequestBuilder()->delete(self::CONTACTS_DELETE_URL, ['id' => $id]);

        return $response && $response->status() === 200;
    }

    /**
     * @param IwmsApiContactDto $iwmsApiContactDto
     * @return bool
     */
    public function invite(IwmsApiContactDto $iwmsApiContactDto): bool
    {
        $response = $this->getRequestBuilder()->post(self::CONTACTS_INVITE_URL, [
            'company_id' => $iwmsApiContactDto->getCompanyId(),
            'email' => $iwmsApiContactDto->getEmail(),
            'role' => $iwmsApiContactDto->getRole()
        ]);

        return $response && $response->status() === 200;
    }
}
