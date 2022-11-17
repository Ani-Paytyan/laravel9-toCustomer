<?php

namespace App\Services\SupportService;

use App\Dto\Support\SupportDto;

interface SupportServiceInterface
{
    public function send($user, SupportDto $dto);
}
