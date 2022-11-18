<?php

namespace App\Dto\Support;

use App\Http\Requests\Support\SupportRequest;

class SupportDto
{
    private ?string $subject;
    private ?string $supportText;

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSupportText(): ?string
    {
        return $this->supportText;
    }

    public function setSupportText(?string $supportText): self
    {
        $this->supportText = $supportText;

        return $this;
    }

    /**
     * @param SupportRequest $request
     * @return static
     */
    public static function createFromRequest(SupportRequest $request): self
    {
        return (new self())
            ->setSubject($request->get('subject') ?? '')
            ->setSupportText($request->get('support_text') ?? '');
    }
}
