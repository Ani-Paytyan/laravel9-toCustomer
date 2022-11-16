<?php

namespace App\Dto\Auth;

use Illuminate\Http\Request;

class AuthCreateApiTokenDto
{
    private ?string $push_token;

    /**
     * @return string|null
     */
    public function getPushToken(): ?string
    {
        return $this->push_token;
    }

    /**
     * @param string|null $push_token
     * @return $this
     */
    public function setPushToken(?string $push_token): self
    {
        $this->push_token = $push_token;
        return $this;
    }

    public static function createFromRequest(Request $request): self
    {
        return (new self())
            ->setPushToken($request->get('push_token'));
    }

}
