<?php

namespace App\Exceptions\Iwms;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class IwmsApiError extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        Log::error("Code: " . $this->code . " File:" . $this->file .  " Message: " . $this->getMessage());
        Log::error($this);

        if(request()->route()->getPrefix() === 'api/v1') {
            return response()->json([
                'error' => $this->getMessage(),
                'status' => $this->code,
            ], $this->code);
        }

        return redirect()->back()->with('toast_error', $this->getMessage());
    }
}
