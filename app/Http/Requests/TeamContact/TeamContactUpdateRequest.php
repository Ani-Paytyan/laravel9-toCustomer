<?php

namespace App\Http\Requests\TeamContact;

use Illuminate\Foundation\Http\FormRequest;

class TeamContactUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role' => 'string|required',
        ];
    }

    public function attributes()
    {
        return [
            'role' => trans('attributes.user.role'),
        ];
    }
}
