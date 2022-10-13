<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Dto\IwmsApi\IwmsApiPaginationResponseDto;

interface IwmsApiContactServiceInterface
{
    /**
     * @param string $companyId
     * @param int|null $page
     * @return IwmsApiPaginationResponseDto
     */
    public function getContacts(string $companyId, ?int $page): IwmsApiPaginationResponseDto;

    /**
     * @param IwmsApiContactEditDto $iwmsApiContactEditDto
     * @return bool
     */
    public function update(IwmsApiContactEditDto $iwmsApiContactEditDto): bool;
}
