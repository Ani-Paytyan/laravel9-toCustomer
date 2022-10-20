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
            'name' => 'string|required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('attributes.user.name'),
        ];
    }
}
