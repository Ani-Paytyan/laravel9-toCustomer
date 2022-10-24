<?php

namespace App\Exceptions\Iwms;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class IwmsApiError extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return RedirectResponse
     */
    public function render(): RedirectResponse
    {
        Log::error("Code: " . $this->code . " File:" . $this->file .  " Message: " . $this->getMessage());
        Log::error($this);

        return redirect()->route('dashboard')->with('toast_error', $this->getMessage());
    }
}
