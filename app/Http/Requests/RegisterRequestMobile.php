<?php

namespace App\Http\Requests;


class RegisterRequestMobile extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'nullable|email|unique:users,email',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Custom validation message
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'phone.numeric'    => 'Please give your phone numeric',
            'email.email' => 'Please give your phone email',
            'name.string' => 'Please give your phone string',
        ];
    }
}
