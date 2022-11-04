<?php

namespace App\Dto\IwmsApi\UniqueItem;

class IwmsApiUniqueItemDto
{
    private string $id;
    private string $item_id;
    private string $workplace_id;
    private ?string $name;
    private ?string $article;
    private ?string $status;
    private bool $isDeleted;

    const STATUS_ACTIVE = "Active";
    const STATUS_DELETED = "Deleted";

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->item_id;
    }

    /**
     * @param string $item_id
     * @return $this
     */
    public function setItemId(string $item_id): self
    {
        $this->item_id = $item_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getWorkplaceId(): string
    {
        return $this->workplace_id;
    }

    /**
     * @param string $workplace_id
     * @return $this
     */
    public function setWorkplaceId(string $workplace_id): self
    {
        $this->workplace_id = $workplace_id;
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setIsDeleted(string $status): self
    {
        $this->isDeleted = false;

        if ($status === self::STATUS_DELETED) {
            $this->isDeleted = true;
        }

        return $this;
    }

    public static function createFromApiResponse(array $data): self
    {
        return (new self())
            ->setId($data['id'])
            ->setItemId($data['item_id'])
            ->setWorkplaceId($data['workplace_id'])
            ->setStatus($data['status'])
            ->setIsDeleted($data['status'])
            ->setName($data['name'])
            ->setArticle($data['article']);
    }
}
