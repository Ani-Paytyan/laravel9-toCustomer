<?php

namespace App\Services\Contact;

use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;

class ContactService implements ContactServiceInterface
{
    /**
     * @param IwmsApiContactServiceInterface $apiContactService
     * @return array
     */
    public function getContactsWithPagination(IwmsApiContactServiceInterface $apiContactService): array
    {
        // get contacts
        $result = $apiContactService->getContacts();
        $pageCount = $result->getTotalPages();
        $items[] = $result->getResults();

        if ($pageCount > 1) {
            for ($i = 2; $i <= $pageCount; $i++) {
                $resultOtherPages = $apiContactService->getContacts($i);
                $items[] = $resultOtherPages->getResults();
            }
        }

        return array_merge([], ...$items);
    }
}
