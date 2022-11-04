<?php

namespace App\Http\Requests\UniqueItem;

use Illuminate\Foundation\Http\FormRequest;

class UniqueItemStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contact_id' => 'required_without:unique_item_id',
            'unique_item_id' => 'required_without:contact_id',
        ];
    }
}
