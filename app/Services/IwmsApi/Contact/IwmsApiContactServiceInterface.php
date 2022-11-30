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
     * @return null|IwmsApiPaginationResponseDto
     */
    public function getContacts(string $companyId, ?int $page): ?IwmsApiPaginationResponseDto;

    /**
     * @param IwmsApiContactDto $iwmsApiContactDto
     * @return IwmsApiContactDto|null
     */
    public function invite(IwmsApiContactDto $iwmsApiContactDto): ?IwmsApiContactDto;

    /**
     * @param IwmsApiContactEditDto $iwmsApiContactEditDto
     * @return IwmsApiContactEditDto|null
     */
    public function update(IwmsApiContactEditDto $iwmsApiContactEditDto): ?IwmsApiContactEditDto;

    /**
     * @param string $id
     * @return bool
     */
    public function restore(string $id): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;

    /**
     * @param string $email
     * @return bool
     */
    public function remindInvite(string $email): bool;
}
