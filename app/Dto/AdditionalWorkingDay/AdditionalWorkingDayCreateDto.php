<?php

namespace App\Dto\AdditionalWorkingDay;

class AdditionalWorkingDayCreateDto
{
    private string $date;
    private string $from;
    private string $to;
    private string $workplace_id;

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

    public static function createFromRequest(array $data, $workplace_id): self
    {
        return (new self())
            ->setDate($data['date'])
            ->setFrom($data['from'])
            ->setTo($data['to'])
            ->setWorkplaceId($workplace_id);
    }
}

