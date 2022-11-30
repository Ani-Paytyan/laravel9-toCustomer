<?php

namespace App\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;

class SupportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subject' => 'required',
            'support_text' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
