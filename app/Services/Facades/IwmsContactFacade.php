<?php

namespace App\Services\Facades;

use App\Dto\Contact\ContactEditDto;
use App\Dto\Contact\ContactInviteDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactDto;
use App\Dto\IwmsApi\Contact\IwmsApiContactEditDto;
use App\Models\Contact;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Services\Contact\ContactServiceInterface;

class IwmsContactFacade
{
    public function __construct(
        protected IwmsApiContactServiceInterface $apiContactService,
        protected ContactServiceInterface $contactService
    )
    {
    }

    /**
     * @param IwmsApiContactDto $iwmsApiContactDto
     * @param ContactInviteDto $contactInviteDto
     * @return Contact|bool
     */
    public function invite(IwmsApiContactDto $iwmsApiContactDto, ContactInviteDto $contactInviteDto): Contact|bool
    {
        // send data to api
        $res = $this->apiContactService->invite($iwmsApiContactDto);
        // if success from api we save data in DB
        if ($res) {
           $contactDto = $contactInviteDto->setId($res->getId())
                ->setRole($res->getRole())
                ->setCompanyId($res->getCompanyId())
                ->setEmail($res->getEmail());


            $employee = $this->contactService->create($contactDto);
            // if the employee successfully save in the database
            if ($employee)  {
                $employee->workplaces()->attach($contactInviteDto->getWorkPlace());
                $employee->teams()->attach($contactInviteDto->getTeam());
                $employee->uniqueItems()->attach($contactInviteDto->getUniqueItem());

                return true;
            }
        }

        return false;
    }

    /**
     * @param IwmsApiContactEditDto $apiContactEditDto
     * @param Contact $contact
     * @return bool
     */
    public function update(IwmsApiContactEditDto $apiContactEditDto, Contact $contact): bool
    {
        // send data to api
        $res = $this->apiContactService->update($apiContactEditDto);
        // if success from api we update data in DB
        if ($res) {
            $contactEditDto = (new ContactEditDto())
                ->setId($res->getId())
                ->setCompanyId($res->getCompanyId())
                ->setRole($res->getRole())
                ->setFirstName($res->getFirstName())
                ->setLastName($res->getLastName())
                ->setStatus($res->getStatus())
                ->setEmail($res->getEmail())
                ->setPhone($apiContactEditDto->getPhone())
                ->setAddress($apiContactEditDto->getAddress())
                ->setCity($apiContactEditDto->getCity())
                ->setZip($apiContactEditDto->getZip());

            return $this->contactService->update($contactEditDto, $contact);
        }

        return false;
    }

    /**
     * @param Contact $contact
     * @return bool
     */
    public function restore(Contact $contact): bool
    {
        $res = $this->apiContactService->restore($contact->uuid);

        if ($res) {
            return $this->contactService->restore($contact);
        }

        return false;
    }

    /**
     * @param Contact $contact
     * @return bool
     */
    public function destroy(Contact $contact): bool
    {
        $res = $this->apiContactService->destroy($contact->uuid);

        if ($res) {
            return $this->contactService->destroy($contact);
        }

        return false;
    }

    public function remindInvite(string $email): bool
    {
        return $this->apiContactService->remindInvite($email);
    }
}
