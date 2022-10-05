<?php

namespace App\Exceptions\Iwms;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class IwmsApiError extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}