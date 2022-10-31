<?php

namespace App\Dto\WorkDays;


class WorkDaysCreateDto
{
    private string $id;
    private string $day_of_week;
    private string $from;
    private string $to;
    private string $is_active;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDay(): string
    {
        return $this->day_of_week;
    }

    public function setDay(string $day_of_week): self
    {
        $this->day_of_week = $day_of_week;
        return $this;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }

    public function getIsActive(): ?string
    {
        return $this->is_active;
    }

    public function setIsActive(?string $is_active): self
    {
        $this->is_active = $is_active;
        return $this;
    }

    public static function createFromRequest(array $data): self
    {
        return (new self())
            ->setId($data['uuid'])
            ->setDay($data['day_of_week'])
            ->setFrom($data['from'])
            ->setTo($data['to'])
            ->setIsActive($data['is_active'] ?? 0);
    }
}
