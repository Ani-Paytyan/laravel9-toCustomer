<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\IwmsApiContactDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;
use App\Services\Auth\AuthServiceInterface;
use App\Services\IwmsApi\AbstractIwmsApi;

class IwmsApiContactService extends AbstractIwmsApi implements IwmsApiContactServiceInterface
{
    private const CONTACTS_GET_URL =  'contacts';

    public function __construct(private AuthServiceInterface $authService)
    {
    }

    public function getContacts(?int $page = 1): IwmsApiPaginationResponseDto
    {
        $result = null;
        $contacts = [];

        $currentUser = $this->authService->getCurrentUser();

        if ($currentUser) {
            $this->setUserToken($currentUser->getToken());
            $response = $this->getRequestBuilder()->get(self::CONTACTS_GET_URL, [
                'currentPage' => $page,
                'company_id' => $currentUser->getCompany()->getId(),
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            foreach ($result['results'] as $contact) {
                $contacts[] = IwmsApiContactDto::createFromApiResponse($contact);
            }

            $result['results'] = $contacts;
        }

        return IwmsApiPaginationResponseDto::createFromApiResponse($result);
    }
}
