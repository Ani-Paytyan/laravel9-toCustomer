<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'string|required|unique:contacts',
            'role' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => trans('attributes.user.email'),
            'role' => trans('attributes.user.role'),
        ];
    }
}

