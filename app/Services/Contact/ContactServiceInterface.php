<?php

namespace App\Services\Contact;

use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;

interface ContactServiceInterface
{
    /**
     * @param IwmsApiContactServiceInterface $apiContactService
     * @return array
     */
    public function getContactsWithPagination(IwmsApiContactServiceInterface $apiContactService): array;
}
