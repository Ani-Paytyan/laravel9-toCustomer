<?php

namespace App\Http\Requests\WorkPlaceContact;

use Illuminate\Foundation\Http\FormRequest;

class WorkPlaceContactStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
