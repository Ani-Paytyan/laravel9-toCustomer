<?php

namespace App\Dto\ToolMetrica;

class ToolMetricaApiUniqueItemServiceDto
{
    private string $id;
    private string $status;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
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

    public static function createFromApiResponse($uuid, $value): self
    {
        return (new self())
            ->setId($uuid)
            ->setStatus($value);
    }
}
