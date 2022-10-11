<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiContactServiceInterface
{
    public function getContacts(?int $page): IwmsApiPaginationResponseDto;
}
