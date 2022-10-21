<?php

namespace App\Services\IwmsApi\Contact;

use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
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
     * @param string $companyId
     * @param string $id
     * @return IwmsApiContactDto|null
     */
    public function getContact(string $companyId, string $id): ?IwmsApiContactDto;

    /**
     * @param IwmsApiContactEditDto $iwmsApiContactEditDto
     * @return bool
     */
    public function update(IwmsApiContactEditDto $iwmsApiContactEditDto): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;

    /**
     * @param IwmsApiContactDto $iwmsApiContactDto
     * @return bool
     */
    public function invite(IwmsApiContactDto $iwmsApiContactDto): bool;
}
