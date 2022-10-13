<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => trans('attributes.user.first_name'),
            'last_name' => trans('attributes.user.last_name'),
        ];
    }
}

