<?php

namespace App\Http\Requests\TeamContact;

use Illuminate\Foundation\Http\FormRequest;

class TeamContactStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contact_id' => 'required',
            'team_id' => 'required',
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
