<?php

namespace App\Dto\UniqueItem;

use Illuminate\Http\Request;

class UniqueItemSearchDto
{
    private string $company_id;
    private ?array $item_id;
    private ?string $serial_number;
    private ?string $name;
    private ?string $article;

    /**
     * @return array|null
     */
    public function getItem(): ?array
    {
        return $this->item_id;
    }

    /**
     * @param array|null $item_id
     * @return $this
     */
    public function setItemId(?array $item_id): self
    {
        $this->item_id = $item_id;
        return $this;
    }
    /**
     * @return string|null
     */
    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    /**
     * @param string|null $serial_number
     * @return $this
     */
    public function setSerialNumber(?string $serial_number): self
    {
        $this->serial_number = $serial_number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArticle(): ?string
    {
        return $this->article;
    }

    /**
     * @param string|null $article
     * @return $this
     */
    public function setArticle(?string $article): self
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyId(): ?string
    {
        return $this->company_id;
    }

    /**
     * @param string|null $company_id
     * @return $this
     */
    public function setCompanyId(?string $company_id): self
    {
        $this->company_id = $company_id;
        return $this;
    }

    /**
     * @param Request $request
     * @param $companyId
     * @return static
     */
    public static function createFromRequest(Request $request, $companyId): self
    {
        return (new self())
            ->setCompanyId($companyId)
            ->setItemId($request->get('item'))
            ->setSerialNumber($request->get('serial_number'))
            ->setName($request->get('unique_item_name'))
            ->setArticle($request->get('unique_item_article'));
    }
}


