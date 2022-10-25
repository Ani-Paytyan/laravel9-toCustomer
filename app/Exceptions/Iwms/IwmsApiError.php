<?php

namespace App\Exceptions\Iwms;

use Illuminate\Support\Facades\Log;

class IwmsApiError extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        Log::error("Code: " . $this->code . " File:" . $this->file .  " Message: " . $this->getMessage());
        Log::error($this);

        return redirect()->back()->with('toast_error', $this->getMessage());
    }
}
