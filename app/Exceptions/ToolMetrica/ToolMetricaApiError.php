<?php

namespace App\Exceptions\ToolMetrica;

use Illuminate\Support\Facades\Log;
use Exception;
use Throwable;

class ToolMetricaApiError extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        Log::error("Code: " . $this->code . " File:" . $this->file .  " Message: " . $this->getMessage());
        Log::error($this);

        if ($request->ajax()) {
            return response()->json([
                'error' => $this->getMessage()
            ], $this->code);
        }

        return redirect()->back()->with('toast_error', $this->getMessage());
    }
}
