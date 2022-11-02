<?php

namespace App\Http\Requests\WorkPlace;

use Illuminate\Foundation\Http\FormRequest;

class WorkPlaceCreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|required|unique:workplaces',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('attributes.user.name'),
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.custom.unique_workplace'),
        ];
    }
}
