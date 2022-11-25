<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Auth login request",
 *     type="object",
 *     schema="AuthLoginRequest",
 *     required={"email", "password"},
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         example="test@example.com",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="password",
 *         example="12345678",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="push_token",
 *         example="6KuGyNKfO12E16iQfhprH5A00lrMnNje",
 *     ),
 * )
 */
class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'email|required',
            'password' => 'string|required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => trans('attributes.user.email'),
            'password' => trans('attributes.user.password'),
        ];
    }
}
