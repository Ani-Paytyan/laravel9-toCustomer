<?php

namespace App\Queries\UniqueItem;

use App\Dto\UniqueItem\UniqueItemSearchDto;
use App\Models\Contact;
use App\Models\UniqueItem;
use Illuminate\Database\Eloquent\Builder;

class UniqueItemQuery implements UniqueItemQueryInterface
{
    /**
     * @param Contact $contact
     * @param string $companyId
     * @return Builder
     */
    public function getNotAssignedToContactQuery(Contact $contact, string $companyId): Builder
    {
        return UniqueItem::with('item')->whereHas('workPlace', static function (Builder $query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->whereDoesntHave('contacts', function (Builder $query) use ($contact) {
            $query->where('contact_id', $contact->uuid);
        });
    }

    public function getSearchUniqueItemQuery(UniqueItemSearchDto $dto): Builder
    {
        $query = UniqueItem::query();

        if ($dto->getCompanyId() !== null) {
            $query->whereHas('workPlace', function (Builder $query) use ($dto) {
                $query->where('company_id', $dto->getCompanyId());
            });
        }

        if ($dto->getItem() !== null) {
            $query->whereHas('item', function (Builder $query) use ($dto) {
                $query->whereIn('uuid', $dto->getItem());
            });
        }

        if ($dto->getSerialNumber() !== null) {
            $query->whereHas('item', function (Builder $query) use ($dto) {
                $query->where('serial_number','=', $dto->getSerialNumber());
            });
        }

        if ($dto->getName() !== null) {
            $query->where('name', 'like', "%{$dto->getName()}%")
                ->orWhereHas('item', function (Builder $query) use ($dto) {
                    $query->where('name', 'like', "%{$dto->getName()}%");
                });
        }

        if ($dto->getArticle() !== null) {
            $query->where('article', '=', $dto->getArticle());
        }

        return $query;
    }

    public function getAllUniqueItems(string $companyId): Builder
    {
        return UniqueItem::whereHas('workPlace', static function (Builder $query) use ($companyId) {
            $query->where('company_id', $companyId);
        });
    }
}
