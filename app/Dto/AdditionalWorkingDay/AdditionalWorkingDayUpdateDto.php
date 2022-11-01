<?php

namespace App\Dto\AdditionalWorkingDay;

class AdditionalWorkingDayUpdateDto
{
    private string $id;
    private string $date;
    private string $from;
    private string $to;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;
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

    public static function createFromRequest(array $data, $id): self
    {
        return (new self())
            ->setId($id)
            ->setDate($data['date'])
            ->setFrom($data['from'])
            ->setTo($data['to']);
    }
}
