<?php

namespace App\Http\Requests\WorkPlace;

use Illuminate\Foundation\Http\FormRequest;

class WorkPlaceEditRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:workplaces,name,'. $this->workplace->uuid.',uuid',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('attributes.user.name'),
            'description' => 'max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.custom.unique_workplace'),
        ];
    }
}
